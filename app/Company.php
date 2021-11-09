<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table = 'company';

    protected $primaryKey = 'company_id';

    protected $fillable = [
        'name', 'description'
    ];
}
