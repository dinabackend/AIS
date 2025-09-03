<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuditLogResource;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = AuditLog::with(['user', 'auditable'])
            ->when($request->user_id, function($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->when($request->event, function($query, $event) {
                return $query->where('event', $event);
            })
            ->when($request->auditable_type, function($query, $type) {
                return $query->where('auditable_type', $type);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 50));

        return AuditLogResource::collection($logs);
    }

    public function security(Request $request)
    {
        $securityLogs = AuditLog::where('event', 'LIKE', '%security%')
            ->orWhere('event', 'LIKE', '%login%')
            ->orWhere('event', 'LIKE', '%failed%')
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 20));

        return response()->json([
            'logs' => AuditLogResource::collection($securityLogs),
            'summary' => [
                'failed_logins_today' => AuditLog::where('event', 'failed_login')
                    ->whereDate('created_at', today())->count(),
                'suspicious_activities' => AuditLog::where('risk_level', 'high')
                    ->whereDate('created_at', today())->count(),
                'blocked_ips' => $this->getBlockedIPs(),
            ]
        ]);
    }

    public function export(Request $request)
    {
        $logs = AuditLog::with(['user'])
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->get();

        return $this->generateAuditReport($logs);
    }

    private function getBlockedIPs()
    {
        return AuditLog::where('event', 'ip_blocked')
            ->whereDate('created_at', today())
            ->pluck('ip_address')
            ->unique()
            ->values();
    }
}
