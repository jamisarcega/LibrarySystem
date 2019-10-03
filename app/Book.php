<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    

    protected $fillable = [
        'book_title', 'author',  'shelf_number', 'stocks', 'book_number'
    ];
    protected $dates = [ 'date_borrowed','return_date'];
}
