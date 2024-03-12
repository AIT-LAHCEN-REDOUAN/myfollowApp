<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DestinataireExport implements FromArray, WithHeadings, WithStyles
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
            "name",
            "email",
            "Telephone",
            "date Creation",
        ];
    }

    public function array(): array
    {
        return $this->data->map(function ($item) {
            // Modify the data to include the Fournisseur name instead of ID
            return [
                $item->id,
                $item->name,
                $item->email,
                $item->Telephone, // Access the related Fournisseur's name
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
