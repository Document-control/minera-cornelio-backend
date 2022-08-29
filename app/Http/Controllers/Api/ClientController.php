<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getBusinessType()
    {
        $data = BusinessType::all();
        return response()->json($data);
    }
}
