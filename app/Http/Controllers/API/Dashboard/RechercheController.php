<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Etablissement;
use App\Models\Zone_travail;
use Illuminate\Http\Request;

class RechercheController extends Controller
{
    public function rechercheEtablissementParZoneEtablissement($zone_travail_id){
        //$dechet_plastique = Etablissement::orderBy('id', 'DESC')->get();
     //$zone_travail = Zone_travail::find($zone_travail_id);
        return Etablissement::where('zone_travail_id',$zone_travail_id)->get();
    }
}
