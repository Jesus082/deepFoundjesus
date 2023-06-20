<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MapaController extends Controller
{
    public function index()
    {
        return view('mapa');
    }

    public function search(Request $request)
    {
        $client = new Client();

        $query = $request->input('query');

        $response = $client->request('GET', 'https://api.geoapify.com/v1/geocode/search', [
            'query' => [
                'text' => $query,
                'apiKey' => '25648cc72e764add980334476be7eff3',
            ],
        ]);

        $places = json_decode($response->getBody())->features;

        return response()->json($places);
    }
}
