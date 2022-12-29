<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Profile;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // GET LOS PROFILES DONDE USER PERTENECE
        $profile = Profile::orderBy('id', 'DESC')->first();
        $message = 'Perfil de la empresa';
        return response(compact('profile', 'message'));
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
            if ($id == 0) { // nuevo profile



                $profile = Profile::create([
                    'ruc' => $request->ruc,
                    'social_reason' => $request->social_reason,
                    'commercial_name' => $request->commercial_name,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);

                Address::create([
                    'direction' => $request->address,
                    'department' => $request->department_id,
                    'province' => $request->province_id,
                    'district' => $request->district_id,
                    'profile_id' => $profile->id,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);
            } else {
                $profile = Profile::find($id);

                if ($profile) {
                    $profile->addresses->update([
                        'direction' => $request->address,
                        'department' => $request->department_id,
                        'province' => $request->province_id,
                        'district' => $request->district_id,
                        'updated_by' => auth()->user()->id,
                    ]);

                    $profile->update([
                        'ruc' => $request->ruc,
                        'social_reason' => $request->social_reason,
                        'commercial_name' => $request->commercial_name,
                        'updated_by' => auth()->user()->id,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Perfil ' . ($id == 0 ? 'creado' : 'actualizado') . ' correctamente'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' =>  false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
