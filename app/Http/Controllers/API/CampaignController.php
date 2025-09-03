<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::with(['segments', 'metrics'])
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->orderBy('start_date', 'desc')
            ->paginate($request->get('per_page', 20));

        return CampaignResource::collection($campaigns);
    }

    public function analytics($id)
    {
        $campaign = Campaign::with(['clicks', 'conversions', 'segments'])->findOrFail($id);

        return response()->json([
            'campaign' => new CampaignResource($campaign),
            'metrics' => [
                'impressions' => $campaign->getTotalImpressions(),
                'clicks' => $campaign->clicks()->count(),
                'conversions' => $campaign->conversions()->count(),
                'click_through_rate' => $campaign->calculateCTR(),
                'conversion_rate' => $campaign->calculateConversionRate(),
                'cost_per_click' => $campaign->calculateCPC(),
                'return_on_investment' => $campaign->calculateROI(),
            ],
            'audience_breakdown' => $campaign->getAudienceBreakdown(),
            'performance_timeline' => $campaign->getPerformanceTimeline(),
        ]);
    }

    public function optimize($id)
    {
        $campaign = Campaign::findOrFail($id);

        // AI-powered optimization logic
        $optimizations = [
            'suggested_budget_adjustment' => $this->calculateOptimalBudget($campaign),
            'recommended_audiences' => $this->getRecommendedAudiences($campaign),
            'best_performing_content' => $this->getBestContent($campaign),
            'optimal_schedule' => $this->getOptimalSchedule($campaign),
        ];

        return response()->json($optimizations);
    }

    private function calculateOptimalBudget($campaign)
    {
        // Complex budget optimization algorithm
        $currentROI = $campaign->calculateROI();
        $industryBenchmark = 4.5; // 450% ROI

        if ($currentROI > $industryBenchmark) {
            return ['action' => 'increase', 'percentage' => 25];
        }

        return ['action' => 'maintain', 'percentage' => 0];
    }
}
