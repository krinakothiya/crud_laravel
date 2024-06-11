<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';                          // specify the table name if different from the default
    protected $primaryKey = 'id';                // specify the primary key if different from 'id'



    // protected $fillable = [
    //     'Name', 'Phone', 'Age', 'Address', 'Gender', 'Hobby', 'City', 'Img'
    // ];
}
