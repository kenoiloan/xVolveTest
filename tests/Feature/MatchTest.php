<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testMatch(){
        $response = $this->get('user/match');
        $response ->assertStatus(200);
        $response->assertViewIs('match')->assertSee('match');
    }
    public function testMatched(){
        $response = $this->post('user/matched');
        $response ->assertStatus(200);
    }
}
