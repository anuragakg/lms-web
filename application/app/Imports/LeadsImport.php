<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Lead;
class LeadsImport implements ToModel, WithValidation,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Lead([
           'name'     => $row[0],
           'phone'    => $row[1],
           'email'    => $row[2],
        ]);
    }
    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'nullable',
            '2' => 'nullable'

        ];
    }
}
