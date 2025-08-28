<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\FormSubmissionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $formData = $validator->validated();

        try {
            // Email addresses to send to (from .env configuration)
            $emailAddresses = [
                env('FORM_EMAIL_PRIMARY', 'admin@example.com'),
                env('FORM_EMAIL_SECONDARY', 'manager@example.com')
            ];

            // Send email to both addresses
            foreach ($emailAddresses as $email) {
                Mail::to($email)->send(new FormSubmissionMail($formData));
            }

            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully and emails sent'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }

    function index(Request $request)
    {
        return $request->all();
    }
}
