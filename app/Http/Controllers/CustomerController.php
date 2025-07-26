<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\LenderModel;



class CustomerController extends Controller
{
    public function save_data(Request $request)
    {
        $validated = $request->validate([
            'loan_amt' => 'required|numeric',
            'time_in_business' => 'required|numeric',
            'credit_score' => 'required|numeric',
            'monthly_revenue' => 'required|numeric',
            'negative_days' => 'required|numeric',
            'number_of_dishonours' => 'required|numeric',
            'asset_backed' => 'required',
            'company_name' => 'required',
            'director_name' => 'required',
            'director_email' => 'required',
            'director_phone' => 'required',
            'applicable_lenders' => 'required',
        ]);

        $lenderIds = json_decode($request->applicable_lenders, true);

        // Optional: validate that it's an array of integers
        $lenderIds = array_map('intval', $lenderIds);

        // Convert to JSON string again for storing (if needed)
        $lenderIdsJson = json_encode($lenderIds);

        $data = CustomerModel::create([
            'loan_amt_needed'       => $validated['loan_amt'],
            'time_in_business'      => $validated['time_in_business'],
            'company_credit_score'  => $validated['credit_score'],
            'negative_days'         => $validated['negative_days'],
            'number_of_dishonours'  => $validated['number_of_dishonours'],
            'asset_backed'          => $validated['asset_backed'],
            'company_name'          => $validated['company_name'],
            'director_name'         => $validated['director_name'],
            'director_email'        => $validated['director_email'],
            'director_phone'        => $validated['director_phone'],
            'monthly_revenue'       => $validated['monthly_revenue'],
            'applicable_lenders'    => $lenderIdsJson, // already a JSON string of IDs
        ]);

        if ($data) {
            return redirect('/customer-list')->with('success', 'Data submitted successfully');
        } else {
            return redirect('/customer-list')->with('error', 'Data submission failed');
        }
    }

    public function list()
    {
        return view('customer.customerlist');
    }


    public function get_customers()
    {
        $customers = CustomerModel::where('deleted_flag', 0)->get();
        return response()->json($customers);
    }

    public function get_applicable_lenders(Request $request)
    {
        $lenders = collect();

        if ($request->has('cid') && !empty($request->cid)) {
            // Remove square brackets if passed as a JSON-like string
            $idsRaw = is_array($request->cid) ? $request->cid : trim($request->cid, '[]');
            $ids = is_array($idsRaw) ? $idsRaw : explode(',', $idsRaw);

            // Filter only numeric IDs
            $ids = array_filter($ids, fn($id) => is_numeric($id));

            if (!empty($ids)) {
                $lenders = LenderModel::whereIn('id', $ids)->get();
            }
        }

        return response()->json($lenders);
    }
}
