<?php

namespace App\Http\Controllers;

use App\Imports\ColiesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ImportColiesController extends Controller
{
    public function importColie(Request $request) {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xls,xlsx', // Adjust the allowed file types as needed
        ]);

        try {
            // Import the Excel file
            Excel::import(new ColiesImport, $request->file('file'));

            return redirect()->route("colies.create")->with('success', 'Excel file imported successfully.');
        } catch (\Exception $e) {
            // Handle import exceptions, such as errors in the Excel file
            return redirect()->route("colies.create")->with('error', 'Error importing the Excel file. Please ensure the file is correctly formatted.');
        }
    }
}
