<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use App\Models\Department;
use App\Models\District;
use App\Models\KindPerson;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Services\Eldni;
use GuzzleHttp\Client;

class ClientController extends Controller
{

    public $dniService;

    public function __construct(Eldni $service)
    {
        $this->dniService = $service;
    }
    public function save()
    {
        return 'hola nuevo cliente';
    }
    public function getBusinessType()
    {
        $data = BusinessType::all();
        return response()->json($data);
    }
    public function getKingOfPeople()
    {
        return response()->json(KindPerson::all());
    }
    public function getInfoToAddress()
    {
        return response()->json([
            'departments' => Department::orderBy('name', 'ASC')->get(),
            'districts' => District::orderBy('name', 'ASC')->get(),
            'provinces' => Province::orderBy('name', 'ASC')->get(),
        ]);
    }
    public function getInfoFromDni(Request $request)
    {
        // $data = collect($this->dniService->get_name($request->nro_doc))->values();
        $token = 'apis-token-2916.R0BrPlBD2-xz2HNYFQ1O4SxbwWJ2zqxP';
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Referer' => 'https://apis.net.pe/api-consulta-dni',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $request->nro_doc]
        ];
        // return $parameters;
        $res = $client->request('GET', '/v1/dni', $parameters);
        $resp = json_decode($res->getBody()->getContents(), true);
        return response()->json($resp, 200);
    }
    public function getInfoRuc(Request $request)
    {
        $token = 'apis-token-2916.R0BrPlBD2-xz2HNYFQ1O4SxbwWJ2zqxP';

        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Referer' => 'https://apis.net.pe/api-consulta-ruc',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $request->nro_ruc]
        ];
        $res = $client->request('GET', '/v1/ruc', $parameters);
        $resp = json_decode($res->getBody()->getContents(), true);

        return response()->json($resp, 200);
    }
}
