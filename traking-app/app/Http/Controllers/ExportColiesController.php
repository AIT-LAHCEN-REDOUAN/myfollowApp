<?php

namespace App\Http\Controllers;

use App\Exports\ColiesExport;
use App\Models\colies;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportColiesController extends Controller
{
    public function exportColie(){

        
        $data = colies::all();
        return Excel::download(new ColiesExport($data),"colies.xlsx");
    }
}
