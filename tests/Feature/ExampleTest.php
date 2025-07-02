<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login'); 
    }

    public function test_register_page_loads(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Register'); 
    }

    public function test_guest_redirected_from_dashboard(): void
    {
        $response = $this->get('/dashboard'); 
        $response->assertRedirect('/login'); 
    }
    public function test_post_request_example(): void
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302); 
        $response->assertRedirect(); 
    }
    
    public function test_non_existing_route_returns_404(): void
    {
        $response = $this->get('/this-route-does-not-exist');
        $response->assertStatus(404);
    }
}
