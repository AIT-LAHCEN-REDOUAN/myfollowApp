<?php

namespace App\Http\Controllers;

use App\Imports\FournisseursImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportFournisseursController extends Controller
{
    public function importFournisseur(Request $request){
        $request->validate([
            'file' => 'required|mimes:xls,xlsx', // Adjust the allowed file types as needed
        ]);

        try {
            // Import the Excel file
            Excel::import(new FournisseursImport, $request->file('file'));

            return redirect()->route("fournisseurs.create")->with('success', 'Excel file imported successfully.');
        } catch (\Exception $e) {
            // Handle import exceptions, such as errors in the Excel file
            return redirect()->route("fournisseurs.create")->with('error', 'Erreur lors de l\'importation du fichier Excel. Assurez-vous que le fichier est correctement formaté.');
        }
    }
}

