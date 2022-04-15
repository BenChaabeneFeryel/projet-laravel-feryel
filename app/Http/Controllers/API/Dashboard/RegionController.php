<?php

namespace App\Http\Controllers\API\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Bloc_poubelle;
use App\Models\Etablissement;
use App\Models\Zone_travail;
class RegionController extends Controller{
    public function Region(){
        $Zone_travail= Zone_travail::with('etablissements')->get();
        // $etablissements= Etablissement::with('bloc-poubelle')->get();
        $blocPoubelle= Bloc_poubelle::with('poubelles')->get();
        // $zones=[];
        // foreach($Zone_travail as $zone){
        //     $Array = [
        //         'region'=>$zone->with('etablissements'),
        //         // 'etablissements'=>$zone->etablissements,
        //     ];
        //     array_push($zones,$Array);
        // }
        // $nbr_etablissement= Zone_travail::find(1)->etablissements;
        // $etablissements = $nbr_zone_travail->etablissements;

        $myArray = [
            'Zone_travail'=>$Zone_travail,
            // 'etablissements'=>$etablissements,
            'bloc-poubelle'=>$blocPoubelle,
        ];
        return $myArray;
    }


    public function RegionMap(){
        $zone_travail= Zone_travail::with('etablissements')->get();

        $zoneTravail=[];
        foreach($zone_travail as $zone){
            $etab= $zone->etablissements;
            foreach($etab as $et){
               $etb= $et->bloc_poubelles;
               foreach($etb as $poubelle){
                $poubelle= $poubelle->poubelles;
         }
        }
        array_push($zoneTravail,$zone);
     }
        return $zoneTravail;
    }
}
