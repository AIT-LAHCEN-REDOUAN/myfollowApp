<?php

namespace App\Imports;

use App\Models\destinataires;
use Maatwebsite\Excel\Concerns\ToModel;

class DestinatairesImport implements ToModel
{

    public function startRow(): int
    {
        return 2; // Skip the first row (header)
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new destinataires([
            "id" => $row[0],
            "name" => $row[1],
            "email" => $row[2],
            "Telephone" => $row[3],
            "created_at" => $row[4],
        ]);
    }
}
