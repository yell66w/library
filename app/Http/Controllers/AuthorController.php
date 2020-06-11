<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
class AuthorController extends Controller
{
    public function store()
    {
        $data = $this->validateRequest();
        $author = Author::create($data);
        return redirect($author->path());
    }
    protected function validateRequest()
    {
        return request()->validate([
            'name'=>'required',
            'dob'=>'required'
        ]);
    }
}
