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
        // $data = [
        //     'document' => $request->nro_doc
        // ];

        // if ($request->user) {
        //     Validator::make($data, [
        //         'document' => 'required|max:255|unique:users,document,' . $request->nIdCliente
        //     ])->validate();
        // } else {
        //     Validator::make($data, [
        //         'document' => 'required|max:255|unique:customers,document,' . $request->nIdCliente
        //     ])->validate();
        // }

        $token = env('TOKEN_APIS_NET');
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

        try {
            $res = $client->request('GET', '/v1/dni', $parameters);
            $resp = json_decode($res->getBody()->getContents(), true);
            if (isset($resp)) {
                $data = [
                    'names' => ucwords(strtolower($resp['nombres'])),
                    'last_names' => ucwords(strtolower($resp['apellidoPaterno'] . ' ' . $resp['apellidoMaterno']))
                ];
                return response()->json($data, 200);
            } else {
                return response()->json('Los caracteres ingresados no son correctos', 404);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function getInfoRuc(Request $request)
    {
        $token = env('TOKEN_APIS_NET');

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
