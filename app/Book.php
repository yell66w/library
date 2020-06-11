<?php

namespace App;
use App\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Book extends Model
{
    protected $guarded = [];
    
    public function path(){
        return '/books/'.$this->id;
    }
}
