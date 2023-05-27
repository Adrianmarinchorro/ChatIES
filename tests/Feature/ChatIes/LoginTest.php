<?php

namespace Tests\Feature\ChatIes;

use Inertia\Testing\AssertableInertia as Assert;
use LdapRecord\Testing\DirectoryFake;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_can_see_the_login_page(): void
    {
        $this->get('/login')
            ->assertStatus(200);
    }


    public function test_non_registered_user_cannot_be_logged(): void
    {
        $this->post('/login', [
            'username' => 'user',
            'password' => '123'
        ])
            ->assertStatus(302)
            ->assertSessionHasErrors('username', 'These credentials do not match our records.');
    }

    public function test_registered_user_can_be_logged()
    {
        $this->post('/login', [
            'username' => 'am',
            'password' => '123'
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/chat');
    }
}
