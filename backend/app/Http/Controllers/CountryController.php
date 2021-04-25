<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

   /**
        * @OA\Get(
        *      path="/api/country",
        *      operationId="getcountries",
        *      tags={"Country"},
        *      summary="get all countries",
        *      description="get all countries",
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
    $countries = Country::all();

       return response()->json([
            'result' => 1,
            'data' => [
                'countries'=> $countries
            ],
            'message' => 'Countries retrieved Successfully',
        ], 200);
}
}
