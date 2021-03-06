<?php

namespace App\Http\Requests\GestionPoubelleEtablissements;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class EtablissementRequest extends FormRequest{
    public function authorize()
    {
        return true;
    }
    public function rules()  {
        if ($this->isMethod('post')) {
            return [
                'zone_travail_id' => 'required',
                'responsable_etablissement_id' => 'required|unique:etablissements',
                'nom_etablissement' => 'required|string',
                'type_etablissement'=>'required',Rule::in(['primaire','college','secondaire','universite','societe']),
                'nbr_personnes' => 'required',
                'url_map'=>'required',
                'adresse' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'quantite_dechets_plastique' => 'required|between:0,99999999.99',
                'quantite_dechets_composte'=> 'required|between:0,99999999.99',
                'quantite_dechets_papier'=> 'required|between:0,99999999.99',
                'quantite_dechets_canette'=> 'required|between:0,99999999.99',

            ];
        }else if($this->isMethod('PUT')){
            return [
            //     'zone_travail_id' => 'required',
            //     'responsable_etablissement_id' => 'required',
            //     'nom_etablissement' => 'required|sring',
            //     'type_etablissement' => 'required|sring',
            //     'nbr_personnes',
            //      'url_map'=>'required',
            //     'adresse' => 'required|string',
            //     'longitude' => 'required',
            //     'latitude' => 'required',
            //     'quantite_dechets_plastique' => 'required|between:0,99999999.99',
            //     'quantite_dechets_composte'=> 'required|between:0,99999999.99',
            //     'quantite_dechets_papier'=> 'required|between:0,99999999.99',
            //     'quantite_dechets_canette'=> 'required|between:0,99999999.99',

             ];
        }
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
    }
}
