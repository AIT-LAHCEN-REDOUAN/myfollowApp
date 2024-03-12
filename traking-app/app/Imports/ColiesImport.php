<?php

namespace App\Imports;

use App\Models\colies;
use App\Models\fournisseurs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Carbon;
use Milon\Barcode\DNS2D;


class ColiesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Skip the first row (header)
    }

    private function getFournisseurId($fournisseurName) {
        return fournisseurs::where("name", $fournisseurName)->value("id");
    }

    public function model(array $row)
    {
        $fournisseurName = $row[2]; // Assuming the Fournisseur name is in the fourth column (index 3)
        $fournisseurId = $this->getFournisseurId($fournisseurName);

        $min = 100; // Minimum value for 3 digits
        $max = 999; // Maximum value for 3 digits

        $randomNumber = mt_rand($min, $max);
        $reference = substr($row[0], 0,3).substr($row[2], 0,3).$randomNumber;

        $colie = colies::where('Reference',$reference)->first();
        while ($colie){
            $randomNumber = mt_rand($min, $max);
            $reference = substr($row[0], 0,3).substr($row[2], 0,3).$randomNumber;
            $colie = colies::where('Reference',$reference)->first();
        }
        $qrCode = new DNS2D();
        $qrCode->setStorPath(public_path("qrcodes"));
        $qrCodePath = $qrCode->getBarcodePNGPath($reference, "QRCODE", 3, 3, [0, 0, 0]);

        return new colies([
            "Reference" => $reference,
            "Designation" => $row[0],
            "Qte_Unitaire" => $row[1],
            "id_Fournisseur" => $fournisseurId,
            "Prix" => $row[3],
            "Qr_code" => $qrCodePath, // Store the QR code image path
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
    }
}
