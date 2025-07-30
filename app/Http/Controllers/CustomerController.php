<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\LenderModel;
use App\Models\LenderTypeModel;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function save_data(Request $request)
    {

        // dd($request->all());
        try {
            $validated = $request->validate([
                'abn_date'             => 'required|date',
                'gst_date'             => 'nullable|date',
                'entity_type'          => 'nullable|string',
                'company_credit_score' => 'required|string',
                'property_owner'       => 'required|string',
                'industry_type'        => 'required|string',
                'restricted_industry'  => 'nullable|array',
                'loan_amt'             => 'required|numeric',
                'time_in_business'     => 'required|numeric',
                'credit_score'         => 'required|numeric',
                'monthly_revenue'      => 'required|numeric',
                'negative_days'        => 'required|numeric',
                'number_of_dishonours' => 'required|numeric',
                'abn_gst'              => 'required|in:Yes,No',
                'company_name'         => 'required|string',
                'director_name'        => 'required|string',
                'director_email'       => 'required|email',
                'director_phone'       => 'required|string',
                'applicable_lenders'   => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }


        $industries = $request->input('restricted_industry');
        if (in_array('null', $industries)) {
            $industries = [];
        } else {
            $industries = array_filter($industries, fn($val) => $val !== 'null');
        }

        $industriesJson = json_encode(array_values($industries)); // reindex array
        $lenderIds = json_decode($request->applicable_lenders, true);
        $lenderIds = array_map('intval', $lenderIds);
        $lenderIdsJson = json_encode($lenderIds);

        $data = CustomerModel::create([
            'loan_amt_needed'       => $validated['loan_amt'],
            'time_in_business'      => $validated['time_in_business'],
            'company_credit_score'  => $validated['company_credit_score'],
            'negative_days'         => $validated['negative_days'],
            'number_of_dishonours'  => $validated['number_of_dishonours'],
            'GST_registration'      => $validated['abn_gst'],
            'company_name'          => $validated['company_name'],
            'director_name'         => $validated['director_name'],
            'director_email'        => $validated['director_email'],
            'director_phone'        => $validated['director_phone'],
            'monthly_revenue'       => $validated['monthly_revenue'],
            'applicable_lenders'    => $lenderIdsJson,
            'restricted_industries' => $industriesJson,
            'abn_date'              => $validated['abn_date'],
            'gst_date'              => $validated['gst_date'],
            'entity_type'           => $validated['entity_type'],
            'credit_score'          => $validated['credit_score'],
            'property_owner'        => $validated['property_owner'],
            'industry_type'         => $validated['industry_type'],
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
                $lenders = DB::table('product_type_models')
                    ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id') // assuming this foreign key
                    ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
                    ->select(
                        'product_type_models.*',
                        'product_models.product_name',
                        'main_lender_tables.lender_name',
                        'main_lender_tables.lender_logo'
                    )
                    ->whereIn('product_type_models.id', $ids)
                    ->get();
            }
        }

        return response()->json($lenders);
    }
}
