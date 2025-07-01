<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * Test that the home page returns 200.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test that the login page is accessible.
     */
    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login'); // assumes "Login" appears on the page
    }

    /**
     * Test that the register page is accessible.
     */
    public function test_register_page_loads(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Register'); // assumes "Register" appears on the page
    }

    /**
     * Test a redirect when accessing a protected route while not logged in.
     */
    public function test_guest_redirected_from_dashboard(): void
    {
        $response = $this->get('/dashboard'); // or any protected route
        $response->assertRedirect('/login'); // assumes guest gets redirected to login
    }

    /**
     * Test a basic post request (optional example).
     */
    public function test_post_request_example(): void
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302); // typically redirects after login
        $response->assertRedirect();  // generic redirect check
    }
    
    
    public function test_non_existing_route_returns_404(): void
    {
        $response = $this->get('/this-route-does-not-exist');
        $response->assertStatus(404);
    }
}
