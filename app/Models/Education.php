<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'education';                          // specify the table name if different from the default
    protected $primaryKey = 'stu_id';
}
