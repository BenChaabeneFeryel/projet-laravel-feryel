<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\GestionCompte\GestionnaireController;
use App\Http\Controllers\API\GestionCompte\Client_dechetController;
use App\Http\Controllers\API\GestionCompte\OuvrierController;
use App\Http\Controllers\API\GestionCompte\ResponsableEtablissementController;

use App\Http\Controllers\API\GestionDechet\Commande_dechetController;
use App\Http\Controllers\API\GestionDechet\DechetController;
use App\Http\Controllers\API\GestionDechet\Detail_commande_dechetController;

use App\Http\Controllers\API\GestionPanne\MecanicienController;
use App\Http\Controllers\API\GestionPanne\Reparation_camionController;
use App\Http\Controllers\API\GestionPanne\Reparateur_poubelleController;
use App\Http\Controllers\API\GestionPanne\Reparation_poubelleController;

use App\Http\Controllers\API\GestionPoubelleEtablissements\Bloc_poubelleController;
use App\Http\Controllers\API\GestionPoubelleEtablissements\EtablissementController;
use App\Http\Controllers\API\GestionPoubelleEtablissements\Zone_travailController;
use App\Http\Controllers\API\GestionPoubelleEtablissements\PoubelleController;
use App\Http\Controllers\API\GestionPoubelleEtablissements\Commande_poubelleController;
use App\Http\Controllers\API\GestionPoubelleEtablissements\Detail_commande_poubelleController;

use App\Http\Controllers\API\ProductionPoubelle\FournisseurController;
use App\Http\Controllers\API\ProductionPoubelle\StockPoubelleController;
use App\Http\Controllers\API\ProductionPoubelle\MateriauxPrimaireController;

use App\Http\Controllers\API\TransportDechet\CamionController;
use App\Http\Controllers\API\TransportDechet\DepotController;
use App\Http\Controllers\API\TransportDechet\Zone_depotController;

use App\Http\Controllers\API\Ouvrier\ViderController;
use App\Http\Controllers\API\Dashboard\CompteurController;
use App\Http\Controllers\API\Dashboard\SommeDechetController;
use App\Http\Controllers\API\Dashboard\RechercheController;
use App\Http\Controllers\API\Dashboard\RegionController;
use App\Http\Controllers\API\Dashboard\DashboardEtablissementController;
use App\Http\Controllers\API\Dashboard\CalendrierController;


use App\Http\Controllers\Authentification\AuthController;
use App\Http\Controllers\Authentification\NewPasswordController;
use App\Http\Controllers\Authentification\ContactCotroller;


/*Route::middleware(['auth:sanctum', 'verified'])->group(function () {

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();*/
/**--------------  **************           debut web       ************************** -------------------**/
    /**--------------  **************           debut crud       ************************** -------------------**/
        /** -------------------------------------------gestion Compte -----------------------------------------*/
                    /**                 administrateurs                        */
                Route::apiResource('gestionnaire', GestionnaireController::class);
                Route::delete('/gestionnaire/hard-delete/{id}', [GestionnaireController::class, 'hdelete']);
                Route::get('/gestionnaire/restore/{id}', [GestionnaireController::class, 'restore']);
                Route::get('/gestionnaire/restoreall', [GestionnaireController::class, 'restoreAll']);
                Route::get('/gestionnaire/trash', [GestionnaireController::class, 'trashedAdmin']);
                    /**                 client                                  */
                Route::apiResource('client', Client_dechetController::class);

                    /**                  ouvrier                                */
                Route::apiResource('ouvrier', OuvrierController::class);

                    /**                  responsable etablissement              */
                Route::apiResource('responsable-etablissement', ResponsableEtablissementController::class);
        /** -------------------------------------------gestion Dechet -----------------------------------------*/
                    /**                  commandes                     */
                Route::apiResource('commande-dechet', Commande_dechetController::class);
                    /**                  dechets                       */
                Route::apiResource('dechets', DechetController::class);
                /**                  detail commande dechet         */
                Route::apiResource('detail-commande-dechets', Detail_commande_dechetController::class);
        /** -------------------------------------------gestion Panne -----------------------------------------*/
                /**                        reparateur poubelle             */
                Route::apiResource('reparateur-poubelle', Reparateur_poubelleController::class);
                Route::get('/reparateur-poubelle/serachAdresse/{adresse}', [Reparateur_poubelleController::class, 'serachAdresse']);
                /**                        mecanicien                  */
                Route::apiResource('mecanicien', MecanicienController::class);
                /**                        reparation poubelle            */
                Route::apiResource('reparation-poubelle', Reparation_poubelleController::class);
                /**                        reparation camion               */
                Route::apiResource('reparation-camion', Reparation_camionController::class);
        /** -------------------------------------------gestion Poubelle par etablissement -----------------------------------------------*/
                    /**                   zone-travail                        */
                Route::apiResource('zone-travail', Zone_travailController::class);
                Route::get('/zone-travail/searchRegion/{region}', [Zone_travailController::class, 'searchRegion']);
                        /**                  etablissement                      */
                Route::apiResource('etablissement', EtablissementController::class);
                Route::get('/etablissements' , [EtablissementController::class, 'index']);
                Route::get('/etablissement/searchZone_travail/{zone_travail_id}', [EtablissementController::class, 'searchZone_travail']);
                        /**                  bloc-poubelle                      */
                Route::apiResource('bloc-poubelle', Bloc_poubelleController::class);
                Route::get('/bloc-poubelle/searchEtablissement/{etablissement_id}', [Bloc_poubelleController::class, 'searchEtab']);
                        /**                    poubelle                        */
                Route::apiResource('poubelle', PoubelleController::class);
                Route::get('/poubelle/searchBlocPoubelle/{bloc_poubelle_id}', [PoubelleController::class, 'searchBlocPoubelle']);
                Route::get('/poubelle/searchEType/{type}', [PoubelleController::class, 'searchEType']);
                        /**                  detail commande poubelle                       */
                Route::apiResource('detail-commande-poubelle', Detail_commande_poubelleController::class);
                        /**                   commande dechet                       */
                Route::apiResource('commande-poubelle', Commande_poubelleController::class);
        /** -------------------------------------------transport poubelle -----------------------------------------*/
                    /**                       camion                            */
            Route::apiResource('camion', CamionController::class);
            Route::get('/camion/searchMatricule/{matricule}', [CamionController::class, 'searchMatricule']);
                    /**                        zone depot                       */
            Route::apiResource('zone-depot', Zone_depotController::class);
                    /**                       depot                            */
            Route::apiResource('depot', DepotController::class);
        /** -------------------------------------------production poubelle -----------------------------------------*/
                /**                   Fournisseur                         */
            Route::apiResource('fournisseurs', FournisseurController::class);
                /**                    Materiaux Primaires               */
            Route::apiResource('materiaux-primaires',MateriauxPrimaireController::class);
                /**                   Stock poubelle                  */
            Route::apiResource('stock-poubelle', StockPoubelleController::class);

    /**--------------  **************          fin crud          ************************** -------------------**/

    /** -------------  **************          debut recherche    ************************** ------------------**/
            Route::get('/recherche-etablissements-zone-travail/{zone_travail_id}', [RechercheController::class, 'rechercheEtablissementParZoneEtablissement']);
    /** -------------  **************         fin recherche      **************************  ------------------**/

    /** -------------  **************         debut Calendrier      **************************  ------------------**/
            Route::get('/calendrier', [CalendrierController::class, 'calendrier']);
    /** -------------  **************         fin Calendrier      **************************  ------------------**/


/** -------------  **************           fin web         **************************  ------------------**/

/** -------------  **************           debut mobile         **************************  ------------------**/
            /** ------------------------------ debut ouvrier vider -----------------------------------------*/
                Route::get('/viderPoubelle/{ouvrier}/{poubelle}', [ViderController::class, 'ViderPoubelle']);
                Route::get('/viderPoubelleQr/{ouvrier}/{qr}', [ViderController::class, 'ViderPoubelleQr']);
                Route::get('/viderCamion/{depot}', [ViderController::class, 'ViderCamion']);
            /** ------------------------------- fin ouvrier vider -----------------------------------------*/
/** -------------  **************           fin mobile         **************************  ------------------**/

/** ---------------------------------------------- debut Dashboard ----------------------------------------------------*/

            /** -------------  **************         debut dashborad responsable etablissement         **************************  ------------------**/
                    Route::get('/donnee-etablissement/{id}', [DashboardEtablissementController::class, 'donnee_etablissement']);
                    Route::get('/dashboard-etablissement/{id}', [DashboardEtablissementController::class, 'dashboard_etablissement']);
            /** -------------  **************         fin dashborad responsable etablissement      **************************  ------------------**/

            /** -------------  **************         debut dashborad gestionnaire      **************************  ------------------**/
                     Route::get('/dashboard', [CompteurController::class, 'dashbordValeur']);
                /** -------------  **************         debut somme      **************************  ------------------**/
                    Route::get('/somme-total-dechet-zone-depot', [SommeDechetController::class, 'SommeDechetZoneDepot']);
                    Route::get('/somme-total-dechet-zone-travail', [SommeDechetController::class, 'SommeDechetZoneTravail']);
                    // Route::get('/somme-total-dechet-etablissement/{zone_travail_id}', [SommeDechetController::class, 'SommeDechetBlocEtablissement']);

                    Route::get('/prixdechets', [SommeDechetController::class, 'PrixDechets']);

                    Route::get('/somme-dechets-par-mois', [SommeDechetController::class, 'sommeDechetsparMois']);
                    Route::get('/somme-dechet-annees', [SommeDechetController::class, 'sommeDechetAnnees']);
                    Route::get('/somme-dechets-vendus', [SommeDechetController::class, 'sommeDechetsVendus']);
                    Route::get('/count-zone-travail', [CompteurController::class, 'countEtabParZoneTravail']);

                    /** -------------------------------------------Dashboard -----------------------------------------*/
                /** -------------  **************         fin somme      **************************  ------------------**/
            /** -------------  **************         fin dashborad gestionnaire        **************************  ------------------**/



            /** -------------  **************         debut map      **************************  ------------------**/
                Route::get('/region-map', [RegionController::class, 'RegionMap']);
            /** -------------  **************         fin map      **************************  ------------------**/

/** ----------------------------------------------fin Dashboard ----------------------------------------------------*/

            /** -------------  **************         debut authentifiaction      **************************  ------------------**/
                Route::post('/register' , [AuthController::class , 'register']);
                Route::post('/login',[AuthController::class, 'login']);
                Route::get('/logout',[AuthController::class, 'logout']);
                Route::get('/allUser',[AuthController::class, 'allUser']);
                Route::get('/profile',[AuthController::class, 'profile']);

                Route::post('/update/{id}',[AuthController::class , 'update']);
                Route::post('/qrlogin/{test}',[AuthController::class , 'qrlogin']);
                Route::post('/updatePassword/{id}',[AuthController::class , 'updatePassword']);
                Route::post('/forgotPassword',[AuthController::class , 'send']);
            /** -------------  **************         fin authentifiaction      **************************  ------------------**/

                //  Route::get('/ip', function(){
                //     $clientIP = request()->ip();
                //     return $clientIP;
                // });

