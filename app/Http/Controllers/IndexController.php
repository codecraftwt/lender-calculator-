<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\App;

use App\Models\LenderModel;
use App\Models\ProductTypeModel;
use App\Models\MainLenderTable;
use App\Models\CustomerModel;
use App\Models\LenderTypeModel;
use App\Models\ProductModel;
use Carbon\Carbon;




class IndexController extends Controller
{

    public function index()
    {

        $restricted_industries = ProductTypeModel::whereNotNull('restricted_industry')
            ->pluck('restricted_industry')
            ->map(function ($item) {
                return json_decode($item, true);
            })
            ->flatten()
            ->unique()
            ->values();

        return view('Index.index', compact('restricted_industries'));
    }

    public function index_test()
    {


        $trading_times = LenderModel::select('trading_time')->groupBy('trading_time')->get();
        $loan_formats = LenderModel::select('loan_format')->groupBy('loan_format')->get();
        $loan_terms = LenderModel::select('loan_term')->groupBy('loan_term')->get();
        $bank_statements = LenderModel::select('bank_statement_type')->groupBy('bank_statement_type')->get();
        $guaranteeTypes = LenderModel::whereNotNull('guarantee_type')
            ->pluck('guarantee_type')
            ->map(function ($item) {
                return json_decode($item, true);
            })
            ->flatten()
            ->unique()
            ->values();
        $decision_times = LenderModel::select('decision_time')->groupBy('decision_time')->get();
        $repayment_frequency = LenderModel::whereNotNull('repayment_frequency')
            ->pluck('repayment_frequency')
            ->map(function ($item) {
                return json_decode($item, true);
            })
            ->flatten()
            ->unique()
            ->values();

        $industries = LenderModel::select('restricted_industry_type', 'allowed_industry_type')
            ->get()
            ->flatMap(function ($lender) {
                $restricted = json_decode($lender->restricted_industry_type, true) ?? [];
                $allowed = json_decode($lender->allowed_industry_type, true) ?? [];
                return array_merge($restricted, $allowed);
            })
            ->map(function ($item) {
                return trim(strtolower($item));  // normalize strings for uniqueness
            })
            ->unique()
            ->values()
            ->map(function ($item) {
                return ucfirst($item);  // optional: capitalize first letter for display
            });
        return view('Index.whole_lender_calculator', compact('trading_times', 'loan_formats', 'loan_terms', 'bank_statements', 'guaranteeTypes', 'decision_times', 'repayment_frequency', 'industries'));
        // return view('Index.demo');
    }

    public function broker_panel()
    {
        $trading_times = LenderModel::select('trading_time')->groupBy('trading_time')->get();
        $loan_formats = LenderModel::select('loan_format')->groupBy('loan_format')->get();
        $loan_terms = LenderModel::select('loan_term')->groupBy('loan_term')->get();
        $bank_statements = LenderModel::select('bank_statement_type')->groupBy('bank_statement_type')->get();
        $guaranteeTypes = LenderModel::whereNotNull('guarantee_type')
            ->pluck('guarantee_type')
            ->map(function ($item) {
                return json_decode($item, true);
            })
            ->flatten()
            ->unique()
            ->values();
        $decision_times = LenderModel::select('decision_time')->groupBy('decision_time')->get();
        $repayment_frequency = LenderModel::whereNotNull('repayment_frequency')
            ->pluck('repayment_frequency')
            ->map(function ($item) {
                return json_decode($item, true);
            })
            ->flatten()
            ->unique()
            ->values();

        $industries = LenderModel::select('restricted_industry_type', 'allowed_industry_type')
            ->get()
            ->flatMap(function ($lender) {
                $restricted = json_decode($lender->restricted_industry_type, true) ?? [];
                $allowed = json_decode($lender->allowed_industry_type, true) ?? [];
                return array_merge($restricted, $allowed);
            })
            ->map(function ($item) {
                return trim(strtolower($item));
            })
            ->unique()
            ->values()
            ->map(function ($item) {
                return ucfirst($item);
            });
        return view('Index.broker', compact('trading_times', 'loan_formats', 'loan_terms', 'bank_statements', 'guaranteeTypes', 'decision_times', 'repayment_frequency', 'industries'));
    }


    public function get_lenders(Request $request)
    {

        $query = DB::table('product_type_models')
            ->join('product_models', 'product_models.id', '=', 'product_type_models.product_id')
            ->join('main_lender_tables', 'main_lender_tables.id', '=', 'product_models.lender_id')
            ->select(
                'product_type_models.*',
                'product_models.product_name',
                'main_lender_tables.lender_name',
                'main_lender_tables.lender_logo',
            );




        if ($request->has('trading_time') && $request->trading_time != '') {
            $query->where('trading_time', "<=", $request->trading_time);
        }


        if ($request->has('abn_gst') && $request->abn_gst != '') {

            if ($request->abn_gst == 'No') {
                $query->where('GST_registration', 'No');
            } elseif ($request->abn_gst == 'Yes') {
                $query->whereIn('GST_registration', ['Yes', 'No']);
            }
        }

        if ($request->has('gst_date') && $request->has('abn_gst') && $request->gst_date != '') {
            $gstDate = Carbon::parse($request->gst_date);
            $now = Carbon::now();

            if ($gstDate->lessThanOrEqualTo($now)) {
                $monthsDifference = $gstDate->diffInMonths($now);

                $query->where(function ($q) use ($monthsDifference) {
                    $q->where(function ($q2) use ($monthsDifference) {
                        $q2->where('GST_registration', 'Yes')
                            ->where('gst_time', '<=', $monthsDifference);
                    })
                        ->orWhere('GST_registration', 'No');
                });
            } else {
                // Handle invalid future date
                return back()->withErrors(['gst_date' => 'GST date must be in the past.']);
            }
        }

        if ($request->has('monthly_income') && $request->monthly_income != '') {
            $monthly_income = preg_replace('/[^0-9.]/', '', $request->monthly_income);


            $annul_revenue = $monthly_income * 12;
            $query->whereRaw('CAST(annual_income AS DECIMAL(10,2)) <= ?', [$annul_revenue]);
        }

        if ($request->has('credit_score') && $request->credit_score != '') {
            $credit_score = preg_replace('/[^0-9.]/', '', $request->credit_score);
            $query->whereRaw('CAST(credit_score AS DECIMAL(10,2)) <= ?', [$credit_score]);
        }

        if ($request->has('property_owner') && $request->property_owner != '') {

            if ($request->property_owner == 'No') {
                $query->where('property_owner', 'No');
            } elseif ($request->property_owner == 'Yes') {
                $query->whereIn('property_owner', ['Yes', 'No']);
            }
        }
        if ($request->has('negative_days') && $request->negative_days != '') {
            $negative_days = preg_replace('/[^0-9.]/', '', $request->negative_days);

            $query->where(function ($q) use ($negative_days) {
                $q->whereRaw('CAST(negative_days AS DECIMAL(10,2)) >= ?', [$negative_days])
                    ->orWhereNull('negative_days');
            });
        }


        if ($request->has('number_of_dishonours') && $request->number_of_dishonours != '') {
            $number_of_dishonours = preg_replace('/[^0-9.]/', '', $request->number_of_dishonours);

            $query->where(function ($q) use ($number_of_dishonours) {
                $q->whereRaw('CAST(number_of_dishonours AS DECIMAL(10,2)) >= ?', [$number_of_dishonours])
                    ->orWhereNull('number_of_dishonours');
            });
        }

        if ($request->has('restricted_industry') && is_array($request->restricted_industry)) {
            $restricted_industries = array_map('trim', $request->restricted_industry); // 

            $query->where(function ($q) use ($restricted_industries) {
                $conditions = [];
                $bindings = [];

                foreach ($restricted_industries as $industry) {
                    $conditions[] = "JSON_CONTAINS(restricted_industry, ?)";
                    $bindings[] = json_encode($industry);
                }

                $conditionSql = implode(' OR ', $conditions);

                $q->whereRaw("NOT ({$conditionSql})", $bindings)
                    ->orWhereNull('restricted_industry');
            });
        }






        $lenders = $query->get();

        if ($request->has('loan_amt') && $request->loan_amt != '') {
            $loan_amt = preg_replace('/[^0-9.]/', '', $request->loan_amt);


            $lenders = $lenders->filter(function ($lender) use ($loan_amt) {

                $minLoan = (float) $lender->min_loan_amount;
                $maxLoan = (float) $lender->max_loan_amount;
                $leewayMin = $minLoan * 0.80;
                $leewayMax = $maxLoan * 1.20;
                return ($loan_amt >= $leewayMin && $loan_amt <= $leewayMax);
            });
        }

        return response()->json($lenders);
    }
}
