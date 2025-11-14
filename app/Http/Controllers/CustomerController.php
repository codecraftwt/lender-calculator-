<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\LenderModel;
use App\Models\LenderTypeModel;
use App\Models\ProductTypeModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use Carbon\Carbon;

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
                'gst_time'             => 'nullable|numeric',
                'document_id' => 'required',

                'number_of_sacc_loans' => 'nullable|numeric',
                'number_of_cash_flow_loans' => 'nullable|numeric',
                'overdrawn_fees' => 'nullable|numeric',
                'eod_balance' => 'nullable|numeric',

                'negative_days_in_30' => 'nullable|numeric',
                'negative_days_in_60' => 'nullable|numeric',
                'negative_days_in_90' => 'nullable|numeric',
                'negative_days_in_180' => 'nullable|numeric',

                'dishonours_in_30' => 'nullable|numeric',
                'dishonours_in_60' => 'nullable|numeric',
                'dishonours_in_90' => 'nullable|numeric',
                'dishonours_in_180' => 'nullable|numeric',

                'overdran_fees_in_30' => 'nullable|numeric',
                // 'overdran_fees_in_60' => 'nullable|numeric',
                'overdran_fees_in_90' => 'nullable|numeric',
                'overdran_fees_in_180' => 'nullable|numeric',

                'eod_balance_in_30' => 'nullable|numeric',
                'eod_balance_in_60' => 'nullable|numeric',
                'eod_balance_in_90' => 'nullable|numeric',
                'eod_balance_in_180' => 'nullable|numeric',

            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }


        // return response()->json($validated);

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


            'number_of_sacc_loans' => $validated['number_of_sacc_loans'],
            'number_of_cash_flow_loans' => $validated['number_of_cash_flow_loans'],
            'overdrawn_fees_total' => $validated['overdrawn_fees'],
            'eod_balance_count_total' => $validated['eod_balance'],

            'days_in_negative_in_60_days' => $validated['negative_days_in_60'],
            'days_in_negative_in_90_days' => $validated['negative_days_in_90'],
            'days_in_negative_in_180_days' => $validated['negative_days_in_180'],
            'days_in_negative_in_30_days' => $validated['negative_days_in_30'],

            'dishonours_in_30_days' => $validated['dishonours_in_30'],
            'dishonours_in_60_days' => $validated['dishonours_in_60'],
            'dishonours_in_90_days' => $validated['dishonours_in_90'],
            'dishonours_in_180_days' => $validated['dishonours_in_180'],

            'overdrawn_fees_in_30_days' => $validated['overdran_fees_in_30'],
            // 'overdrawn_fees_in_60_days' => $validated['overdran_fees_in_60'],
            'overdrawn_fees_in_90_days' => $validated['overdran_fees_in_90'],
            'overdrawn_fees_in_180_days' => $validated['overdran_fees_in_180'],


            'eod_balance_count_in_30_days' => $validated['eod_balance_in_30'],
            'eod_balance_count_in_60_days' => $validated['eod_balance_in_60'],
            'eod_balance_count_in_90_days' => $validated['eod_balance_in_90'],
            'eod_balance_count_in_180_days' => $validated['eod_balance_in_180'],
            'document_id' => $validated['document_id'],
            'added_by' => auth()->id(),
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


    public function get_customers(Request $request)
    {
        if ($request->isMethod('get')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unsupported method requested.'
            ], 405);
        }


        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $status = $request->status;
        $loanRange = $request->loanRange ?? '';

        $minVal = $maxVal = null;

        if (strpos($loanRange, '-') !== false) {
            $parts = array_map('trim', explode('-', $loanRange));
            $minVal = isset($parts[0]) ?  $parts[0] : null;
            $maxVal = isset($parts[1]) ?  $parts[1] : null;
        }

        $user = auth()->user();


        $customers = CustomerModel::where('deleted_flag', 0)
            ->orderBy('id', 'DESC');

        if ($user->role === 'Broker') {
            $customers->where('added_by', $user->id);
        } elseif ($user->role === 'Admin') {
        } else {

            $customers = collect();
        }


        if (!empty($startDate)) {

            $customers->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        }

        if (!empty($endDate)) {

            $customers->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        if ($minVal !== null && $maxVal !== null) {
            $customers->whereRaw('CAST(loan_amt_needed AS UNSIGNED) >= ?', [$minVal])
                ->whereRaw('CAST(loan_amt_needed AS UNSIGNED) <= ?', [$maxVal]);
        }

        if ($status !== null && $status !== '') {

            $customers->where('status', $status);
        }

        $customers = $customers->get();


        return response()->json($customers);
    }



    public function get_applicable_lenders(Request $request)
    {


        if ($request->isMethod('get')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unsupported method requested'
            ], 405);
        }

        if ($request->has('cid') && !empty($request->cid)) {
            $idsRaw = is_array($request->cid) ? $request->cid : trim($request->cid, '[]');
            $ids = is_array($idsRaw) ? $idsRaw : explode(',', $idsRaw);
            $ids = array_filter($ids, fn($id) => is_numeric($id));

            if (!empty($ids)) {

                $rawResults = DB::table('product_type_models')
                    ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id')
                    ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
                    ->select(
                        'main_lender_tables.id as lender_id',
                        'main_lender_tables.lender_name',
                        'main_lender_tables.lender_logo',
                        'product_type_models.id as subproduct_id'
                    )
                    ->where('product_models.deleted_flag', 0)
                    ->whereIn('product_type_models.id', $ids)
                    ->get();


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

        if ($request->isMethod('get')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unsupported method requested'
            ], 405);
        }

        if ($request->has('product_ids') && !empty($request->product_ids)) {
            $idsRaw = is_array($request->product_ids) ? $request->product_ids : trim($request->product_ids, '[]');
            $ids = is_array($idsRaw) ? $idsRaw : explode(',', $idsRaw);
            $ids = array_filter($ids, fn($id) => is_numeric($id));

            $lender_id = $request->lender_id ?? null;

            if (!empty($ids)) {
                $rawResults = DB::table('product_type_models')
                    ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id')
                    ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
                    ->select(
                        'main_lender_tables.id as lender_id',
                        'main_lender_tables.lender_name',
                        'main_lender_tables.email',
                        'main_lender_tables.mobile_number',
                        'main_lender_tables.website_url',
                        'main_lender_tables.product_guide',
                        'main_lender_tables.lender_logo',
                        'product_type_models.id as subproduct_id',
                        'product_models.product_name as product_name',
                        'product_type_models.min_loan_amount',
                        'product_type_models.max_loan_amount',
                        'product_type_models.sub_product_name',
                        'product_type_models.credit_score',
                        'product_type_models.interest_rate',
                        'product_type_models.security_requirement'
                    )
                    ->whereIn('product_type_models.id', $ids)
                    ->get();

                $lenderIds = $rawResults->pluck('lender_id')->unique()->toArray();

                $contactsRaw = DB::table('lender_contacts_models')
                    ->whereIn('lender_id', $lenderIds)
                    ->select('lender_id', 'contact_type', 'name', 'email', 'mobile_number', 'title')
                    ->get()
                    ->groupBy('lender_id')
                    ->map(function ($contacts) {
                        return $contacts->take(4);
                    });

                $lenders = $rawResults->map(function ($product) use ($contactsRaw) {
                    return [
                        'lender_id' => $product->lender_id,
                        'lender_name' => $product->lender_name,
                        'lender_logo' => $product->lender_logo,
                        'subproduct_id' => $product->subproduct_id,
                        'product_name' => $product->product_name,
                        'min_amount' => $product->min_loan_amount,
                        'max_amount' => $product->max_loan_amount,
                        'sub_product_name' => $product->sub_product_name,
                        'credit_score' => $product->credit_score,
                        'email' => $product->email,
                        'mobile_number' => $product->mobile_number,
                        'website_url' => $product->website_url,
                        'product_guide' => $product->product_guide,
                        'interest_rate' => $product->interest_rate,
                        'security_requirement' => $product->security_requirement,
                        'contacts' => $contactsRaw->get($product->lender_id, collect()),
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


        $user = auth()->user();

        if ($user->role === 'Broker') {
            $data = CustomerModel::where('id', $id)->where('deleted_flag', 0)->where('added_by', auth()->id())->get();
        } elseif ($user->role === 'Admin') {
            $data = CustomerModel::where('id', $id)->where('deleted_flag', 0)->get();
        }


        if (count($data) > 0) {
            return view('customer.customer_edit', compact('restricted_industries', 'data'));
        } else {
            return redirect()->back()->with('error', 'Authorization denied.');
        }
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
                'number_of_dishonours' => 'nullable|numeric',
                'abn_gst'              => 'nullable|in:Yes,No',
                'company_name'         => 'required|string',
                'director_name'        => 'required|string',
                'director_email'       => 'required|email',
                'director_phone'       => 'required|string',
                'applicable_lenders'   => 'nullable|string',
                'gst_time'             => 'nullable|numeric',
                'customer_id'          => 'required|numeric',
                'document_id' => 'required',

                'number_of_sacc_loans' => 'nullable|numeric',
                'number_of_cash_flow_loans' => 'nullable|numeric',
                'overdrawn_fees' => 'nullable|numeric',
                'eod_balance' => 'nullable|numeric',

                'negative_days_in_30' => 'nullable|numeric',
                'negative_days_in_60' => 'nullable|numeric',
                'negative_days_in_90' => 'nullable|numeric',
                'negative_days_in_180' => 'nullable|numeric',

                'dishonours_in_30' => 'nullable|numeric',
                'dishonours_in_60' => 'nullable|numeric',
                'dishonours_in_90' => 'nullable|numeric',
                'dishonours_in_180' => 'nullable|numeric',

                'overdran_fees_in_30' => 'nullable|numeric',
                // 'overdran_fees_in_60' => 'nullable|numeric',
                'overdran_fees_in_90' => 'nullable|numeric',
                'overdran_fees_in_180' => 'nullable|numeric',

                'eod_balance_in_30' => 'nullable|numeric',
                'eod_balance_in_60' => 'nullable|numeric',
                'eod_balance_in_90' => 'nullable|numeric',
                'eod_balance_in_180' => 'nullable|numeric',


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

            'number_of_sacc_loans' => $validated['number_of_sacc_loans'],
            'number_of_cash_flow_loans' => $validated['number_of_cash_flow_loans'],
            'overdrawn_fees_total' => $validated['overdrawn_fees'],
            'eod_balance_count_total' => $validated['eod_balance'],

            'days_in_negative_in_60_days' => $validated['negative_days_in_60'],
            'days_in_negative_in_90_days' => $validated['negative_days_in_90'],
            'days_in_negative_in_180_days' => $validated['negative_days_in_180'],
            'days_in_negative_in_30_days' => $validated['negative_days_in_30'],

            'dishonours_in_30_days' => $validated['dishonours_in_30'],
            'dishonours_in_60_days' => $validated['dishonours_in_60'],
            'dishonours_in_90_days' => $validated['dishonours_in_90'],
            'dishonours_in_180_days' => $validated['dishonours_in_180'],

            'overdrawn_fees_in_30_days' => $validated['overdran_fees_in_30'],
            // 'overdrawn_fees_in_60_days' => $validated['overdran_fees_in_60'],
            'overdrawn_fees_in_90_days' => $validated['overdran_fees_in_90'],
            'overdrawn_fees_in_180_days' => $validated['overdran_fees_in_180'],


            'eod_balance_count_in_30_days' => $validated['eod_balance_in_30'],
            'eod_balance_count_in_60_days' => $validated['eod_balance_in_60'],
            'eod_balance_count_in_90_days' => $validated['eod_balance_in_90'],
            'eod_balance_count_in_180_days' => $validated['eod_balance_in_180'],
            'document_id' => $validated['document_id'],
        ]);


        if ($data) {
            return redirect('/customer-list')->with('success', 'Data Updated successfully');
        } else {
            return redirect('/customer-edit/' . $validated['customer_id'] . '')->with('error', 'Failed to Update the Data');
        }
    }

    public function customer_delete($id = null)
    {

        $user = auth()->user();

        if ($user->role === 'Broker') {
            $data = CustomerModel::where('id', $id)->where('added_by', auth()->id())->update(['deleted_flag' => 1]);
        } elseif ($user->role === 'Admin') {
            // Admin: get all customers not deleted
            $data = CustomerModel::where('id', $id)->update(['deleted_flag' => 1]);
        }


        if ($data) {
            return redirect('/customer-list')->with('success', 'Customer Deleted Successfully');
        } else {
            return redirect('/customer-list')->with('error', 'Failed to Delete the Customer');
        }
    }

    public function update_customer_status(Request $request)
    {


        $rules = [
            'status' => 'required|integer',
            'customer_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $status = $request->status;
        $customer_id = $request->customer_id;


        CustomerModel::where('id', $customer_id)->update(['status' => $status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully.',
            'data' => [
                'status' => $status,
                'customer_id' => $customer_id,
            ]
        ]);
    }


    public function filter_customers(Request $request) {}

    public function get_customer_details(Request $request)
    {
        $rules = [
            'dataId' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }


        $customer_data = CustomerModel::select(
            'monthly_revenue',
            'negative_days',
            'number_of_dishonours',
            'overdrawn_fees_total',
            'eod_balance_count_total',
            'number_of_sacc_loans',
            'number_of_cash_flow_loans',
            'document_id',
            'days_in_negative_in_30_days',
            'days_in_negative_in_60_days',
            'days_in_negative_in_90_days',

            'dishonours_in_30_days',
            'dishonours_in_60_days',
            'dishonours_in_90_days',

            'overdrawn_fees_in_30_days',
            // 'overdrawn_fees_in_60_days',
            'overdrawn_fees_in_90_days',

            'eod_balance_count_in_30_days',
            'eod_balance_count_in_60_days',
            'eod_balance_count_in_90_days',

        )->where('id', $request->dataId)->where('deleted_flag', 0)->get();

        return response()->json($customer_data);
    }
}
