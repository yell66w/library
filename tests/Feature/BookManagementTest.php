<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
use App\Author;
class BookManagementTest extends TestCase
{
   use RefreshDatabase;
   /** @test */
   public function a_book_can_be_added_to_the_library()
   {
        
        $response = $this->post('/books',$this->data());

        $book = Book::first();
        $this->assertCount(1,Book::all());
        $response->assertRedirect($book->fresh()->path());
   }

    /** @test */
    public function a_title_is_required()
    {
        
         $response = $this->post('/books',array_merge($this->data(),['title'=>'']));
 
         $response->assertSessionHasErrors('title');
        
    }

    /** @test */
    public function an_author_is_required()
    {
        
         $response = $this->post('/books',array_merge($this->data(),['author_id'=>'']));
 
         $response->assertSessionHasErrors('author_id');
        
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/books',$this->data());
        
         $book = Book::first();
         $author = Author::first();
         
         $response = $this->patch('/books/'.$book->id,[
            'title'=>'New Book',
            'author_id'=>"??"
         ]);
      
         $this->assertEquals('New Book',Book::first()->title);
         $this->assertEquals(2,Book::first()->author_id);
         $response->assertRedirect($book->fresh()->path());
        
    }
     /** @test */
    public function a_book_can_be_deleted()
    {
        
        $this->post('/books',$this->data());
        $book = Book::first();
        $this->assertCount(1,Book::all());
        $response = $this->delete('/books/'.$book->id);
 
        $this->assertCount(0,Book::all());
        $response->assertRedirect('/books');
    }
     /** @test */
     public function a_new_author_is_automatically_created()
     {

        $this->post('/books',$this->data());
        
        $book = Book::first();
        $author = Author::first();
       
        $this->assertEquals($author->id,$book->author_id);
        $this->assertCount(1,Author::all());

     }

     /** methods */
     private function data()
     {
         return [
            'title'=>'Cool Book Title',
            'author_id'=>'Cool'
         ];
     }
 

}
