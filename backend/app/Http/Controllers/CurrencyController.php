<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

       /**
        * @OA\Get(
        *      path="/api/currency",
        *      operationId="getcurrencies",
        *      tags={"Currency"},
        *      summary="get all currencies",
        *      description="get all currencies",
        *
        *      @OA\Response(
        *          response=200,
        *          description="Successful fetch operation",
        *       )
        *
        *     )
     */
public function index()
{
    $currencies = Currency::all();

       return response()->json([
            'result' => 1,
            'data' => [
                'currencies'=> $currencies
            ],
            'message' => 'Currencies retrieved Successfully',
        ], 200);
}
}
