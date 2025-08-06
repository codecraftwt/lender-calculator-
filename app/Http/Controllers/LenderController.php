<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\MainLenderTable;
use App\Models\ProductModel;
use App\Models\ProductTypeModel;


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
}
