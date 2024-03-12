<?php

namespace App\Http\Controllers;

use App\Models\colies;
use App\Models\destinataires;
use App\Models\fournisseurs;
use App\Models\statuts;
use App\Models\Suivi_de_tracabilites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_fournisseur=fournisseurs::orderBy("updated_at","desc")->paginate(5);
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();


        return view("admin.fournisseurs.fournisseur",["fournisseur"=>$get_fournisseur,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.fournisseurs.AddCoop",["total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $new_fournisseur = fournisseurs::create([
            "email"=>strip_tags($request->input("email")),
            "name"=>strip_tags($request->input("Nom")),
            "Telephone"=>strip_tags($request->input("Telephone"))
        ]);
        $new_fournisseur->save();
        return redirect()->route("fournisseurs.create")->withSuccess("Success",true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $get_fournisseurs = fournisseurs::where("id",$id)->get();
        //dd($get_fournisseurs);
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();


        return view("admin.fournisseurs.EditFournisseur",["data"=>$get_fournisseurs,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $affectedRows = DB::table('fournisseurs')
        ->where('id', $id)
        ->update([
            'email'=> strip_tags($request->input("email")),
            'name'=> strip_tags($request->input("Nom")),
            'Telephone'=>strip_tags($request->input("Telephone")),
        ]);
        return redirect()->route("fournisseurs.index")->withSuccess("update_success", true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        $fournisseur = DB::table("fournisseurs")->where("id",$id)->delete();
        return redirect()->route("fournisseurs.index")->withSuccess("delete_success",true);
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }


}
