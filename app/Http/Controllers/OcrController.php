<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ParsingResultService;

class OcrController extends Controller
{
    public function store(Request $request)
    {
        $parsedResult = $request->all();

        $data = ParsingResultService::store($parsedResult);

        return response()->json([
            'message' => 'Parsing result saved',
            'data' => $data
        ]);
    }
}
