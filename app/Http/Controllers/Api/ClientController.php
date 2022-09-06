<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use App\Models\Department;
use App\Models\District;
use App\Models\KindPerson;
use App\Models\Province;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getBusinessType()
    {
        $data = BusinessType::all();
        return response()->json($data);
    }
    public function getKingOfPeople()
    {
        return response()->json([
            'king_persons' => KindPerson::all()
        ]);
    }
    public function getInfoToAddress()
    {
        return response()->json([
            'departments' => Department::orderBy('name', 'ASC')->get(),
            'districts' => District::orderBy('name', 'ASC')->get(),
            'provinces' => Province::orderBy('name', 'ASC')->get(),
        ]);
    }
}
