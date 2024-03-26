<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    public $table="admission_forms_tables";
    public $timestamps=false;
    use HasFactory;

    

}