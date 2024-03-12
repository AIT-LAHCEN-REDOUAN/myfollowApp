<?php

use App\Http\Controllers\ColieController;
use App\Http\Controllers\destinataireController;
use App\Http\Controllers\ExportColiesController;
use App\Http\Controllers\ExportDestinataireController;
use App\Http\Controllers\ExportFournisseurController;
use App\Http\Controllers\ExportOperation;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ImportColiesController;
use App\Http\Controllers\ImportDestinatairesController;
use App\Http\Controllers\ImportFournisseursController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SuiviTracabilite;
use App\Http\Controllers\UserController;
use App\Models\colies;
use App\Models\destinataires;
use App\Models\fournisseurs;
use App\Models\Suivi_de_tracabilites;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you permission register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return redirect()->route("login");
});*/

Route::get("/",function (Request $request){

    if ($request->input('start_date') && $request->input('end_date')) {
        $startDateTime = $request->input('start_date') . ' 00:00:00';
        $endDateTime = $request->input('end_date') . ' 23:59:59';

        $get_total_colie=colies::where('deleted_at',null)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy("updated_at","desc")->get()->count();
        $get_total_fournisseur=fournisseurs::whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        $get_total_destinataire=destinataires::whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->whereBetween('created_at', [$startDateTime, $endDateTime])->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->whereBetween('created_at', [$startDateTime, $endDateTime])->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->whereBetween('created_at', [$startDateTime, $endDateTime])->count();
        $total_operation_in_pending = Suivi_de_tracabilites::where("etat","In")->where("statut","Pending")->whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        $total_operation_out_pending = Suivi_de_tracabilites::where("etat","Out")->where("statut","Pending")->whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        $total_operation_in_corrigee = Suivi_de_tracabilites::where("etat","In")->where("statut","Corrigée")->whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        $total_operation_out_corrigee = Suivi_de_tracabilites::where("etat","Out")->where("statut","Corrigée")->whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        $total_operation_derogee = Suivi_de_tracabilites::where("statut","Déroger")->whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        $total_operation_in_annulee = Suivi_de_tracabilites::where("etat","In")->where("statut","Annuler")->whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        $total_operation_out_annulee = Suivi_de_tracabilites::where("etat","Out")->where("statut","Annuler")->whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();
        $total_operation = Suivi_de_tracabilites::whereBetween('created_at', [$startDateTime, $endDateTime])->get()->count();

        $operation_in = Suivi_de_tracabilites::where(['etat'=>"In"])->whereNotIn('statut', ['Pending','Annuler'])->whereBetween('created_at', [$startDateTime, $endDateTime])->with('colie')->get();
        $operation_return = Suivi_de_tracabilites::where(['etat'=>"Retour"])->whereBetween('created_at', [$startDateTime, $endDateTime])->with('colie')->get();
        $operation_out = Suivi_de_tracabilites::where(['etat'=>"Out"])->whereNotIn('statut', ['Pending','Annuler'])->whereBetween('created_at', [$startDateTime, $endDateTime])->with('colie')->get();


    }
    else{
        $get_total_colie=colies::where('deleted_at',null)->orderBy("updated_at","desc")->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation_in_pending = Suivi_de_tracabilites::where("etat","In")->where("statut","Pending")->count();
        $total_operation_out_pending = Suivi_de_tracabilites::where("etat","Out")->where("statut","Pending")->count();
        $total_operation_in_corrigee = Suivi_de_tracabilites::where("etat","In")->where("statut","Corrigée")->count();
        $total_operation_out_corrigee = Suivi_de_tracabilites::where("etat","Out")->where("statut","Corrigée")->count();
        $total_operation_derogee = Suivi_de_tracabilites::where("statut","Déroger")->count();
        $total_operation_in_annulee = Suivi_de_tracabilites::where("etat","In")->where("statut","Annuler")->count();
        $total_operation_out_annulee = Suivi_de_tracabilites::where("etat","Out")->where("statut","Annuler")->count();

        $total_operation = Suivi_de_tracabilites::all()->count();

        $operation_in = Suivi_de_tracabilites::where(['etat'=>"In"])->whereNotIn('statut', ['Pending','Annuler'])->with('colie')->get();
        $operation_return = Suivi_de_tracabilites::where(['etat'=>"Retour"])->with('colie')->get();
        $operation_out = Suivi_de_tracabilites::where(['etat'=>"Out"])->whereNotIn('statut', ['Pending','Annuler'])->with('colie')->get();

    }

    $total_in = 0;
    $total_return = 0;
    $total_out = 0;

    foreach ($operation_in as $in){
            if ($in->statut == "Valider_Automatique"){
                $total_in += ($in->prix??0)*($in->Quantite_avant_traitement??0);
            }
            else{
                $total_in += ($in->prix??0)*($in->Quantite_apres_traitement??0);
            }
    }

    foreach ($operation_return as $return){
        $total_return += ($return->prix??0)*($return->Quantite_Retour??0);
    }

    foreach ($operation_out as $out){
        $total_out += ($out->prix??0)*($out->Quantite_sortie??0);
    }

    $ca = ($total_in+$total_return)-$total_out;

    $operations_par_etat = Suivi_de_tracabilites::groupBy('etat')
        ->select('etat', DB::raw('count(*) as count'))
        ->get();

    $in_operations_par_statut = Suivi_de_tracabilites::where('etat','In')->groupBy('statut')
        ->select('statut', DB::raw('count(*) as count'))
        ->get();

    $currentYear = date('Y'); // Get the current year

    $operations_by_month = Suivi_de_tracabilites::selectRaw('MONTH(created_at) month, COUNT(*) as count')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    $ca_by_months = [];
    for ($i=1;$i<=12;$i++){
        $operations_by_one_month = Suivi_de_tracabilites::whereYear('created_at', $currentYear)->whereNotIn('statut', ['Pending','Annuler'])->whereMonth('created_at',$i)->get();
        $in_by_one_month = 0;
        $out_by_one_month = 0;
        $retour_by_one_month = 0;
        foreach ($operations_by_one_month as $operation){
            if ($operation->etat == "In"){
                if ($operation->statut == "Valider_Automatique"){
                    $in_by_one_month += ($operation->prix??0)*($operation->Quantite_avant_traitement??0);
                }
                else{
                    $in_by_one_month += ($operation->prix??0)*($operation->Quantite_apres_traitement??0);
                }
            }
            elseif ($operation->etat == "Out"){
                $out_by_one_month += ($operation->prix??0)*($operation->Quantite_sortie??0);
            }
            elseif ($operation->etat == "Retour"){
                $retour_by_one_month += ($operation->prix??0)*($operation->Quantite_Retour??0);
            }
        }
        $ca_by_one_month = ($in_by_one_month+$retour_by_one_month)-$out_by_one_month;
        $ca_by_months[$i]=$ca_by_one_month;
    }
    //dd($ca_by_months);

    return view("admin.dashboard",["ca_by_months"=>$ca_by_months,"operations_by_month"=>$operations_by_month,"in_operations_par_statut"=>$in_operations_par_statut,"operations_par_etat"=>$operations_par_etat,"total_colie"=>$get_total_colie,"total_operation_derogee"=>$total_operation_derogee,"total_operation_in_annulee"=>$total_operation_in_annulee,"total_operation_out_annulee"=>$total_operation_out_annulee,"total_operation_in_corrigee"=>$total_operation_in_corrigee,"total_operation_out_corrigee"=>$total_operation_out_corrigee,"total_operation_in_pending"=>$total_operation_in_pending,"total_operation_out_pending"=>$total_operation_out_pending,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_operation"=>$total_operation,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"ca"=>$ca]);
})->middleware("auth");

/*Route::get("/home",function(){
    redirect()->route("colies.index");
});*/

Route::resource("colies",ColieController::class)->middleware(["auth","permission:Gestion_DataBase"]);
Route::resource("fournisseurs",FournisseurController::class)->middleware(["auth","permission:Gestion_Fournisseur"]);
Route::resource("destinataires",destinataireController::class)->middleware(["auth","permission:Gestion_Client"]);
Route::resource("users",UserController::class)->middleware(["auth","permission:Gestion_User"]);


Route::get("/out",[SuiviTracabilite::class,"out"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("out");
Route::get("/in",[SuiviTracabilite::class,"in"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("in");
Route::get("/retour",[SuiviTracabilite::class,"retour"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("retour");


Route::delete("/delete_in/{id}",[SuiviTracabilite::class,"delete_in"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("delete_in");
Route::delete("/delete_out/{id}",[SuiviTracabilite::class,"delete_out"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("delete_out");
Route::delete("/delete_retour/{id}",[SuiviTracabilite::class,"delete_retour"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("delete_retour");
Route::delete("/delete_NonValider/{id}",[SuiviTracabilite::class,"delete_NonValider"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("delete_NonValider");
Route::get("/all_operation",[SuiviTracabilite::class,"All"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("All");

Route::get("/Exportcolies",[ExportColiesController::class,"exportColie"])->name("colie_export");

Route::post("/ImportColies",[ImportColiesController::class,"importColie"])->name("colie_import");
Route::post("/ImportDestinataires",[ImportDestinatairesController::class,"importDestinataire"])->name("destinataire_import");
Route::post("/ImportFournisseurs",[ImportFournisseursController::class,"importFournisseur"])->name("fournisseur_import");



Route::get("/Export_op",[ExportOperation::class,"ExportOperation"])->middleware("auth")->name("operation_export");
Route::get("/Export_fournisseur",[ExportFournisseurController::class,"ExportFournisseur"])->middleware("auth")->name("export_fournisseur");
Route::get("/Export_destinataire",[ExportDestinataireController::class,"ExportDestinataire"])->middleware("auth")->name("export_destinataire");

Route::get("/NonValider",[SuiviTracabilite::class,"NonValider"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("NonValider");

Route::get("/edit_operations/{id_op}",[SuiviTracabilite::class,"edit_operations"])->middleware(["auth","permission:Gestion_Suivi_tracabilites"])->name("edit_op");
Route::post("/update_operations/{id_op}",[SuiviTracabilite::class,"update_operations"])
//    ->middleware(["auth","permission:modifier_operations"])
    ->name("update_op");


Route::post("/filter", function (Request $request) {

    //dd($request);
    $get_total_colie=colies::where('deleted_at',null)->get()->count();
    $get_total_fournisseur = fournisseurs::count();
    $get_total_destinataire = destinataires::count();
    // More total counts here

    $total_produit_in = Suivi_de_tracabilites::where("etat", "In")->count();
    $total_produit_out = Suivi_de_tracabilites::where("etat", "Out")->count();
    $total_produit_retour = Suivi_de_tracabilites::where("etat", "Retour")->count();
    $total_operation = Suivi_de_tracabilites::count();

   // $result = Suivi_de_tracabilites::where('etat',$request->input("Type_De_Mouvement"))->

//    $query = Suivi_de_tracabilites::query();
//
//    if (!empty($request->input("reference")) &&
//        $request->input("start_date") == null &&
//        $request->input("end_date") == null &&
//        $request->input("fournisseur") == null &&
//        $request->input("Type_De_Mouvement") == null &&
//        $request->input("Client") == null
//        ) {
//
//        $query->where("Reference_colie", $request->input("reference"));
//    }
//
//    if (!empty($request->input("start_date")) && !empty($request->input("end_date")) &&
//        $request->input("reference") == null &&
//        $request->input("fournisseur") == null &&
//        $request->input("Type_De_Mouvement") == null &&
//        $request->input("Client") == null
//        ) {
//        $start_date = $request->input('start_date');
//        $end_date = $request->input('end_date');
//        $query->whereBetween('created_at', [$start_date, $end_date]);
//    }
//
//    if (!empty($request->input("fournisseur")) &&
//        $request->input("reference") == null &&
//        $request->input("start_date") == null &&
//        $request->input("end_date") == null  &&
//        $request->input("Type_De_Mouvement") == null &&
//        $request->input("Client") == null  ) {
//
//        $get_fournisseur_id = fournisseurs::where("name", $request->input("fournisseur"))->value("id");
//        $query->where("id_fournisseur", $get_fournisseur_id);
//    }
//
//    if(!empty($request->input("Type_De_Mouvement") &&
//    $request->input("reference") == null &&
//    $request->input("start_date") == null &&
//    $request->input("end_date") == null &&
//    $request->input("Client") == null &&
//    $request->input("fournisseur") == null
//
//    )){
//        $query->where("etat",$request->input("Type_De_Mouvement"));
//    }
//    if (!empty($request->input("Client")) &&
//    $request->input("reference") == null &&
//    $request->input("start_date") == null &&
//    $request->input("end_date") == null  &&
//    $request->input("Type_De_Mouvement") == null &&
//    $request->input("fournisseur") == null  ) {
//
//        $get_id_client= destinataires::where("name",$request->input("Client"))->value("id");
//        $query->where("id_destinataire",$get_id_client);
//
//}
//
//
//
//    $result = $query->orderBy("created_at","desc")->paginate(10);

    $query = Suivi_de_tracabilites::query();
    $query->with('fournisseur');

   // dd($request->all());
    if ($request->input('start_date') && $request->input('end_date')) {
        $startDateTime = $request->input('start_date') . ' 00:00:00';
        $endDateTime = $request->input('end_date') . ' 23:59:59';

        $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
    }

    if ($request->has('Type_De_Mouvement')) {
        if ($request->input('Type_De_Mouvement')=="Pending"){
            $query->where('statut', "Pending");
        }
        else{
            $query->where('etat', $request->input('Type_De_Mouvement'));
        }
    }

//    if ($request->has('start_date') && $request->has('end_time')) {
//        $query->whereBetween('created_at',
//            [$request->input('start_date').' 00:00:00', $request->input('end_date').' 00:00:00']);
//    }

    if ($request->has('fournisseur')) {
        $query->whereHas('Fournisseur', function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->input('fournisseur') . '%');
        });
    }

    if ($request->has('reference')) {
        $query->where('Reference_colie', 'like', '%' . $request->input('reference') . '%');
    }

    $result = $query->orderBy('created_at','desc')->paginate(10);
    return view("admin.SuiviTracabilite.All", [
        "Suivi_de_tracabilite" => $result,
        "total_colie" => $get_total_colie,
        "total_fournisseur" => $get_total_fournisseur,
        "total_destinataire" => $get_total_destinataire,
        "total_in" => $total_produit_in,
        "total_out" => $total_produit_out,
        "total_retour" => $total_produit_retour,
        "total_operation" => $total_operation,
        "reference" => $request->input('reference')??null,
        "fournisseur" => $request->input('fournisseur')??null,
        "start_date" => $request->input('start_date')??null,
        "end_date" => $request->input('end_date')??null,
        "etat" => $request->input('Type_De_Mouvement')??null,
    ]);
})->middleware("auth")->name("filter");



Route::get("/addOperateur",function (){

    $get_total_colie=colies::all()->count();
    $get_total_fournisseur=fournisseurs::all()->count();
    $get_total_destinataire=destinataires::all()->count();
    //more
    $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
    $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
    $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
    $total_operation = Suivi_de_tracabilites::all()->count();
    return view("admin.users.AddOperateur",["total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);


})->middleware(["auth","permission:Gestion_User"])->name("addOperateur");

Route::post("/addOp",function (Request $request){
    $new_user = User::create([
            "name"=>strip_tags($request->input("name")),
            "email"=>strip_tags($request->input("email")),
            "Matricule"=>strip_tags($request->input("matricule")),
            "password"=>strip_tags(Hash::make($request->input("password"))),
            "original_password"=>strip_tags($request->input("password")),
            "id_role"=>strip_tags($request->input("role"))
    ]);

    return redirect()->route("users.index");
})->middleware(["auth","permission:Gestion_User"])->name("AddOp");


Route::get("/Annuler",function (){
    $get_total_colie=colies::where('deleted_at',null)->get()->count();
    $get_total_fournisseur=fournisseurs::all()->count();
    $get_total_destinataire=destinataires::all()->count();
    //more
    $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
    $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
    $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
    $total_operation = Suivi_de_tracabilites::all()->count();
    $get_annuler = Suivi_de_tracabilites::where("Statut","Annuler")->where("etat","In")->orderBy("created_at","desc")->paginate(10);
    return view("admin.SuiviTracabilite.Annuler",["Suivi_de_tracabilite"=>$get_annuler,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
})->name("Annuler")->middleware("auth");

Route::get("out/Annuler",function (){
    $get_out_annuler = Suivi_de_tracabilites::where("Statut","Annuler")->where("etat","Out")->with('destinataire')->orderBy("created_at","desc")->paginate(10);
    return view("admin.SuiviTracabilite.outAnnuler",["Suivi_de_tracabilite"=>$get_out_annuler]);
})->name("out.Annuler")->middleware("auth");

Route::get("Pending",function (){
    $get_pending = Suivi_de_tracabilites::where("Statut","Pending")->where("etat","In")->orderBy("created_at","desc")->paginate(10);
    return view("admin.SuiviTracabilite.Pending",["Suivi_de_tracabilite"=>$get_pending]);
})->name("Pending")->middleware("auth");

Route::get("out/Pending",function (){
    $get_out_pending = Suivi_de_tracabilites::where("Statut","Pending")->where("etat","Out")->orderBy("created_at","desc")->paginate(10);
    return view("admin.SuiviTracabilite.outPending",["Suivi_de_tracabilite"=>$get_out_pending]);
})->name("out.Pending")->middleware("auth");

Route::get("/Corrige",function (){
    $get_total_colie=colies::where('deleted_at',null)->get()->count();
    $get_total_fournisseur=fournisseurs::all()->count();
    $get_total_destinataire=destinataires::all()->count();
    //more
    $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
    $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
    $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
    $total_operation = Suivi_de_tracabilites::all()->count();
    $get_corriger = Suivi_de_tracabilites::where("Statut","Corrigée")->where("etat","In")->orderBy("created_at","desc")->paginate(10);
    return view("admin.SuiviTracabilite.Corrige",["Suivi_de_tracabilite"=>$get_corriger,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
})->name("Corrige")->middleware("auth");

Route::get("out/Corrige",function (){
    $get_out_corriger = Suivi_de_tracabilites::where("Statut","Corrigée")->where("etat","Out")->with('destinataire')->orderBy("created_at","desc")->paginate(10);
    return view("admin.SuiviTracabilite.outCorrige",["Suivi_de_tracabilite"=>$get_out_corriger]);
})->name("out.Corrige")->middleware("auth");

Route::get("/Deroger",function(){
    $get_total_colie=colies::where('deleted_at',null)->get()->count();
    $get_total_fournisseur=fournisseurs::all()->count();
    $get_total_destinataire=destinataires::all()->count();
    //more
    $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
    $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
    $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
    $total_operation = Suivi_de_tracabilites::all()->count();
    $get_deroger = Suivi_de_tracabilites::where("Statut","Déroger")->where("etat","In")->orderBy("created_at","desc")->paginate(10);
    return view("admin.SuiviTracabilite.Derogee",["Suivi_de_tracabilite"=>$get_deroger,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
})->name("Deroger")->middleware("auth");

Route::get("/AnnulerNonValider",function (){
    $get_total_colie=colies::where('deleted_at',null)->get()->count();
    $get_total_fournisseur=fournisseurs::all()->count();
    $get_total_destinataire=destinataires::all()->count();
    //more
    $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
    $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
    $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
    $total_operation = Suivi_de_tracabilites::all()->count();
    $get_AnnulerNonValider = Suivi_de_tracabilites::where("Statut", "Annuler")->where("etat","N/A")->orderBy("created_at", "desc")->paginate(10);
    return view("admin.SuiviTracabilite.AnnulerNon",["Suivi_de_tracabilite"=>$get_AnnulerNonValider,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
})->name("AnnulerNonValider")->middleware("auth");

Route::get("/CorrigeNonValider",function (){
    $get_total_colie=colies::where('deleted_at',null)->get()->count();
    $get_total_fournisseur=fournisseurs::all()->count();
    $get_total_destinataire=destinataires::all()->count();
    //more
    $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
    $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
    $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
    $total_operation = Suivi_de_tracabilites::all()->count();
    $get_AnnulerNonValider = Suivi_de_tracabilites::where("Statut", "Corrigée")->where("etat","N/A")->orderBy("created_at", "desc")->paginate(10);
    return view("admin.SuiviTracabilite.corrigeNon",["Suivi_de_tracabilite"=>$get_AnnulerNonValider,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
})->name("CorrigeNonValider")->middleware("auth");

Route::get("/DerogerNonValider",function (){
    $get_total_colie=colies::where('deleted_at',null)->get()->count();
    $get_total_fournisseur=fournisseurs::all()->count();
    $get_total_destinataire=destinataires::all()->count();
    //more
    $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
    $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
    $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
    $total_operation = Suivi_de_tracabilites::all()->count();
    $get_AnnulerNonValider = Suivi_de_tracabilites::where("Statut", "Déroger")->where("etat","N/A")->orderBy("created_at", "desc")->paginate(10);
    return view("admin.SuiviTracabilite.DerogerNon",["Suivi_de_tracabilite"=>$get_AnnulerNonValider,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
})->name("DerogeNonValider")->middleware("auth");

//load Pdf file

Route::get("/generatepdf/{reference}",function ($reference){
   $data = colies::where("Reference",$reference)->first();
   $pdf = new Dompdf();
   $options = new Options();
   $options->set('isHtml5ParserEnabled', true);
   $options->set('isPhpEnabled', true);

   $pdf->setOptions($options);

   $pdf->loadHtml(view('admin.colies.pdftemplate', compact('data')));

   $pdf->render();

   return $pdf->stream('colies.pdf');

})->middleware("auth")->name("generatepdf");



Route::resource("stocks",StockController::class)->middleware(["auth","permission:Gestion_Stock"]);
