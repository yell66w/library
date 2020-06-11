<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
class BookManagementTest extends TestCase
{
   use RefreshDatabase;
    /** @test */
   public function a_book_can_be_added_to_the_library()
   {
        
        $response = $this->post('/books',[
            'title'=>'Cool Book Title',
            'author'=>'Ryan Tillaman'
        ]);

        $book = Book::first();
        $this->assertCount(1,Book::all());
        $response->assertRedirect($book->fresh()->path());
   }

    /** @test */
    public function a_title_is_required()
    {
        
         $response = $this->post('/books',[
             'title'=>'',
             'author'=>'Ryan Tillaman'
         ]);
 
         $response->assertSessionHasErrors('title');
        
    }

    /** @test */
    public function an_author_is_required()
    {
        
         $response = $this->post('/books',[
             'title'=>'Cool Book',
             'author'=>''
         ]);
 
         $response->assertSessionHasErrors('author');
        
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/books',[
             'title'=>'Cool Book',
             'author'=>'Cool Author'
         ]);
         $book = Book::first();

         $response = $this->patch('/books/'.$book->id,[
            'title'=>'New Book',
            'author'=>'New Author'
         ]);
 
         $this->assertEquals('New Book',Book::first()->title);
         $this->assertEquals('New Author',Book::first()->author);
         $response->assertRedirect($book->fresh()->path());
        
    }
     /** @test */
    public function a_book_can_be_deleted()
    {
        
        $this->post('/books',[
             'title'=>'Cool Book',
             'author'=>'Cool Author'
         ]);
        $book = Book::first();
        $this->assertCount(1,Book::all());
        $response = $this->delete('/books/'.$book->id);
 
        $this->assertCount(0,Book::all());
        $response->assertRedirect('/books');
    }
 

}
