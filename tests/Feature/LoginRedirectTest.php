<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginRedirectTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function admin_redirects_to_admin_dashboard()
    {
        $user = User::factory()->create()->assignRole('super-admin');
        $this->actingAs($user)->get('/dashboard')
            ->assertRedirect('/admin');
    }
}
