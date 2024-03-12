<?php

namespace App\Http\Controllers;

use App\Exports\FournisseurExport;
use App\Models\fournisseurs;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportFournisseurController extends Controller
{
    public function ExportFournisseur(){

        $data = fournisseurs::all();
        return Excel::download(new FournisseurExport($data),"Fournisseur.xlsx");
    }
}
