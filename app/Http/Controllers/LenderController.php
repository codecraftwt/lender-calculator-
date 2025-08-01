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
        $rawResults = DB::table('product_type_models')
            ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id')
            ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
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
                'email'    => $group[0]->email,
                'mobile_number' => $group[0]->mobile_number,
                'website_url' => $group[0]->website_url,
                'product_ids' => $group->pluck('product_id')->unique()->values()
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
                $rawResults = DB::table('product_type_models')
                    ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id')
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
                        'product_type_models.sub_product_name',
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
                        'sub_product_name' => $product->sub_product_name,
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
}
