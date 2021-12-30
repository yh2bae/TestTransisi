<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'nama', 'company_id', 'email'
    ];

    public function company() 
    {
        return $this->belongsTo(Companies::class);
    }

}
