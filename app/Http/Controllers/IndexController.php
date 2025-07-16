<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\App;

use App\Models\LenderModel;

class IndexController extends Controller
{

    public function index()
    {

        $trading_times = LenderModel::select('trading_time')->groupBy('trading_time')->get();
        $loan_formats = LenderModel::select('loan_format')->groupBy('loan_format')->get();
        $loan_terms = LenderModel::select('loan_term')->groupBy('loan_term')->get();

        return view('Index.index', compact('trading_times', 'loan_formats', 'loan_terms'));
    }

    public function index_test()
    {
        return view('Index.index2');
    }

    public function get_lenders(Request $request)
    {
        // Initialize the query for all lenders
        $query = LenderModel::query();

        // Apply filters if the values are provided in the request
        if ($request->has('trading_time') && $request->trading_time != '') {
            $query->where('trading_time', $request->trading_time);
        }

        if ($request->has('abn_gst') && $request->abn_gst != '') {
            $query->where('GST_registration', $request->abn_gst);
        }

        if ($request->has('annual_revenue') && $request->annual_revenue != '') {
            $cleanedRevenue = preg_replace('/[^0-9.]/', '', $request->annual_revenue);
            $query->whereRaw('CAST(annual_revenue AS DECIMAL(10,2)) <= ?', [$cleanedRevenue]);
        }
        if ($request->has('net_income') && $request->net_income != '') {
            $cleanedIncome = preg_replace('/[^0-9.]/', '', $request->net_income);
            $query->whereRaw('CAST(net_income AS DECIMAL(10,2)) <= ?', [$cleanedIncome]);
        }

        if ($request->has('credit_score') && $request->credit_score != '') {
            $cleanedScore = preg_replace('/[^0-9.]/', '', $request->credit_score);
            $query->whereRaw('CAST(credit_score AS DECIMAL(10,2)) <= ?', [$cleanedScore]);
        }

        if ($request->has('min_loan_amount') && $request->min_loan_amount != '') {
            $cleanedmin_loan_amt = preg_replace('/[^0-9.]/', '', $request->credit_score);
            $query->whereRaw('CAST(min_loan_amount AS DECIMAL(10,2)) <= ?', [$cleanedmin_loan_amt]);
        }

        if ($request->has('max_loan_amount') && $request->max_loan_amount != '') {
            $cleanedmax_loan_amt = preg_replace('/[^0-9.]/', '', $request->credit_score);
            $query->whereRaw('CAST(max_loan_amount AS DECIMAL(10,2)) <= ?', [$cleanedmax_loan_amt]);
        }

        if ($request->has('loan_format') && $request->loan_format != '') {
            $query->where('loan_format', $request->loan_format);
        }

        if ($request->has('financials') && $request->financials != '') {
            $query->where('financials', 'LIKE', '%' . $request->financials . '%'); // Assuming this is a text search
        }

        if ($request->has('loan_term') && $request->loan_term != '') {
            $query->where('loan_term', $request->loan_term);
        }

        // Get the filtered results
        $lenders = $query->get();

        // Return the lenders as a JSON response
        return response()->json($lenders);
    }
}
