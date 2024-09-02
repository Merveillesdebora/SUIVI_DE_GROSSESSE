<?php

namespace DTIC\MSP\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use DTIC\MSP\App\Models\TauxAnnuel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AnnuelController extends Controller
{
    public function annuels()
    {
        $annuels = TauxAnnuel::all();
        return response()->json([
            "success" => true,
            "message" => "Listes des Annuels",
            "data" => $annuels,
        ], 200);
    }

    public function findOne($id)
    {
        $annuels = TauxAnnuel::find($id);
        if ($annuels == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun taux_annuel_indicateurs trouvé"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "le taux_annuel_indicateurs a été trouvé",
            "data" => $annuels
        ], 200);
    }
    public function create(Request $request)
    {

        $rules = [
            'taux_indicateur' => 'numeric|nullable',
            'date_valeur' => 'date|nullable',
            'statut_taux_indicateur' => 'in:actif,inactif|nullable',
            'id_indicateur' => 'exists:indicateurs,id|nullable',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => collect($validator->errors())->flatten(),
            ], 500);
        }

        try {
            $annuels = new TauxAnnuel;
            $annuels->taux_indicateur = $request->taux_indicateur;
            $annuels->date_valeur = $request->date_valeur;
            $annuels->statut_taux_indicateur = $request->statut_taux_indicateur;
            $annuels->id_indicateur = $request->id_indicateur;
            $annuels->save();
            return response()->json([
                "success" => true,
                "message" => "taux_annuel_indicateurs créé avec succès",
                "data" => $annuels
            ], 201);
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
        $annuels = TauxAnnuel::find($id);

        if ($annuels == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun taux_annuel_indicateurs   trouvé"
            ], 404);
        }

        $annuels->delete();
        return response()->json([
            "success" => true,
            "message" => " taux_annuel_indicateurs  supprimé avec succès"
        ], 200);
    }
    public function update(Request $request, $id) // modification
    {

        $rules = [
            'taux_indicateur' => 'numeric|nullable',
            'date_valeur' => 'date|nullable',
            'statut_taux_indicateur' => 'in:actif,inactif|nullable',
            'id_indicateur' => 'exists:indicateurs,id|nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => collect($validator->errors())->flatten(),
            ], 500);
        }

        $annuels = TauxAnnuel::find($id);

        if ($annuels == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun taux_annuel_indicateurs trouvé"
            ], 404);
        }

        try {
            $annuels->taux_indicateur = $request->taux_indicateur;
            $annuels->date_valeur = $request->date_valeur;
            $annuels->statut_taux_indicateur = $request->statut_taux_indicateur;
            $annuels->id_indicateur = $request->id_indicateur;
            $annuels->save();
            return response()->json([
                "success" => true,
                "message" => "taux_annuel_indicateurs modifié avec succès",
                "data" => $annuels
            ], 202);
        } catch (Exception $e) {
            Log::channel("msp")->error($e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Une erreur est survenue"
            ], 500);
        }
    }
}
