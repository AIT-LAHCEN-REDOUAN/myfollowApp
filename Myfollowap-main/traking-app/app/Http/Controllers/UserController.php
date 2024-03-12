<?php

namespace App\Http\Controllers;

use App\Models\colies;
use App\Models\destinataires;
use App\Models\fournisseurs;
use App\Models\permissions;
use App\Models\roles;
use App\Models\statuts;
use App\Models\Suivi_de_tracabilites;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission ;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $get_users=User::with("role")->orderBy("updated_at","desc")->paginate(20);
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();


        return view("admin.users.user",["users"=>$get_users,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_all_permissions = DB::table("permissions")->get();
        $get_roles = roles::all();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.users.AddUser",["total_colie"=>$get_total_colie,"permissions"=>$get_all_permissions,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"roles"=>$get_roles,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $email = null;
        if ($request->input("email") && $request->input("email")!="" && $request->input("email")!=null){
            $email = $request->input("email");
        }
        $new_user = User::create([
            "name"=>strip_tags($request->input("name")),
            "email"=>$email,
            "Matricule"=>strip_tags($request->input("matricule")),
            "password"=>strip_tags(Hash::make($request->input("password"))),
            "original_password"=>strip_tags($request->input("password")),
            "id_role"=>strip_tags($request->role)]);

        $new_user->givePermissionTo($request->input("permissions"));
        $new_user->save();
        return redirect()->route("users.create")->withSuccess("Success",true);
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
    public function edit(string $id)
    {
        $get_user = User::where("id",$id)->first();
        $get_roles =roles::all();
        $get_total_colie=colies::where('deleted_at',null)->get()->count();
        $get_total_fournisseur=fournisseurs::all()->count();
        $get_total_destinataire=destinataires::all()->count();
        $get_all_permissions = DB::table("permissions")->get();
        //more
        $total_produit_in = Suivi_de_tracabilites::where("etat","In")->count();
        $total_produit_out = Suivi_de_tracabilites::where("etat","Out")->count();
        $total_produit_retour= Suivi_de_tracabilites::where("etat","Retour")->count();
        $total_operation = Suivi_de_tracabilites::all()->count();

        return view("admin.users.EditUser",["permissions"=>$get_all_permissions,"item"=>$get_user ,"total_colie"=>$get_total_colie,"total_fournisseur"=>$get_total_fournisseur,"total_destinataire"=>$get_total_destinataire,"role"=>$get_roles,"total_in"=>$total_produit_in,"total_out"=>$total_produit_out,"total_retour"=>$total_produit_retour,"total_operation"=>$total_operation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Update user information
    $affectedRows = DB::table('users')
        ->where('id', $id)
        ->update([
            'email' => strip_tags($request->input("email")),
            'name' => strip_tags($request->input("name")),
            "Matricule" => strip_tags($request->input("matricule")),
            "password" => strip_tags(Hash::make($request->input("password"))),
            "original_password" => strip_tags($request->input("password")),
            'id_role' => strip_tags($request->role),
        ]);

    // Get the user
    $user = User::find($id);

    // Update permissions
    $user->syncPermissions($request->input("permissions"));

    return redirect()->route("users.index")->withSuccess("update_success", true);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        $user = DB::table("users")->where("id",$id)->delete();
        return redirect()->route("users.index")->withSuccess("delete_success","delete_success");
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }


}
