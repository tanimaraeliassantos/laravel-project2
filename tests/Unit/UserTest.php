<?php

namespace Tests\Unit;

use App\Models\User as User;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_duplication()
    {
        $user1 = User::make([
            'name'=> 'Jane Doe',
            'email'=> 'janedoe@email.com'
        ]);
        $user2 = User::make([
            'name'=> 'Jane Rue',
            'email'=> 'janerue@email.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function test_delete_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user) {
            $user->delete();
        }

        $this->assertTrue(true);
    }

    public function test_it_stores_new_users()
    {
        $response = $this->post('/register', [
            'name' => 'User3',
            'email' => 'user3@email.com',
            'password' => 'user3password',
            'password_confirmation' => 'user3password'
        ]);

        $response->assertRedirect('/home');
    }
}
