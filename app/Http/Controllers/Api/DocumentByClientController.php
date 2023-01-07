<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Document;
use App\Models\DocumentClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentByClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $documents = DocumentClient::where('client_id', $id)
            ->join('documents as d', 'd.id', '=', 'document_clients.document_id')
            ->select('document_clients.id', 'document_clients.status', 'd.name')
            ->get();
        return response()->json(compact('documents'));
    }

    public function attachDocs(Request $request)
    {
        $request->validate([
            'client_id' => 'exists:clients,id'
        ]);

        $client = Client::find($request->client_id);

        // GENEAR LA LISTA DE DOCUMENTOS A COMPLETAR DEL CLIENTE
        $documents = Document::all();

        try {
            DB::beginTransaction();
            foreach ($documents as $key => $doc) {
                $doc_client = DocumentClient::where('document_id', $doc->id)->first();
                if (is_null($doc_client)) {
                    DocumentClient::create([
                        'client_id' => $client->id,
                        'document_id' => $doc->id,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                    ]);
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'documentos asignados correctamente'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 404);
        }
    }

    public function updatePhotos(int $id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
