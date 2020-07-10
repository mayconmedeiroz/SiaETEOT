<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Able extends Model
{
    use SoftDeletes;

    protected $primaryKey = "able_id";

    protected $fillable = [
        "school_year", "employee_id", "discipline_id"
    ];
}
