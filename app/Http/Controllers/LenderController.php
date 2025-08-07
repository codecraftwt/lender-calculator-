<?php

namespace App\Http\Controllers;

use App\Models\LenderTypeModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\MainLenderTable;
use App\Models\ProductModel;
use App\Models\ProductTypeModel;
use Illuminate\Support\Facades\Validator;



class LenderController extends Controller
{
    public function lender_list()
    {
        // $lenders = MainLenderTable::all();
        return view('lender.lender_list');
    }

    public function get_lenders()
    {
        // Fetch all related data
        $rawResults = DB::table('main_lender_tables')
            ->leftJoin('product_models', 'product_models.lender_id', '=', 'main_lender_tables.id')
            ->leftJoin('product_type_models', 'product_type_models.product_id', '=', 'product_models.id')
            ->select(
                'main_lender_tables.id as lender_id',
                'main_lender_tables.lender_name',
                'main_lender_tables.lender_logo',
                'main_lender_tables.email',
                'main_lender_tables.mobile_number',
                'main_lender_tables.website_url',
                'product_models.id as product_id'
            )
            ->get();

        // Group subproduct IDs by lender
        $lenders = $rawResults->groupBy('lender_id')->map(function ($group) {
            return [
                'lender_id' => $group[0]->lender_id,
                'lender_name' => $group[0]->lender_name,
                'lender_logo' => $group[0]->lender_logo,
                'email' => $group[0]->email,
                'mobile_number' => $group[0]->mobile_number,
                'website_url' => $group[0]->website_url,
                'product_ids' => $group->pluck('product_id')->filter()->unique()->values() // avoid nulls
            ];
        })->values();

        return response()->json($lenders);
    }

    public function get_lender_products(Request $request)
    {
        if ($request->has('pid') && !empty($request->pid)) {
            $idsRaw = is_array($request->pid) ? $request->pid : trim($request->pid, '[]');
            $ids = is_array($idsRaw) ? $idsRaw : explode(',', $idsRaw);
            $ids = array_filter($ids, fn($id) => is_numeric($id));

            if (!empty($ids)) {
                // Fetch all related data
                $rawResults = DB::table('product_models')
                    ->leftJoin('product_type_models', 'product_models.id', '=', 'product_type_models.product_id')
                    ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
                    ->select(
                        'main_lender_tables.id as lender_id',
                        'main_lender_tables.lender_name',
                        'main_lender_tables.lender_logo',
                        'main_lender_tables.email',
                        'main_lender_tables.mobile_number',
                        'main_lender_tables.website_url',
                        'product_models.id as product_id',
                        'product_models.product_name',
                        'product_type_models.id as subproduct_id'
                    )
                    ->whereIn('product_models.id', $ids)
                    ->get();


                // Group by product_id
                $products = $rawResults->groupBy('product_id')->map(function ($group) {
                    return [
                        'product_id' => $group[0]->product_id,
                        'product_name' => $group[0]->product_name,
                        'lender_id' => $group[0]->lender_id,
                        'lender_name' => $group[0]->lender_name,
                        'lender_logo' => $group[0]->lender_logo,
                        'email' => $group[0]->email,
                        'mobile_number' => $group[0]->mobile_number,
                        'website_url' => $group[0]->website_url,
                        'subproduct_ids' => $group->pluck('subproduct_id')->unique()->values(),
                    ];
                })->values();

                return response()->json($products);
            } else {
                $lenders = collect();
            }
        } else {
            $lenders = collect();
        }

        return response()->json($lenders);
    }


    public function get_lender_subproducts(Request $request)
    {
        if ($request->has('product_ids') && !empty($request->product_ids)) {
            $idsRaw = is_array($request->product_ids) ? $request->product_ids : trim($request->product_ids, '[]');
            $ids = is_array($idsRaw) ? $idsRaw : explode(',', $idsRaw);
            $ids = array_filter($ids, fn($id) => is_numeric($id));
            $lender_id = $request->lender_id ?? null;

            if (!empty($ids)) {
                // Fetch lender & product data (without joining lender_contacts)
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

                    )
                    ->whereIn('product_type_models.id', $ids)
                    ->get();

                // Get unique lender IDs from the results
                $lenderIds = $rawResults->pluck('lender_id')->unique()->toArray();

                // Fetch lender contacts separately with a limit of 4 per lender
                $contactsRaw = DB::table('lender_contacts_models')
                    ->whereIn('lender_id', $lenderIds)
                    ->select('lender_id', 'contact_type', 'name', 'email', 'mobile_number', 'title')
                    ->get()
                    ->groupBy('lender_id')
                    ->map(function ($contacts) {
                        return $contacts->take(4); // Limit to 4 contacts per lender
                    });

                // Map lenders and attach contacts
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
                        'email'    => $product->email,
                        'mobile_number' => $product->mobile_number,
                        'website_url' => $product->website_url,
                        'product_guide' => $product->product_guide,
                        'interest_rate' => $product->interest_rate,
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


    public function get_product_data_with_subproducts(Request $request)
    {
        $product_id = $request->input('product_id');
        // $sub_product_ids = $request->input('sub_product_ids');

        $idsRaw = is_array($request->sub_product_ids) ? $request->sub_product_ids : trim($request->sub_product_ids, '[]');
        $ids = is_array($idsRaw) ? $idsRaw : explode(',', $idsRaw);
        $ids = array_filter($ids, fn($id) => is_numeric($id));


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
                'product_models.id as product_id',
                'product_type_models.id as subproduct_id',
                'product_models.product_name as product_name',
                'product_type_models.min_loan_amount',
                'product_type_models.max_loan_amount',
                'product_type_models.sub_product_name',
                'product_type_models.credit_score',
            )
            ->whereIn('product_type_models.id', $ids)
            ->get();

        return response()->json($rawResults);
    }


    public function get_sub_product_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_product_id' => 'required|integer|exists:product_type_models,id',
        ], [
            'sub_product_id.required' => 'Sub Product ID is required.',
            'sub_product_id.integer' => 'Sub Product ID must be a valid number.',
            'sub_product_id.exists' => 'Sub Product ID does not exist.',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $subProductId = $request->input('sub_product_id');

        $rawResults = DB::table('product_type_models')
            ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id')
            ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
            ->select(
                'main_lender_tables.lender_logo',
                'product_models.id as product_id',
                'product_type_models.id as subproduct_id',
                'product_type_models.sub_product_name as sub_product_name',
                'product_type_models.min_loan_amount',
                'product_type_models.max_loan_amount',
                'product_type_models.credit_score',
                'product_type_models.interest_rate',
                'product_type_models.gst_time',
                'product_type_models.number_of_dishonours',
                'product_type_models.negative_days',
                'product_type_models.property_owner',
                'product_type_models.annual_income',
                'product_type_models.GST_registration',
                'product_type_models.trading_time',
                'product_type_models.restricted_industry',
            )
            ->where('product_type_models.id', $subProductId)
            ->get();

        $restricted_industries = ProductTypeModel::whereNotNull('restricted_industry')
            ->pluck('restricted_industry')
            ->map(function ($item) {
                return json_decode($item, true);
            })
            ->flatten()
            ->unique()
            ->values();

        $result = [
            'rawresult' => $rawResults,
            'restricted_industries' => $restricted_industries
        ];

        return response()->json($result);
    }



    public function get_lender_contacts(Request $request)
    {
        $lender_id = $request->lenderId ?? null;


        $contactsWithLender = DB::table('lender_contacts_models')
            ->join('main_lender_tables', 'lender_contacts_models.lender_id', '=', 'main_lender_tables.id')
            ->where('lender_contacts_models.lender_id', $lender_id)
            ->select(
                'lender_contacts_models.lender_id',
                'lender_contacts_models.contact_type',
                'lender_contacts_models.name',
                'lender_contacts_models.email as contact_email',
                'lender_contacts_models.mobile_number as contact_mobile',
                'lender_contacts_models.title',

                'main_lender_tables.lender_name',
                'main_lender_tables.email as lender_email',
                'main_lender_tables.mobile_number as lender_mobile',
                'main_lender_tables.website_url',
                'main_lender_tables.lender_logo'
            )
            ->get();



        return response()->json($contactsWithLender);
    }


    public function lender_edit($id = null)
    {
        $lender_data = MainLenderTable::where('id', $id)->get();
        $lender_products = ProductModel::where('lender_id', $id)->get();
        $pid = $lender_products->pluck('id')->toArray();
        $lender_subproducts = ProductTypeModel::whereIn('product_id', $pid)->get();
        $spid =  $lender_subproducts->pluck('id')->toArray();

        $result = [
            'lender_data' => $lender_data,
            'lender_products_ids' => $pid,
            'lender_subproducts_ids' => $spid,
        ];


        // return response()->json($result);
        return view('lender.lender_edit', compact('lender_data', 'pid', 'spid'));
    }

    public function update_main_lender_data(Request $request)
    {

        $rules = [
            'lender_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'lender_name' => ['required', 'string', 'min:2', 'max:255'],
            'lender_id' => ['required', 'integer'],
            'lender_website' => ['required', 'regex:/^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-]*)*$/', 'max:255'],
            'lender_email' => ['required', 'email', 'max:255'],
            'mobile_number' => ['required', 'regex:/^[\d\s\+\-]{5,20}$/'], // allowing digits, spaces, plus, hyphen
            'product_guide_type' => ['required', 'in:file,url'],
            'product_guide_file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png,gif,webp',
                'max:5120',
            ],
            'product_guide_url' => [
                'nullable',
                'url',
                'max:255',
            ],

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $existing_data = MainLenderTable::select(['lender_logo', 'product_guide'])
            ->where('id', $request->lender_id)
            ->first();


        $data = [
            'lender_name' => $request->lender_name,
            'website_url' => $request->lender_website,
            'email' => $request->lender_email,
            'mobile_number' => $request->mobile_number,
        ];

        if ($request->hasFile('lender_logo')) {
            if ($existing_data->lender_logo && file_exists(public_path('assets/images/' . $existing_data->lender_logo))) {
                unlink(public_path('assets/images/' . $existing_data->lender_logo));
            }
            $file = $request->file('lender_logo');
            $filename = strtolower($request->lender_name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images'), $filename);
            $data['lender_logo'] = $filename;
        }

        if ($request->hasFile('product_guide_file')) {
            if ($existing_data->product_guide && file_exists(public_path('assets/product_guide/' . $existing_data->product_guide))) {
                unlink(public_path('assets/product_guide/' . $existing_data->product_guide));
            }
            $file = $request->file('product_guide_file');
            $filename = strtolower($request->lender_name) . '_guide.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/product_guide'), $filename);
            $data['product_guide'] = $filename;
        }

        if ($request->product_guide_url) {
            $data['product_guide'] = $request->product_guide_url;
        }


        $result = MainLenderTable::where('id', $request->lender_id)->update($data);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Lender data updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update the data.'
            ]);
        }
    }


    public function update_product_data(Request $request)
    {
        $rules = [
            'product_id' => ['required', 'integer'],
            'product_name' => ['required', 'string', 'min:2', 'max:255'],
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }


        $data = [
            'product_name' => $request->product_name,
        ];


        $result = ProductModel::where('id', $request->product_id)->update($data);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product data updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update the data.'
            ]);
        }
    }

    public function update_sub_product_data(Request $request)
    {

        $rules = [
            'sub_product_id' => ['required', 'integer'],
            'sub_product_name' => ['required', 'string', 'min:2', 'max:255'],
            'trading_time' => ['required', 'numeric', 'min:0'],
            'gst_registration' => ['required', 'in:Yes,No'],
            'gst_time' => ['nullable', 'numeric', 'min:0'],
            'min_loan_amount' => ['nullable', 'numeric', 'min:0'],
            'max_loan_amount' => ['nullable', 'numeric', 'min:0', 'gte:min_loan_amount'],
            'annual_income' => ['nullable', 'numeric', 'min:0'],
            'credit_score' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'property_owner' => ['required', 'in:Yes,No'],
            'number_of_dishonours' => ['nullable', 'integer', 'min:0'],
            'negative_days' => ['nullable', 'integer', 'min:0'],
            'interest_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'restricted_industry' => ['required', 'array', 'min:1'],
            'restricted_industry.*' => ['string'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'sub_product_name' => $request->sub_product_name,
            'trading_time' => $request->trading_time,
            'GST_registration' => $request->gst_registration,
            'gst_time' => $request->gst_time,
            'min_loan_amount' => $request->min_loan_amount,
            'max_loan_amount' => $request->max_loan_amount,
            'annual_income' => $request->annual_income,
            'credit_score' => $request->credit_score,
            'property_owner' => $request->property_owner,
            'number_of_dishonours' => $request->number_of_dishonours,
            'negative_days' => $request->negative_days,
            'interest_rate' => $request->interest_rate,
            'restricted_industry' => json_encode($request->restricted_industry),
        ];

        $result = ProductTypeModel::where('id', $request->sub_product_id)->update($data);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sub Product data updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update the data.'
            ]);
        }
    }
}
