<?php

namespace App\Http\Controllers;
use App\Exports\OperationsExport;
use App\Models\Suivi_de_tracabilites;
use Maatwebsite\Excel\Facades\Excel;
class ExportOperation extends Controller
{

    public function ExportOperation() {
       $data=Suivi_de_tracabilites::all();
       return Excel::download(new OperationsExport($data),"Operations.xlsx"); 
    }
    
}
