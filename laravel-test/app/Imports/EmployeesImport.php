<?php

namespace App\Imports;

use App\Employees;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employees([
            'nama' => $row[0],
            'company_id' => $row[1], 
            'email' => $row[2], 
        ]);
    }
}
