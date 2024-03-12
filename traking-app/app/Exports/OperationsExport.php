<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OperationsExport implements FromArray, WithHeadings, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            "id",
            "Reference_colie",
            "Designation",
            "Fournisseur",
            "Prix",
            "name",
            "Quantite_apres_traitement",
            "Quantite_avant_traitement",
            "Quantite sortie","Quantite Retour",
            "statut",
            "etat",
            "raison",
            "motif",
            "date de Creation"
        ];
    }

    public function array(): array
    {
        return $this->data->map(function ($item) {
            // Modify the data to include the Fournisseur name instead of ID
            return [
                $item->id,
                $item->Reference_colie,
                $item->colie->Designation,
                $item->colie->Fournisseur->name, // Access the related Fournisseur's name
                $item->colie->Prix . " DH",
                $item->user->name,
                $item->Quantite_apres_traitement,
                $item->Quantite_avant_traitement ,
                $item->Quantite_sortie,
                $item->Quantite_Retour,
                $item->statut,
                $item->etat,
                $item->raison,
                $item->motif,
                $item->created_at,
                
            ];
        })->toArray();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row (headings) to make them bold and centered.
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
}
