<?php

namespace DTIC\MSP\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use DTIC\MSP\App\Models\Indicateur;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class IndicateurController extends Controller
{
    public function indicateurs(){
        $indicateurs =Indicateur::all();
        return response()->json([
            "success"=>true,
            "message"=>"listes des indicateurs",
            "data"=>$indicateurs,
        ],200);
        
       
    }
}