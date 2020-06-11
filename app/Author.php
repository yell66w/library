<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Author;
class Author extends Model
{
    protected $guarded = [];
    protected $dates = ['dob'];    
    
    public function setDobAttribute($dob)
    {
        $this->attributes['dob'] = Carbon::parse($dob);
    }
    
    public function path()
    {
       return '/author/'.$this->id;
    }
}
