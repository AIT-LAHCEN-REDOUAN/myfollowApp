<?php

namespace App\Http\Controllers;

use App\Models\colies;
use App\Models\destinataires;
use App\Models\fournisseurs;
use App\Models\Stock;
use App\Models\Suivi_de_tracabilites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stock = Stock::orderBy("updated_at","desc")->paginate(20);
//        $get_stock = Stock::select(['Reference_colie','Quantite_Disponible', DB::raw('MAX(created_at) as created_at')])
//            ->with('colie')
//            ->groupBy('Reference_colie')
//            ->paginate(20);
        //$get_stock= Stock::orderBy("updated_at","desc")->with('colie')->paginate(20);


        $query = Stock::query();
        $query->with('colie');

//        if ($request->has('fournisseur')) {
//            $query->whereHas('colies.Fournisseur', function ($query) use ($request) {
//                $query->where('name', 'like', '%' . $request->input('fournisseur') . '%');
//            });
//        }

        if ($request->has('reference')) {
            $query->where('Reference_colie', 'like', '%' .$request->input('reference'). '%');
        }

        if ($request->has('fournisseur')) {
            $fournisseur = $request->input('fournisseur');
            $query->whereHas('colie.fournisseur', function($subquery) use ($fournisseur) {
                $subquery->where('name', 'like', '%' . $fournisseur . '%');
            });
        }

//        if ($request->has('fournisseur')) {
//            $fournisseur = $request->input('fournisseur');
//            $query->whereHas('colies', function($subquery) use ($fournisseur) {
//                $subquery->where('id_fournisseur', $fournisseur);
//            });
//        }

        if ($request->has('designation')) {
            $designation = $request->input('designation');
            $query->whereHas('colie', function($subquery) use ($designation) {
                $subquery->where('designation', 'like', '%' . $designation . '%');
            });
        }
        $get_stock = $query->orderBy('created_at','desc')->paginate(20);

        //dd($get_stock);


        foreach ($get_stock as $item){
            $operation_in = Suivi_de_tracabilites::where(['Reference_colie'=>$item->Reference_colie,'etat'=>"In"])->whereNotIn('statut', ['Pending','Annuler'])->with('colie')->get();
            $operation_return = Suivi_de_tracabilites::where(['Reference_colie'=>$item->Reference_colie,'etat'=>"Retour"])->with('colie')->get();
            $operation_out = Suivi_de_tracabilites::where(['Reference_colie'=>$item->Reference_colie,'etat'=>"Out"])->whereNotIn('statut', ['Pending','Annuler'])->with('colie')->get();

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

            $item->ca = ($total_in+$total_return)-$total_out;
        }
        //dd($stock,$get_stock);



        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();
        return view("admin.stocks.stock",["colie"=>$get_stock,"total_colie"=>$get_total_colie,
            "total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,
            "total_operation"=>$total_operation,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,
            "total_retour"=>$total_produit_retour,"reference" => $request->input('reference')??null,
            "fournisseur" => $request->input('fournisseur')??null,"designation" => $request->input('designation')??null]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }


}
