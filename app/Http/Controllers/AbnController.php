<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
}
