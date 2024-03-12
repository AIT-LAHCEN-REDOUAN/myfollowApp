<?php

namespace App\Http\Controllers;

use App\Models\colies;
use App\Models\destinataires;
use App\Models\fournisseurs;
use App\Models\statuts;
use App\Models\Stock;
use App\Models\Suivi_de_tracabilites;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SuiviTracabilite extends Controller
{

    public function All(){
        $get_op = Suivi_de_tracabilites::with('Fournisseur','destinataire')->orderBy("created_at","desc")->paginate(10);
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();


        return view("admin.SuiviTracabilite.All",["Suivi_de_tracabilite"=>$get_op,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    public function in(){
        $get_op = Suivi_de_tracabilites::where("etat","In")->orderBy("created_at","desc")->paginate(10);
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.SuiviTracabilite.in",["Suivi_de_tracabilite"=>$get_op,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    public function out(){
        $get_op = Suivi_de_tracabilites::where("etat","Out")->orderBy("created_at","desc")->paginate(10);
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.SuiviTracabilite.out",["Suivi_de_tracabilite"=>$get_op,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    public function retour(){
        $get_op = Suivi_de_tracabilites::where("etat","retour")->orderBy("created_at","desc")->paginate(10);
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.SuiviTracabilite.retour",["Suivi_de_tracabilite"=>$get_op,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    public function NonValider(){
        $get_op = Suivi_de_tracabilites::where("statut","Non_valider")->orderBy("created_at","desc")->paginate(10);
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.SuiviTracabilite.NonValider",["Suivi_de_tracabilite"=>$get_op,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    public function delete_in($id){
        $suivi = DB::table("suivi_de_tracabilites")->where("id",$id)->delete();
        return redirect()->route("in")->withSuccess("delete_success",true);
    }
    public function delete_out($id){
        $suivi = DB::table("suivi_de_tracabilites")->where("id",$id)->delete();
        return redirect()->route("out")->withSuccess("delete_success",true);
    }
    public function delete_retour($id){
        $suivi = DB::table("suivi_de_tracabilites")->where("etat",$id)->delete();
        return redirect()->route("retour")->withSuccess("delete_success",true);
    }
    public function delete_NonValider($id){
        $suivi = DB::table("suivi_de_tracabilites")->where("id",$id)->delete();
        return redirect()->route("NonValider")->withSuccess("delete_success",true);
    }

    public function edit_operations($id_op){

        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();
        $get_op = Suivi_de_tracabilites::where("id",$id_op)->get();
        $stock = Stock::where('Reference_colie',$get_op[0]->Reference_colie)->first();

        return view("admin.SuiviTracabilite.edit",["operations"=>$get_op,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation,"stock"=>$stock]);

    }

    public function update_operations(Request $request, $id_op)
    {
        // Validate the request data
//    $validatedData = $request->validate([
//        'Etat' => 'sometimes|string', // Allow empty
//        'Fournisseur' => 'sometimes|string', // Allow empty
//        'Raison' => 'sometimes|string', // Allow empty
//        'Quantite_apres_traitement' => 'sometimes|numeric', // Allow empty
//        'Quantite_avant_traitement' => 'sometimes|numeric', // Allow empty
//        'Quantite_retour' => 'sometimes|numeric', // Allow empty
//        'Quantite_sortie' => 'sometimes|numeric', // Allow empty
//        'motif' => 'sometimes|string', // Allow empty
//    ]);

        // Get the IDs for Fournisseur and Destinataire based on names
        $get_f = DB::table("fournisseurs")->where("name", $request->input("Fournisseur"))->value("id");
        $get_d = DB::table("destinataires")->where("name", $request->input("Destinataire"))->value("id");

        // Prepare the update data
        $updateData = [
            "etat" => strip_tags($request->input("Etat")),
            "statut" => $request->input("statut"),
            "raison" => strip_tags($request->input("Raison")),
            "id_fournisseur" => $get_f,
            "id_destinataire" => $get_d,
            "Quantite_apres_traitement" => strip_tags($request->input("Quantite_apres_traitement")),
            "Quantite_avant_traitement" => strip_tags($request->input("Quantite_avant_traitement")),
            "Quantite_Retour" => strip_tags($request->input("Quantite_retour")),
            "Quantite_sortie" => strip_tags($request->input("Quantite_sortie")),
            "motif" => strip_tags($request->input("motif")),
            'updated_at'=>Carbon::now()
        ];



        // Check if a field is empty and set it to null in the database
        foreach ($updateData as $key => $value) {
            if ($value === '') {
                $updateData[$key] = null;
            }
        }

        // Update the database
        $affectedRows = DB::table('suivi_de_tracabilites')
            ->where('id', $id_op)
            ->update($updateData);

        $stock = Stock::where('Reference_colie',$request->input('Reference'))->first();
        if ($stock){
            if ($request->input("Etat")=="In"){
                $stock->Quantite_Disponible = $stock->Quantite_Disponible+$request->input("Quantite_apres_traitement");
                $stock->updated_at = Carbon::now();
                $stock->save();
            }
            else{
                $stock->Quantite_Disponible = $stock->Quantite_Disponible-$request->input("Quantite_sortie");
                $stock->updated_at = Carbon::now();
                $stock->save();
            }

        }
        else{
            DB::table("stocks")->insert([
                "Reference_colie"=>$request->input("Reference"),
                "Quantite_Disponible"=>$request->input("Quantite_apres_traitement"),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]);
        }


        // Redirect with a success message
        return redirect()->route("All")->withSuccess("update_success", true);
    }



}
