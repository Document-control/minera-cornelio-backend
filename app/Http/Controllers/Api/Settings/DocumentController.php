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
    public function index(Request $request)
    {
        $documents = Document::query()->orderBy('id', 'DESC')
            ->name($request->search)
            ->paginate(2);
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
        $request->validate([
            'name' => 'required|max:255|unique:documents,name'
        ]);

        DB::beginTransaction();
        try {
            Document::create([
                'name' => $request->name,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);
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
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $document = Document::find($id);
        return response()->json(compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => "required|max:255|unique:documents,name,{$id}"
        ]);

        DB::beginTransaction();
        try {
            $document = Document::findOrFail($id);
            $document->update([
                'name' => $request->name,
                'updated_by' => auth()->user()->id,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Documento {$document->name} creado correctamente"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
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

        DB::beginTransaction();
        try {
            $document = Document::findOrFail($id);

            $document->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Documento ' . $document->name . ' eliminado correctamente'
            ]);
            //code...
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
