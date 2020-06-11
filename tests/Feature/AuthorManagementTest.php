<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Author;
use Carbon\Carbon;
class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/author',[
            'name'=>'Author Name',
            'dob'=>'05/14/1988'
        ]);
        $author = Author::first();
        $this->assertCount(1,Author::all());
        $this->assertInstanceOf(Carbon::class,$author->dob);
        $this->assertEquals('1988/14/05',$author->dob->format('Y/d/m'));
        $response->assertRedirect($author->fresh()->path());
    }
}
