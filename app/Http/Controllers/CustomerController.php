<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\LenderModel;
use App\Models\LenderTypeModel;
use App\Models\ProductTypeModel;

use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function save_data(Request $request)
    {

        try {
            $validated = $request->validate([
                'abn_date'             => 'required|date',
                'gst_date'             => 'nullable|date',
                'entity_type'          => 'nullable|string',
                'company_credit_score' => 'required|string',
                'property_owner'       => 'required|string',
                'industry_type'        => 'required|string',
                'restricted_industry'  => 'nullable',
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
                'applicable_lenders'   => 'nullable |string',
                'gst_time'             => 'nullable|numeric'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

        $industries = $request->input('restricted_industry', []);


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
            'gst_time'              => $validated['gst_time'],
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
        if ($request->has('cid') && !empty($request->cid)) {
            $idsRaw = is_array($request->cid) ? $request->cid : trim($request->cid, '[]');
            $ids = is_array($idsRaw) ? $idsRaw : explode(',', $idsRaw);
            $ids = array_filter($ids, fn($id) => is_numeric($id));

            if (!empty($ids)) {
                // Fetch all related data
                $rawResults = DB::table('product_type_models')
                    ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id')
                    ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
                    ->select(
                        'main_lender_tables.id as lender_id',
                        'main_lender_tables.lender_name',
                        'main_lender_tables.lender_logo',
                        'product_type_models.id as subproduct_id'
                    )
                    ->whereIn('product_type_models.id', $ids)
                    ->get();

                // Group subproduct IDs by lender
                $lenders = $rawResults->groupBy('lender_id')->map(function ($group) {
                    return [
                        'lender_id' => $group[0]->lender_id,
                        'lender_name' => $group[0]->lender_name,
                        'lender_logo' => $group[0]->lender_logo,
                        'product_type_ids' => $group->pluck('subproduct_id')->unique()->values()
                    ];
                })->values();
            } else {
                $lenders = collect();
            }
        } else {
            $lenders = collect();
        }

        return response()->json($lenders);
    }

    public function get_sub_products(Request $request)
    {
        if ($request->has('product_ids') && !empty($request->product_ids)) {
            $idsRaw = is_array($request->product_ids) ? $request->product_ids : trim($request->product_ids, '[]');
            $ids = is_array($idsRaw) ? $idsRaw : explode(',', $idsRaw);
            $ids = array_filter($ids, fn($id) => is_numeric($id));

            if (!empty($ids)) {
                // Fetch all related data without grouping them
                $rawResults = DB::table('product_type_models')
                    ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id')
                    ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
                    ->select(
                        'main_lender_tables.id as lender_id',
                        'main_lender_tables.lender_name',
                        'main_lender_tables.email',
                        'main_lender_tables.mobile_number',
                        'main_lender_tables.website_url',

                        'main_lender_tables.lender_logo',
                        'product_type_models.id as subproduct_id',
                        'product_models.product_name as product_name',
                        'product_type_models.min_loan_amount',
                        'product_type_models.max_loan_amount',
                        'product_type_models.sub_prodUct_name',
                        'product_type_models.credit_score',


                    )
                    ->whereIn('product_type_models.id', $ids)
                    ->get();


                $lenders = $rawResults->map(function ($product) {
                    return [
                        'lender_id' => $product->lender_id,
                        'lender_name' => $product->lender_name,
                        'lender_logo' => $product->lender_logo,
                        'subproduct_id' => $product->subproduct_id,
                        'product_name' => $product->product_name,
                        'min_amount' => $product->min_loan_amount,
                        'max_amount' => $product->max_loan_amount,
                        'sub_product_name' => $product->sub_prodUct_name,
                        'credit_score' => $product->credit_score,
                        'email'    => $product->email,
                        'mobile_number' => $product->mobile_number,
                        'website_url' => $product->website_url,

                    ];
                });
            } else {
                $lenders = collect();
            }
        } else {
            $lenders = collect();
        }

        return response()->json($lenders);
    }

    public function customer_edit($id = null)
    {
        $restricted_industries = ProductTypeModel::whereNotNull('restricted_industry')
            ->pluck('restricted_industry')
            ->map(function ($item) {
                return json_decode($item, true);
            })
            ->flatten()
            ->unique()
            ->values();

        $data = CustomerModel::where('id', $id)->where('deleted_flag', 0)->get();
        // print_r($data);

        return view('customer.customer_edit', compact('restricted_industries', 'data'));
    }

    public function update_customer(Request $request)
    {



        try {
            $validated = $request->validate([
                'abn_date'             => 'required|date',
                'gst_date'             => 'nullable|date',
                'entity_type'          => 'nullable|string',
                'company_credit_score' => 'required|string',
                'property_owner'       => 'required|string',
                'industry_type'        => 'required|string',
                'restricted_industry'  => 'nullable',
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
                'applicable_lenders'   => 'nullable|string',
                'gst_time'             => 'nullable|numeric',
                'customer_id'          => 'required|numeric',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
            // return redirect('/customer-edit/' . $validated['customer_id'] . '')->with('success', 'Data submitted successfully');
        }


        $industries = $request->input('restricted_industry', []);
        if (in_array('null', $industries)) {
            $industries = [];
        } else {
            $industries = array_filter($industries, fn($val) => $val !== 'null');
        }

        $industriesJson = json_encode(array_values($industries)); // reindex array
        $lenderIds = json_decode($request->applicable_lenders, true);
        $lenderIds = array_map('intval', $lenderIds);
        $lenderIdsJson = json_encode($lenderIds);

        $data = CustomerModel::where('id', $validated['customer_id'])->update([
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
            'gst_time'              => $validated['gst_time'],
        ]);


        if ($data) {
            return redirect('/customer-list')->with('success', 'Data Updated successfully');
        } else {
            return redirect('/customer-edit/' . $validated['customer_id'] . '')->with('error', 'Failed to Update the Data');
        }
    }
}
