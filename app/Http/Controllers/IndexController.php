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
                'main_lender_tables.lender_logo'
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

        if ($request->has('loan_amt') && $request->loan_amt != '') {
            $loan_amt = preg_replace('/[^0-9.]/', '', $request->loan_amt);

            $query->whereRaw('CAST(min_loan_amount AS DECIMAL(10,2)) <= ?', [$loan_amt])
                ->whereRaw('CAST(max_loan_amount AS DECIMAL(10,2)) >= ?', [$loan_amt]);
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
            $restricted_industries = array_map('trim', $request->restricted_industry); // keep original casing

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











        if ($request->has('annual_revenue') && $request->annual_revenue != '') {
            $cleanedRevenue = preg_replace('/[^0-9.]/', '', $request->annual_revenue);
            $query->whereRaw('CAST(annual_revenue AS DECIMAL(10,2)) <= ?', [$cleanedRevenue]);
        }
        if ($request->has('net_income') && $request->net_income != '') {
            $net_income = preg_replace('/[^0-9.]/', '', $request->net_income);
            $query->whereRaw('CAST(net_income AS DECIMAL(10,2)) <= ?', [$net_income]);
        }

        // if ($request->has('loan_format') && $request->loan_format != '') {
        //     $query->where('loan_format', $request->loan_format);
        // }

        // if ($request->has('financials') && $request->financials != '') {
        //     $query->where('financials', 'LIKE', '%' . $request->financials . '%'); // Assuming this is a text search
        // }

        // if ($request->has('loan_term') && $request->loan_term != '') {
        //     $query->where('loan_term', $request->loan_term);
        // }
        // if ($request->has('bank_statements') && $request->bank_statements != '') {
        //     $query->where('bank_statement_type', '>=', $request->bank_statements);
        // }

        // if ($request->has('age_of_applicant') && $request->age_of_applicant != '') {
        //     $age_of_applicant = preg_replace('/[^0-9.]/', '', $request->age_of_applicant);
        //     $query->whereRaw('CAST(age_of_applicant AS DECIMAL(10,2)) <= ?', [$age_of_applicant]);
        // }

        // if ($request->has('interest_rate') && $request->interest_rate != '') {
        //     $interest_rate = preg_replace('/[^0-9.]/', '', $request->interest_rate);
        //     $query->whereRaw('CAST(interest_rate AS DECIMAL(10,2)) <= ?', [$interest_rate]);
        // }

        // if ($request->has('Guarantee') && $request->Guarantee != '') {
        //     if ($request->Guarantee == 'Yes') {
        //         $query->whereNotNull('guarantee_type');
        //     } elseif ($request->Guarantee == 'No') {
        //         $query->whereNull('guarantee_type');
        //     }
        // }

        // if ($request->has('GuaranteeType') && $request->GuaranteeType != '') {
        //     if ($request->Guarantee == 'Yes') {
        //         $guaranteeType = $request->GuaranteeType;

        //         $query->whereJsonContains('guarantee_type', $guaranteeType);
        //     }
        // }

        // if ($request->has('Financials') && $request->Financials != '') {
        //     if ($request->Financials == 'Yes') {
        //         $query->where('financial_docs', 'Yes');
        //     } elseif ($request->Financials == 'No') {
        //         $query->where('financial_docs', 'No');
        //     }
        // }

        // if ($request->has('decision_time') && $request->decision_time != '') {
        //     $decision_time = preg_replace('/[^0-9.]/', '', $request->decision_time);
        //     $query->whereRaw('CAST(decision_time AS DECIMAL(10,2)) <= ?', [$decision_time]);
        // }

        // if ($request->has('Repayment_Frequency') && $request->Repayment_Frequency != '') {

        //     $Repayment_Frequency = $request->Repayment_Frequency;
        //     $query->whereJsonContains('repayment_frequency', $Repayment_Frequency);
        // }

        // if ($request->has('EarlyRepayment') && $request->EarlyRepayment != '') {

        //     $query->where('early_payment', $request->EarlyRepayment);
        // }

        // if ($request->has('refinanceOption') && $request->refinanceOption != '') {

        //     $query->where('refinance_term', $request->refinanceOption);
        // }

        // if ($request->has('loan_amt') && $request->has('monthly_income')) {
        //     $loanAmount = (float) preg_replace('/[^0-9.]/', '', $request->loan_amount);
        //     $monthlyIncome = (float) preg_replace('/[^0-9.]/', '', $request->monthly_income);

        //     if ($monthlyIncome > 0) {
        //         $requiredLendingRatio = ($loanAmount / $monthlyIncome) * 100;

        //         $query->where('lending_ratio', '>=', $requiredLendingRatio);
        //     }
        // }

        // if ($request->has('brokerage') && $request->brokerage != '') {
        //     $brokerage = preg_replace('/[^0-9.]/', '', $request->brokerage);
        //     $query->whereRaw('CAST(brokerage AS DECIMAL(10,2)) <= ?', [$brokerage]);
        // }

        // if ($request->has('paydayLoans_option') && $request->paydayLoans_option != '') {
        //     if ($request->paydayLoans_option == 'Yes') {
        //         $query->where('payday_loan', '>=', 1);
        //     } elseif ($request->paydayLoans_option == 'No') {
        //         $query->where('payday_loan', '>=', 0);
        //     }
        // }

        // if ($request->has('paydayLoans_option') && $request->paydayLoans_option == 'Yes' && $request->has('payday_loan_count') &&  $request->payday_loan_count != '') {
        //     $payday_loan_count = preg_replace('/[^0-9.]/', '', $request->payday_loan_count);
        //     $query->whereRaw('CAST(payday_loan AS DECIMAL(10,2)) >= ?', [$payday_loan_count]);
        // }


        // if ($request->has('bankruptcy') && $request->bankruptcy != '') {
        //     if ($request->bankruptcy == 'Yes') {
        //         $query->where('bankruptcy_time', '>=', 1);
        //     } elseif ($request->bankruptcy == 'No') {
        //         $query->where('bankruptcy_time', '>=', 0);
        //     }
        // }

        // if ($request->has('bankruptcy') && $request->bankruptcy == 'Yes' && $request->has('bankruptcy_count') &&  $request->bankruptcy_count != '') {
        //     $bankruptcy_count = preg_replace('/[^0-9.]/', '', $request->bankruptcy_count);
        //     $query->whereRaw('CAST(bankruptcy_time AS DECIMAL(10,2)) <= ?', [$bankruptcy_count]);
        // }

        // if ($request->has('cashflow_loan') && $request->cashflow_loan != '') {
        //     if ($request->cashflow_loan == 'Yes') {
        //         $query->where('cash_flow_loan_count', '>=', 1);
        //     } elseif ($request->cash_flow_loan_count == 'No') {
        //         $query->where('cash_flow_loan_count', '>=', 0);
        //     }
        // }

        // if ($request->has('cashflow_loan') && $request->cashflow_loan == 'Yes' && $request->has('cashflow_loan_count') &&  $request->cashflow_loan_count != '') {
        //     $cashflow_loan_count = preg_replace('/[^0-9.]/', '', $request->cashflow_loan_count);
        //     $query->whereRaw('CAST(cash_flow_loan_count AS DECIMAL(10,2)) >= ?', [$cashflow_loan_count]);
        // }

        // if ($request->has('IndustryType') && $request->IndustryType != '') {
        //     $industryType = ucwords(strtolower(trim($request->IndustryType)));
        //     // e.g. "Property Development"
        //     $query->whereJsonContains('allowed_industry_type', [$industryType]);
        // }

        // if ($request->has('Loan_type') && $request->Loan_type != '') {
        //     $Loan_type = $request->Loan_type; // e.g. "Property Development"
        //     $query->whereRaw("LOWER(JSON_EXTRACT(loan_type, '$')) LIKE '%" . strtolower($Loan_type) . "%'");
        // }



        // From here the query is being executed and the results are being returned for updated form srtucture and db 











        if ($request->has('asset_backed') && $request->asset_backed != '') {
            if ($request->asset_backed == 'No') {
                $query->where('asset_backed', 'No');
            } elseif ($request->asset_backed == 'Yes') {
                $query->whereIn('asset_backed', ['Yes', 'No']);
            }
        }

        if ($request->has('cid') && !empty($request->cid)) {
            $ids = is_array($request->cid) ? $request->cid : explode(',', $request->cid);

            $ids = array_filter($ids, function ($id) {
                return is_numeric($id);
            });
            $query->whereIn('id', $ids);
        }

        $lenders = $query->get();
        return response()->json($lenders);
    }
}
