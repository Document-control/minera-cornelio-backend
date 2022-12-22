<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::orderBy('id')->get();
        return response()->json(compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            Document::create(['name' => $request->name]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Documento creado correctamente'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
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
        DB::beginTransaction();
        try {
            $document = Document::where('id', $id)->update(['name' => $request->name]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Documento {$document->name} creado correctamente"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // VALIDAR SI YA EXISTE DOCUMENT ASIGNADOS AL CLIENTE
    }
}
