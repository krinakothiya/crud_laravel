<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'media';                          // specify the table name if different from the default
    protected $primaryKey = 'media_id';
}
