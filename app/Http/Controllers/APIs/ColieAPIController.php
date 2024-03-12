<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;
use App\Models\colies;
use App\Models\destinataires;
use App\Models\fournisseurs;
use App\Models\Stock;
use App\Models\Suivi_de_tracabilites;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ColieAPIController extends Controller
{

    public function get_all_fournisseur(){
        $all_fournisseur = fournisseurs::all();
        return response()->json($all_fournisseur);
    }

    public function get_all_destinataire(){
        $all_destinataire = destinataires::all();
        return response()->json($all_destinataire);
    }

    public function get_by_reference($Reference)
    {
        $colie = colies::where("Reference", $Reference)->get();

        $coliesData = [];
        foreach ($colie as $item) {
            $stock = Stock::where('Reference_colie',$item->Reference)->first();
            $coliesData[]=[
                "Reference"=>$item->Reference,
                "Designation"=>$item->Designation,
                "Qte_Unitaire"=>$item->Qte_Unitaire,
                "Qte_Disponible"=>$stock->Quantite_Disponible??null,
                "Prix"=>$item->Prix,
                "Fournisseur"=>$item->Fournisseur->name,
                "id_Fournisseur"=>$item->id_Fournisseur
            ];
        }
        return response()->json($coliesData);
    }



    public function saveInOperation(Request $request)
    {
        try {
            //Sanctum::actingAs($request->user());

            $validator = Validator::make($request->all(), [
                "reference_colie" => "required|exists:colies,Reference",
                // Add validation rules for other request parameters here
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            DB::beginTransaction();

            //$status = "Pending";
            $colie = colies::where('Reference',$request->input('reference_colie'))->first();

            //dd($colie);


                $status = "Valider_Automatique";
                DB::table('suivi_de_tracabilites')->insert([
                    'Reference_colie' => $request->input('reference_colie'),
                    "id_user" => $request->input("user_id"),
                    "id_fournisseur" => $request->input("id_fournisseur"),
                    "created_at" => $request->input("date_de_scan"),
                    "statut"=>"Valider_Automatique",
                    "etat"=>"In",
                    "prix"=> $colie->Prix,
                    "Quantite_avant_traitement"=>$request->input("Quantite_apres_traitement"),
                ]);

                //$get_quantite_disponible = DB::table("colies")->where("Reference",$request->input("reference_colie"))->value("Qte_Unitaire");

                $stock = Stock::where('Reference_colie',$request->input('reference_colie'))->first();

                if ($stock){
                    $stock->Quantite_Disponible = $stock->Quantite_Disponible+$request->input("Quantite_apres_traitement");
                    $stock->updated_at = Carbon::now();
                    $stock->save();
                }
                else{
                    DB::table("stocks")->insert([
                        "Reference_colie"=>$request->input("reference_colie"),
                        "Quantite_Disponible"=>$request->input("Quantite_apres_traitement"),
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now()
                    ]);
                }

//            DB::table("stocks")->insert([
//                "Reference_colie"=>$request->input("reference_colie"),
//                "Quantite_Disponible"=>$request->input("Quantite_avant_traitement")
//            ]);




//            DB::table('suivi_de_tracabilites')->insert([
//                'Reference_colie' => $request->input('reference_colie'),
//                "id_user" => $request->input("user_id"),
//                "id_fournisseur" => $request->input("id_fournisseur"),
//                "created_at" => $request->input("date_de_scan"),
//                "statut"=>"Valider_Automatique",
//                "etat"=>"In",
//                "Quantite_avant_traitement"=>$request->input("Quantite_avant_traitement"),
//                "Quantite_apres_traitement"=>$request->input("Quantite_apres_traitement")
//            ]);
//            if($request->input("Quantite_avant_traitement")!=$request->input("Quantite_apres_traitement")){
//                DB::table("suivi_de_tracabilites")->update([
//                    "statut"=>"Non_Valider"
//                ]);
//            }

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "In validated Successfully"
            ], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json([
                "status" => "error",
                "message" => "Validation failed",
                "errors" => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
// catch (QueryException $e) {
//            // Log the database error for debugging
//            // Log::error("Error in saveValidateOperation: " . $e->getMessage());
//
//            return response()->json([
//                "status" => "error",
//                "message" => "Database error",
//            ], Response::HTTP_INTERNAL_SERVER_ERROR);
//        }
        catch (ModelNotFoundException $e) {
            return response()->json([
                "status" => "error",
                "message" => "Model not found",
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    public function saveOutOperation(Request $request) {
        try {

            DB::beginTransaction();

//            $get_qte = DB::table("colies")
//                ->where("Reference", $request->input("reference_colie"))
//                ->value("Qte_Unitaire");
            //dd($get_qte);

            $stock = Stock::where('Reference_colie',$request->input('reference_colie'))->first();

            $colie = colies::where('Reference',$request->input('reference_colie'))->first();
            $quantite_sortie = $request->input("quantite_sortie");


            $statut = "Valider_Automatique";
            $Quantite_apres_traitement = ($stock->Quantite_Disponible-$quantite_sortie);

            if ($stock->Quantite_Disponible<$quantite_sortie){
                $statut = "Pending";
                $Quantite_apres_traitement = null;
            }

            //dd($quantite_sortie);
            DB::table('suivi_de_tracabilites')->insert([
                'Reference_colie' => $request->input('reference_colie'),
                "id_user" => $request->input("user_id"),
                "id_fournisseur" => $request->input("id_fournisseur"),
                "id_destinataire"=>$request->input("id_destinataire"),
                "statut"=>$statut,
                "etat"=>"Out",
                //"Quantite_avant_traitement"=>$get_qte,
                "Quantite_avant_traitement"=>$stock->Quantite_Disponible,
                //"Quantite_apres_traitement"=>($get_qte-$quantite_sortie),
                "Quantite_apres_traitement"=>$Quantite_apres_traitement,
                "Quantite_sortie"=>$request->input("quantite_sortie"),
                "prix"=> $colie->Prix,
                "created_at" => $request->input("date_de_scan"),
            ]);

//            DB::table("colies")->where("Reference",$request->input("reference_colie"))->update([
//                "Qte_Unitaire"=>$get_qte-$quantite_sortie
//            ]);


            //$get_quantite_disponible = DB::table("stocks")->where("Reference_colie",$request->input("reference_colie"))->value("Quantite_Disponible");

            if ($statut== "Valider_Automatique"){
                $stock->Quantite_Disponible = $stock->Quantite_Disponible-$quantite_sortie;
                $stock->updated_at = Carbon::now();
                $stock->save();
            }

//            DB::table("stocks")->where("Reference_colie",$request->input("reference_colie"))->update([
//                "Quantite_Disponible"=>$stock->Quantite_Disponible-$quantite_sortie
//            ]);

            DB::commit();

            // Optionally, you can return a success response here
            return response()->json(['message' => 'Out validated successfully']);

        } catch (QueryException $ex) {
            // Handle database query exceptions
            return response()->json(['error' => 'Database error: ' . $ex->getMessage()], 500);
        } catch (\Exception $ex) {
            // Handle other exceptions
            return response()->json(['error' => 'An error occurred: ' . $ex->getMessage()], 500);
        }
    }

    public function saveRetourOperation(Request $request){
        try {

            DB::beginTransaction();

//            $get_qte = DB::table("colies")
//                ->where("Reference", $request->input("reference_colie"))
//                ->value("Qte_Unitaire");
            $quantite_retour = $request->input("quantite_retour");

            $stock = Stock::where('Reference_colie',$request->input('reference_colie'))->first();
            $colie = colies::where('Reference',$request->input('reference_colie'))->first();


            // Insert a record into 'suivi_de_tracabilites' table
            DB::table('suivi_de_tracabilites')->insert([
                'Reference_colie' => $request->input('reference_colie'),
                "id_user" => $request->input("user_id"),
                "id_fournisseur" => $request->input("id_fournisseur"),
                "id_destinataire"=>$request->input("id_destinataire"),
                "statut"=>"Valider_Automatique",
                "etat"=>"Retour",
                "prix"=> $colie->Prix,
//                "Quantite_avant_traitement"=>$get_qte,
//                "Quantite_apres_traitement"=>($get_qte+$quantite_retour),
                "Quantite_avant_traitement"=>$stock->Quantite_Disponible,
                "Quantite_apres_traitement"=>($stock->Quantite_Disponible+$quantite_retour),
                "Quantite_retour"=>$quantite_retour,
                "created_at" => $request->input("date_de_scan"),
            ]);

//            DB::table("colies")->where("Reference",$request->input("reference_colie"))->update([
//                "Qte_Unitaire"=>($get_qte+$quantite_retour)
//            ]);

            //$get_quantite_disponible = DB::table("stocks")->where("Reference_colie",$request->input("reference_colie"))->value("Quantite_Disponible");
//            DB::table("stocks")->where("Reference_colie",$request->input("reference_colie"))->update([
//                "Quantite_Disponible"=>$get_quantite_disponible+$quantite_retour
//            ]);

            $stock->Quantite_Disponible = $stock->Quantite_Disponible+$quantite_retour;
            $stock->updated_at = Carbon::now();
            $stock->save();

            DB::commit();

            // Optionally, you can return a success response here
            return response()->json(['message' => 'Retour validated successful']);

        } catch (QueryException $ex) {
            // Handle database query exceptions
            return response()->json(['error' => 'Database error: ' . $ex->getMessage()], 500);
        } catch (\Exception $ex) {
            // Handle other exceptions
            return response()->json(['error' => 'An error occurred: ' . $ex->getMessage()], 500);
        }
    }

    public function NonValider(Request $request){

        DB::beginTransaction();

        try {
            $colie = colies::where('Reference',$request->input('reference_colie'))->first();

            DB::table('suivi_de_tracabilites')->insert([
                'Reference_colie' => $request->input('reference_colie'),
                "id_user" => $request->input("user_id"),
                "id_fournisseur" => $request->input("id_fournisseur"),
                "statut"=>"Non_valider",
                "raison"=>$request->input("raison"),
                "prix"=> $colie->prix,
                "created_at" => $request->input("date_de_scan"),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            // Handle the exception here, you can log or respond with an error message
            DB::rollBack();
            return response()->json(['error' => 'Database operation failed: ' . $e->getMessage()], 500);
        }

        // If everything was successful, you can return a success response here
        return response()->json(['message' => 'Operation completed successfully']);
    }

    public function Registration(Request $request)
    {
        try {
            // Insert data into the database
            DB::table("Demande")->insert([
                "Nom" => $request->input("Nom"),
                "email_pro" => $request->input("email_pro"),
                "Nom_de_Societe" => $request->input("Nom_de_Societe"),
                "Phone_Number" => $request->input("Phone_Number"),
                "created_at" => $request->input("Date_time_demande"),
            ]);

            // Send email after successful registration
            $userEmail = 'berrahouhicham.hb@gmail.com'; // Replace with the actual email address
            $userData = [
                'Nom' => $request->input("Nom"),
                'email_pro' => $request->input("email_pro"),
                'Nom_de_Societe' => $request->input("Nom_de_Societe"),
                'Phone_Number' => $request->input("Phone_Number"),
                'Date_time_demande' => $request->input("Date_time_demande"),
            ];
            // You need to create a Mailable class before using it. For example:
            // php artisan make:mail RegistrationMail
            Mail::to($userEmail)->send(new RegistrationMail($userData));

        } catch (\Exception $e) {
            return response()->json(["message" => "Operation failed"]);
        }

        return response()->json(['message' => 'Operation completed successfully']);
    }

    public function get_Statistics(){
        $get_total_colie = colies::count();
        $get_total_fournisseur = fournisseurs::count();
        $get_total_destinataire = destinataires::count();

        $total_produit_in = Suivi_de_tracabilites::where("etat", "In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat", "Out")->count();
        $total_produit_retour = Suivi_de_tracabilites::where("etat", "Retour")->count();

        $total_operation_pending = Suivi_de_tracabilites::where("statut", "Pending")->count();
        $total_operation_corrigee = Suivi_de_tracabilites::where("statut", "Corrigée")->count();
        $total_operation_derogee = Suivi_de_tracabilites::where("statut", "Déroger")->count();
        $total_operation_annulee = Suivi_de_tracabilites::where("statut", "Annuler")->count();
        $total_operation = Suivi_de_tracabilites::count();

        $operation_in = Suivi_de_tracabilites::where(['etat' => "In"])
            ->whereNotIn('statut', ['Pending', 'Annuler'])
            ->with('colie')
            ->count();

        $operation_return = Suivi_de_tracabilites::where(['etat' => "Retour"])
            ->with('colie')
            ->count();

        $operation_out = Suivi_de_tracabilites::where(['etat' => "Out"])
            ->whereNotIn('statut', ['Pending', 'Annuler'])
            ->with('colie')
            ->count();

        $data = [
            'get_total_colie' => $get_total_colie,
            'get_total_fournisseur' => $get_total_fournisseur,
            'get_total_destinataire' => $get_total_destinataire,
            'total_produit_in' => $total_produit_in,
            'total_produit_out' => $total_produit_out,
            'total_produit_retour' => $total_produit_retour,
            'total_operation_pending' => $total_operation_pending,
            'total_operation_corrigee' => $total_operation_corrigee,
            'total_operation_derogee' => $total_operation_derogee,
            'total_operation_annulee' => $total_operation_annulee,
            'total_operation' => $total_operation,
            'operation_in' => $operation_in,
            'operation_return' => $operation_return,
            'operation_out' => $operation_out,
        ];

        return response()->json($data);
    }

    public function get_stock(){
        $data= Stock::all();
        return response()->json($data);
    }
}
