<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAccessToHomepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_WelcomeViewCanBeRendered()
    {
        $view = $this->view('welcome');

        $view->assertSee('URL Shortener');
    }

    public function testSubmissionOfURL()
    {
        $response = $this->postJSON('/api/shorten', ['original_link' => 'https://www.bing.com']);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'short_link',
                    'code',
            ]);
    }

     public function testFetchUnknownURL()
    {
        $this->get('/api/fetchURL', [
            'link' => '/4J1'
        ])->assertRedirect('http://localhost');
    }


}
