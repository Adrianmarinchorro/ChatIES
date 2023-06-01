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
        $this->markTestSkipped('Pendiente de login con ldap');

        $user = User::factory()->create();

        $credentials = [
            'username' => $user->username,
            'password' => 'password',
        ];

        $this->assertFalse(Auth::check());

        $response = $this->post('/login', $credentials);

        $this->assertTrue(Auth::check());

        $response->assertRedirect('/');
        $this->assertTrue(Auth::check());
    }
}
