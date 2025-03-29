<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function storeBulk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leads' => 'required|array',
            'leads.*.full_name' => 'required|string|max:255',
            'leads.*.quantity' => 'required|integer|min:1',
            'leads.*.type' => 'required|string|max:255',
            'leads.*.status' => 'required|string|in:pending,completed,canceled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        $createdLeads = [];
        foreach ($request->input('leads') as $leadData) {
            $lead = Lead::create([
                'full_name' => $leadData['full_name'],
                'quantity' => $leadData['quantity'],
                'type' => $leadData['type'],
                'status' => $leadData['status']
            ]);
            $createdLeads[] = $lead;
        }

        return response()->json([
            'message' => 'Leads created successfully',
            'data' => $createdLeads
        ], 201);
    }
}