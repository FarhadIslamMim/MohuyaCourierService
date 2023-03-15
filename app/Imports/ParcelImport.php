<?php

namespace App\Imports;

use App\Models\TempImportParecel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParcelImport implements ToModel, WithHeadingRow
{
    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $temp_no = rand(12364, 36542);

        return $row;
        // return new TempImportParecel([
        //     //
        //     'temp_no'   => $temp_no,
        //     'invoiceNo' => $row[1],
        //     'recipientName' => $row[2],
        //     'productPrice' => $row[3],
        //     'recipientPhone' => $row[4],
        //     'alternative_mobile_no' => $row[5],
        //     'recipientAddress' => $row[6],
        //     'productWeight' => $row[7],
        //     'note' => $row[7],
        // ]);
    }
}
