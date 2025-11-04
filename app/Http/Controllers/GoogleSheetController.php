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
            $client = new Client();
            $client->setApplicationName('Laravel Google Sheets');
            $client->setScopes([Sheets::SPREADSHEETS]);
            $client->setAuthConfig(storage_path('app/google/credentials.json'));
            $client->setAccessType('offline');

            $service = new Sheets($client);
            $spreadsheetId = env('GOOGLE_SHEET_ID');

            // --- Extract data from request ---
            $monthlyIncomeArr = $request->input('monthly_income', []);
            $monthlyTurnoverArr = $request->input('monthly_turnover', []);
            $dishonoursArr = $request->input('dishonours', []);
            $annualIncome = $request->input('annual_income', 0);
            $annualTurnover = $request->input('annual_turnover', 0);

            // Ensure arrays have exactly 6 columns (pad if shorter)
            $monthlyIncomeArr = array_pad($monthlyIncomeArr, 6, 0);
            $monthlyTurnoverArr = array_pad($monthlyTurnoverArr, 6, 0);
            $dishonoursArr = array_pad($dishonoursArr, 6, 0);

            // --- 1️⃣ Update Monthly Income (Row 2, D–I)
            $service->spreadsheets_values->update(
                $spreadsheetId,
                'Sheet1!D2:I2',
                new Sheets\ValueRange(['values' => [$monthlyIncomeArr]]),
                ['valueInputOption' => 'RAW']
            );

            // --- 2️⃣ Update Monthly Turnover (Row 3, D–I)
            $service->spreadsheets_values->update(
                $spreadsheetId,
                'Sheet1!D3:I3',
                new Sheets\ValueRange(['values' => [$monthlyTurnoverArr]]),
                ['valueInputOption' => 'RAW']
            );

            // --- 3️⃣ Annual Income (Row 4, C4)
            $service->spreadsheets_values->update(
                $spreadsheetId,
                'Sheet1!C4',
                new Sheets\ValueRange(['values' => [[$annualIncome]]]),
                ['valueInputOption' => 'RAW']
            );

            // --- 4️⃣ Annual Turnover (Row 5, C5)
            $service->spreadsheets_values->update(
                $spreadsheetId,
                'Sheet1!C5',
                new Sheets\ValueRange(['values' => [[$annualTurnover]]]),
                ['valueInputOption' => 'RAW']
            );

            // --- 5️⃣ Dishonours (Row 6, D–I)
            $service->spreadsheets_values->update(
                $spreadsheetId,
                'Sheet1!D6:I6',
                new Sheets\ValueRange(['values' => [$dishonoursArr]]),
                ['valueInputOption' => 'RAW']
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Data added successfully to Google Sheet.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
