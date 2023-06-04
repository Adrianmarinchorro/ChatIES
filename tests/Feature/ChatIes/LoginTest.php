<?php

namespace Tests\Feature\ChatIes;

use Tests\TestCase;
use App\Models\User;
use LdapRecord\Container;
use LdapRecord\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_can_see_the_login_page(): void
    {
        $this->get('/login')
            ->assertStatus(200);
    }

}
