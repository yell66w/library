<?php

namespace App;
use App\Book;
use App\Author;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    
    public function path(){
        return '/books/'.$this->id;
    }
    public function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name'=>$author
        ]))->id;
    }
}
