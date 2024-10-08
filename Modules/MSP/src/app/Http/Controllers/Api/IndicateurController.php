<?php

namespace DTIC\MSP\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use DTIC\MSP\App\Models\Indicateur;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class IndicateurController extends Controller
{
    public function indicateurs()
    {
        $indicateurs = Indicateur::all();
        return response()->json([
            "success" => true,
            "message" => "Listes des indicateurs",
            "data" => $indicateurs,
        ], 200);
    }
    public function findOne($id)
    {
        $indicateurs = Indicateur::find($id);
        if ($indicateurs == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun indicateur trouvé"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "l'indicateur a été trouvé",
            "data" => $indicateurs
        ], 200);
    }
    // ajout
    public function create(Request $request)
    {

        $rules = [
            'nom_indicateur' => 'string|nullable',
            'description_indicateur' => 'string|nullable',
            'formule_de_calcul' => 'string|nullable',
            'etat_indicateur' => 'in:actif,inactif|nullable',
            'type_indicateur' => 'in:general,individuel|nullable',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => collect($validator->errors())->flatten(),
            ], 500);
        }

        try {
            $indicateur = new Indicateur;
            $indicateur->nom_indicateur = $request->nom_indicateur;
            $indicateur->description_indicateur = $request->description_indicateur;
            $indicateur->formule_de_calcul = $request->formule_de_calcul;
            $indicateur->etat_indicateur = $request->etat_indicateur;
            $indicateur->type_indicateur = $request->type_indicateur;
            $indicateur->save();
            return response()->json([
                "success" => true,
                "message" => "indicateur créé avec succès",
                "data" => $indicateur
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
            'nom_indicateur' => 'string|nullable',
            'description_indicateur' => 'string|nullable',
            'formule_de_calcul' => 'string|nullable',
            'etat_indicateur' => 'in:actif,inactif|nullable',
            'type_indicateur' => 'in:general,individuel|nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => collect($validator->errors())->flatten(),
            ], 500);
        }

        $indicateurs = Indicateur::find($id);

        if ($indicateurs == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun indicateur trouvé"
            ], 404);
        }

        try {
            $indicateurs->nom_indicateur = $request->nom_indicateur;
            $indicateurs->description_indicateur = $request->description_indicateur;
            $indicateurs->formule_de_calcul = $request->formule_de_calcul;
            $indicateurs->etat_indicateur = $request->etat_indicateur;
            $indicateurs->type_indicateur = $request->type_indicateur;
            $indicateurs->save();
            return response()->json([
                "success" => true,
                "message" => "Indicateurs modifié avec succès",
                "data" => $indicateurs
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
        $indicateurs = Indicateur::find($id);

        if ($indicateurs == null) {
            return response()->json([
                "success" => false,
                "message" => "Aucun indicateur trouvé"
            ], 404);
        }

        $indicateurs->delete();
        return response()->json([
            "success" => true,
            "message" => "indicateur supprimé avec succès"
        ], 200);
    }
}
