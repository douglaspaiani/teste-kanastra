<?php

namespace App\Imports;

use App\Models\Uploads;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        //dd($row);
        return new Uploads([
            'name' => trim($row['name']),
            'governmentId' => trim($row['governmentid']),
            'email' => trim($row['email']),
            'debtAmount' => trim($row['debtamount']),
            'debtDueDate' => trim($row['debtduedate']),
            'debtID' => trim($row['debtid'])
        ]);
    }

    public function getCsvSettings(): array
    {
         return [
              'input_encoding' => 'UTF-8'
         ];
    }
    
    public function chunkSize(): int
    {
        return 7000;
    }
}
