<?php

namespace App\Http\Controllers;

use App\Models\colies;
use App\Models\destinataires;
use App\Models\fournisseurs;
use App\Models\statuts;
use App\Models\Suivi_de_tracabilites;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Milon\Barcode\DNS2D;
use PhpOffice\PhpSpreadsheet\Calculation\Database\DVar;
use Symfony\Component\Console\Input\Input;

class ColieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_colie = colies::where('deleted_at',null)->orderBy("updated_at","desc")->paginate(20);
        $get_total_colie=colies::all()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();


        return view("admin.colies.colie",["colie"=>$get_colie,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $get_fournisseur = fournisseurs::all();
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.colies.AddColie",["data"=>$get_fournisseur,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

    $validator=Validator::make($request->all(),[
        'Reference' => ['required', Rule::unique('colies', 'Reference')],
    ]);

    if(!$validator->passes()){
        return redirect()->route("colies.create")->withError("La reference doit étre unique");
    }
    else{
        //dd($request);
        $reference = strip_tags($request->input("Reference"));
        $designation = strip_tags($request->input("Designation"));
        $prix = strip_tags($request->input("Prix"));
        $fournisseur = strip_tags($request->Fournisseur);
        $quantite = strip_tags($request->input("Quantite"));
        // Generate QR code from the reference
        $qrCode = new DNS2D();
        $qrCode->setStorPath(public_path("qrcodes"));
        $qrCodePath = $qrCode->getBarcodePNGPath($reference, "QRCODE", 3, 3, [0, 0, 0]);
        // Store the QR code path in the database
        $new_colie = colies::create([
            "Reference" => $reference,
            "Designation" => $designation,
            "Prix" => $prix,
            "id_Fournisseur" => $fournisseur,
            "Qte_Unitaire" => $quantite,
            "Qr_code" => $qrCodePath, // Store the QR code image path
        ]);

        return redirect()->route("colies.create")->withSuccess("Ajoute_Avec_Success");
    }
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
    public function edit($coly)
    {


        $Colie= colies::where("Reference",$coly)->with('Fournisseur')->get();

        foreach ($Colie as $items) {
           $get_fournisseur_name=fournisseurs::where("id",$items->id_Fournisseur)->get();
           //dd($get_fournisseur_name);
        }



        //dd($Colie);
        $get_fournisseur = fournisseurs::all();
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();

        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.colies.EditColie",["colie"=>$Colie,"data"=>$get_fournisseur,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation,"fournisseur_name"=>$get_fournisseur_name]);

    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    // Update the record using the Query Builder
    $affectedRows = DB::table('colies')
        ->where('Reference', $id)
        ->update([
            "Reference"=>strip_tags($request->input("Reference")),
            "Designation"=>strip_tags($request->input("Designation")),
            "Prix"=>strip_tags($request->input("Prix")),
            "id_Fournisseur"=>strip_tags($request->Fournisseur),
            "Qte_Unitaire"=>strip_tags($request->input("Quantite")),
            "updated_at"=>Carbon::now()
        ]);
        return redirect()->route("colies.index")->withSuccess("update_success", true);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    {
//        DB::statement("SET FOREIGN_KEY_CHECKS=0");
//        $colie = DB::table("colies")->where("Reference",$id)->delete();
//        return redirect()->route("colies.index")->withSuccess("delete_success",true);
//        DB::statement("SET FOREIGN_KEY_CHECKS=1");

       // dd("enter",$id);

        DB::table('colies')
            ->where('Reference', $id) // find your user by their email
            //->limit(1) // optional - to ensure only one record is updated.
            ->update([
                "deleted_at" =>Carbon::now()
            ]); // update the record in the DB.
        return redirect()->route("colies.index")->withSuccess("delete_success",true);
    }


}
