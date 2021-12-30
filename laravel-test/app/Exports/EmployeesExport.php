<?php

namespace App\Exports;

use App\Companies;
use App\Employees;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employees::all([
            'nama', 
            'company_id',
            'email'
        ]);
    }
}
