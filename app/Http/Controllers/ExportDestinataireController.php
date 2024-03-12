<?php

namespace App\Http\Controllers;

use App\Exports\DestinataireExport;
use App\Models\destinataires;
use Maatwebsite\Excel\Facades\Excel;

class ExportDestinataireController extends Controller
{
    public function ExportDestinataire(){

        $data = destinataires::all();
        return Excel::download(new DestinataireExport($data),"Client.xlsx");
    }
}
