<?php

namespace Tests\Feature\ChatIes;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use LdapRecord\Container;
use Tests\TestCase;
use LdapRecord\Connection;

class LoginTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        Container::setDefaultConnection('default');

        $connection = new Connection([
            'hosts' => [env('LDAP_HOST', '127.0.0.1')],
            'username' => env('LDAP_USERNAME', 'cn=user,dc=local,dc=com'),
            'password' => env('LDAP_PASSWORD', 'secret'),
            'port' => env('LDAP_PORT', 389),
            'base_dn' => env('LDAP_BASE_DN', 'dc=local,dc=com'),
        ]);

        Container::addConnection($connection);
    }
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
        // Aquí puedes realizar tus pruebas de inicio de sesión con LDAP.
        // Por ejemplo, intenta autenticar un usuario válido y verifica el resultado.

        $credentials = [
            'username' => 'admin',
            'password' => 'admin',
        ];

        $this->assertFalse(Auth::check());

        $response = $this->post('/login', $credentials);

        $this->assertTrue(Auth::check());

        $response->assertRedirect('/');
        $this->assertTrue(Auth::check());
    }
}
