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
use App\Models\Address;
use App\Models\Client;
use App\Models\Company;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    // public $dniService;

    // public function __construct(Eldni $service)
    // {
    //     $this->dniService = $service;
    // }

    public function index(Request $request)
    {
        $clients = Client::orderBy('id', 'DESC')->get();

        return response()->json(compact('clients'));
    }

    public function save(Request $request)
    {

        DB::beginTransaction();
        try {

            $iniciales = $request->commercial_name;
            $year = date('Y');

            $code = $year;

            $bts = BusinessType::whereIn('id', $request->arrTypeBusiness)->get();

            foreach (explode(" ", $iniciales) as $key => $value) {
                $code .= substr($value, 0, 2);
            }

            foreach ($bts as $key => $bt) {
                $code .= $bt->code;
            }

            $address = Address::create([
                'direction' => $request->address,
                'department' => $request->department_id,
                'district' => $request->district_id,
                'province' => $request->province_id,
                'reference' => $request->reference,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            // $company = Company::create([
            //     'social_reason' => $request->social_reason,
            //     'commercial_name' => $request->commercial_name,
            //     'address_id' => $address->id,
            //     'created_by' => auth()->user()->id,
            //     'updated_by' => auth()->user()->id,
            // ]);

            $people = collect([]);

            // foreach ($request->persons as $key => $value) {

            //     $person = Person::create(
            //         ['name' => $value["name"]],
            //         ['last_name' => $value["last_name"]],
            //         ['created_by' => auth()->user()->id],
            //         ['updated_by' => auth()->user()->id],
            //     );

            //     $person->kind_people()->attach($value['kind_of']);

            //     Phone::create([
            //         'phone_number' => $value['phone'],
            //         'person_id' => $person->id,
            //         'created_by' => auth()->user()->id,
            //         'updated_by' => auth()->user()->id,
            //     ]);

            //     Email::create([
            //         'name' => $value['email'],
            //         'person_id' => $person->id,
            //         'created_by' => auth()->user()->id,
            //         'updated_by' => auth()->user()->id,
            //     ]);

            //     $people->push($person);
            // }

            $client = Client::create([
                'ruc' => $request->ruc,
                'status_id' => 2,
                'code' =>  strtoupper($code),
                'is_harvester' => $request->isHarvester,
                'note' => $request->notes,
                'company_id' => $company->id,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $client->business_types()->attach($bts);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'cliente creado correctamente'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
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
        $client = new GuzzleHttpClient(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
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

        $client = new GuzzleHttpClient(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

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
