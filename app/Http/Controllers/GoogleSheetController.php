<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Sheets;
use Illuminate\Http\Request;

class GoogleSheetController extends Controller
{
    public function storeIllionData(Request $request)
    {
        try {
            // --- Google client setup ---
            $client = new Client();
            $client->setApplicationName('Laravel Google Sheets');
            $client->setScopes([Sheets::SPREADSHEETS]);
            $client->setAuthConfig(storage_path('app/google/credentials.json'));
            $client->setAccessType('offline');

            $service = new Sheets($client);
            $spreadsheetId = env('GOOGLE_SHEET_ID');

            // --- Request inputs ---
            $documentId = trim($request->input('document_id'));
            $monthlyIncomeArr = array_pad($request->input('monthly_income', []), 6, 0);
            $monthlyTurnoverArr = array_pad($request->input('monthly_turnover', []), 6, 0);
            $dishonoursArr = array_pad($request->input('dishonours', []), 6, 0);
            $annualIncome = $request->input('annual_income', 0);
            $annualTurnover = $request->input('annual_turnover', 0);


            $non_sacc_loans         = $request->input('non_sacc_loans');
            $ongoing_non_sacc_loans = $request->input('ongoing_non_sacc_loans');
            $sacc_loans = $request->input('sacc_loans');
            $ongoing_sacc_loans = $request->input('ongoing_sacc_loans');
            $cashflow_loans = $request->input('cashflow_loans');


            $overdraw_count = $request->input('overdraw_count');
            $overdraw_30 = $request->input('overdraw_30');
            $overdraw_90  = $request->input('overdraw_90');
            $overdraw_180 = $request->input('overdraw_180');

            $daysNegTotal = $request->input('daysNegTotal');
            $daysNeg30 = $request->input('daysNeg30');
            $daysNeg60 = $request->input('daysNeg60');
            $daysNeg90 = $request->input('daysNeg90');
            $daysNeg120 = $request->input('daysNeg120');
            $daysNeg150 = $request->input('daysNeg150');
            $daysNeg180 = $request->input('daysNeg180');

            // $output = [
            //     'daysNegTotal' => $daysNegTotal,
            //     'daysNeg30' => $daysNeg30
            // ];

            // return response()->json($output);
            // die;

            $daysUnder500Total = $request->input('daysUnder500Total');
            $under500_60 = $request->input('under500_60');
            $under500_30 = $request->input('under500_30');
            $under500_90 = $request->input('under500_90');
            $under500_120 = $request->input('under500_120');
            $under500_150 = $request->input('under500_150');
            $under500_180 = $request->input('under500_180');


            $cash_flow_loans_count = $request->input('cash_flow_loans_count');






            // --- Fetch all rows (we only need column A to check document IDs) ---
            $response = $service->spreadsheets_values->get($spreadsheetId, 'Sheet1!A:A');
            $rows = $response->getValues() ?? [];

            // Find existing document row if exists
            $existingRow = null;
            foreach ($rows as $index => $row) {
                if (isset($row[0]) && trim($row[0]) === $documentId) {
                    $existingRow = $index + 1; // Google Sheets row numbers start at 1
                    break;
                }
            }

            // , $daysNeg30, $daysNeg60, $daysNeg90, $daysNeg120, $daysNeg150, $daysNeg180

            // --- Prepare data block (5 rows) ---
            $dataRows = [
                [$documentId, 'Monthly Income', 'BF002: All Credits Excluding Internal Transfers - Sum Amount by 30 Day Periods', '', ...$monthlyIncomeArr],
                ['', 'Monthly Turnover', 'BM001: Business turn over - Sum 30 day periods', '', ...$monthlyTurnoverArr],
                ['', 'Annual Income', 'Use average monthly income multiplied by 12', $annualIncome],
                ['', 'Annual Turnover', 'Use average monthly income multiplied by 12', $annualTurnover],
                ['', 'Dishonours', 'EBP009: Dishonours - Count by 30 Day Periods', '', ...$dishonoursArr],
                ['', 'Days in Negative', 'raw data(number of days where ending balnce < $0)', $daysNegTotal, $daysNeg30, $daysNeg60, $daysNeg90, $daysNeg120, $daysNeg150, $daysNeg180],
                ['', 'Non SACC loans', 'DM079: Number of Non-SACC loans', $non_sacc_loans],
                ['', ' Ongoing Non SACC loans', 'DM090: Number of ongoing Non SACC loans', $ongoing_non_sacc_loans],
                ['', ' Number of SACC loans', 'DM091: Number of SACC loans', $sacc_loans],
                ['', ' Number of ongoing SACC loans', 'DM042: Number of ongoing SACC loans', $ongoing_sacc_loans],
                ['', ' Number of cash flow lenders', 'BF017: Total Cash Flow Lenders (Count)', $cashflow_loans],
                ['', ' Number of existing cash flow loans', 'raw-data - Count of loans from any of these lenders: Dynamoney, Shift,
                 Lumi, Moula, Money Pty Ltd, Prospa, On Deck, Scotpac,
                  Business Fuel, Finance One, BIGGA, Bizcap,Capify, Rapital,
                  Trucap, Bizfund, Skyecap, Funds Now, Banjo, Moneytech, 
                  Lendmigo, Earlypay', $cash_flow_loans_count],
                ['', ' EOD balance < $500', 'raw data - Number of days where balance is <$500', $daysUnder500Total, $under500_30, $under500_60, $under500_90, $under500_120, $under500_150, $under500_180],
                ['', ' Number of overdrawns', 'AB006: Overdrawn - Count', $overdraw_count],
                ['', ' Number of Overdrawn fees (Past 30 days)', 'FN006: Overdrawn Fees Count (Last 30 Days)', $overdraw_30],
                ['', ' Number of Overdrawn fees (Past 90 days)', 'FN007: Overdrawn Fees Count (Last 90 Days)', $overdraw_90],
                ['', ' Number of Overdrawn fees (Past 180 days)', 'FN008: Overdrawn Fees Count (Last 180 Days)', $overdraw_180],

            ];

            if ($existingRow) {
                // ✅ Update existing data (overwrite 5 rows)
                $range = "Sheet1!A{$existingRow}:J" . ($existingRow + 4);
                $body = new Sheets\ValueRange(['values' => $dataRows]);
                $service->spreadsheets_values->update(
                    $spreadsheetId,
                    $range,
                    $body,
                    ['valueInputOption' => 'RAW']
                );

                $message = "Existing document ID '{$documentId}' updated successfully.";
            } else {
                // ✅ Add 2 blank rows and then append the new data
                $gapRows = [
                    ['', '', '', '', '', '', '', '', '', ''],
                    ['', '', '', '', '', '', '', '', '', ''],
                ];

                $allRows = array_merge($gapRows, $dataRows);
                $body = new Sheets\ValueRange(['values' => $allRows]);

                $service->spreadsheets_values->append(
                    $spreadsheetId,
                    'Sheet1!A:A',
                    $body,
                    ['valueInputOption' => 'RAW']
                );

                $message = "New document data added successfully with a 2-row gap.";
            }

            return response()->json([
                'status' => 'success',
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
