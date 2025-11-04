<?php



namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\LuhnHelper;



class AbnController extends Controller
{
    private $guid = 'ebae7e7b-47d7-424b-8a36-f7af9ad057d4';

    public function lookup(Request $request)
    {
        $query = $request->get('query');

        if (!$query || strlen($query) < 3) {
            return response()->json([]);
        }

        $response = Http::get("https://abr.business.gov.au/json/MatchingNames.aspx", [
            'name' => $query,
            'guid' => $this->guid,
        ]);

        $raw = $response->body();

        // Strip non-JSON characters (ABR wraps JSON in brackets, e.g. `callback(...)`)
        $json = json_decode(str_replace(["callback(", ")"], '', $raw), true);

        if (!isset($json['Names'])) {
            return response()->json([]);
        }

        return response()->json($json['Names']);
    }

    public function details(Request $request)
    {
        $abn = $request->get('abn');

        if (!$abn || strlen($abn) < 11) {
            return response()->json(['error' => 'Invalid ABN']);
        }

        $response = Http::get("https://abr.business.gov.au/json/AbnDetails.aspx", [
            'abn' => $abn,
            'guid' => $this->guid,
        ]);

        $raw = $response->body();
        $json = json_decode(str_replace(["callback(", ")"], '', $raw), true);

        return response()->json($json);
    }

    public function fetch_bank_statement(Request $request)
    {
        // 1. Validate document_id
        $validated = $request->validate([
            'document_id' => 'required|string',
        ]);

        // 2. Get values
        $documentId = $validated['document_id'];

        // Initialize the LuhnHelper with the necessary parameters
        $alphabet = 'BCDFGHJKMNPQRSTVWXYZ23456789';  // Alphabet as per client request
        $codeLength = 9; // Assuming length is 9 (can be changed based on your requirements)
        $lh = new LuhnHelper($codeLength, $alphabet);

        // 3. Validate the Document ID
        if (!$lh->validateChecksum($documentId)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Document ID format.Please enter valid Document ID.',
            ], 400);  // Return a 400 Bad Request for invalid Document ID
        }

        // 4. If the Document ID is valid, proceed with the API call
        $referralCode = env('REFERRAL_CODE');
        $apiKey = env('TEST_API_KEY');

        // 5. Build API URL
        $url = "https://dashboard-test.proviso.com.au/api/v1/get-submission/{$documentId}/{$referralCode}?returnDocument=true";

        try {
            // 6. Make the API request
            $response = Http::withHeaders([
                'X-API-KEY'    => $apiKey,
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ])->get($url);

            // 7. Return JSON response
            return response()->json([
                'success' => true,
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            // 8. Handle error
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch bank statement.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
