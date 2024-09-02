<?php

namespace DTIC\MSP\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use DTIC\MSP\App\Models\TauxAccroissement;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccroissementController extends Controller
{
    public function accroissements()
    {
        $accroissements = TauxAccroissement::all();
        return response()->json([
            "success" => true,
            "message" => "Listes des indicateurs",
            "data" => $accroissements,
        ], 200);
    }

    public function findOne($id)
    {
        $accroissements = TauxAccroissement::find($id);
        if ($accroissements == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun TauxAccroissement trouvé"
            ], 404);
        }
        return response()->json([
            "success" => true,
            "message" => "l'indicateur a été trouvé",
            "data" => $accroissements
        ], 200);
    }

    // ajout
    public function create(Request $request)
    {

        $rules = [
            'taux_ap' => 'numeric|nullable',
            'statut_taux_ap' => 'in:actif,inactif|nullable',
            'date_valeur' => 'date|nullable',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => collect($validator->errors())->flatten(),
            ], 500);
        }

        try {
            $accroissements = new TauxAccroissement();
            $accroissements->taux_ap = $request->taux_ap;
            $accroissements->statut_taux_ap = $request->statut_taux_ap;
            $accroissements->date_valeur = $request->date_valeur;
            $accroissements->save();
            return response()->json([
                "success" => true,
                "message" => "taux_accroissements créé avec succès",
                "data" => $accroissements
            ], 201);
        } catch (Exception $e) {
            Log::channel("msp")->error($e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Une erreur est survenue"
            ], 500);
        }
    }
    public function update(Request $request, $id) // modification
    {

        $rules = [
            'taux_ap' => 'numeric|nullable',
            'statut_taux_ap' => 'in:actif,inactif|nullable',
            'date_valeur' => 'date|nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => collect($validator->errors())->flatten(),
            ], 500);
        }

        $accroissements = TauxAccroissement::find($id);

        if ($accroissements == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun taux_accroissements trouvé"
            ], 404);
        }

        try {
            $accroissements->taux_ap = $request->taux_ap;
            $accroissements->statut_taux_ap = $request->statut_taux_ap;
            $accroissements->date_valeur = $request->date_valeur;
            $accroissements->save();
            return response()->json([
                "success" => true,
                "message" => "taux_accroissements modifié avec succès",
                "data" => $accroissements
            ], 202);
        } catch (Exception $e) {
            Log::channel("msp")->error($e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Une erreur est survenue"
            ], 500);
        }
    }
    // suppression
    public function destroy($id)
    {
        $accroissements = TauxAccroissement::find($id);

        if ($accroissements == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun indicateur trouvé"
            ], 404);
        }

        $accroissements->delete();
        return response()->json([
            "success" => true,
            "message" => "taux_accroissements supprimé avec succès"
        ], 200);
    }
}
