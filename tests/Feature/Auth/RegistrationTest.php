<?php

namespace Tests\Feature\Auth;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class RegistrationTest extends TestCase
{
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_to_check_if_we_can_create_new_users()
    {
        $response = $this->postJson('/api/auth/register', data: [
            'email' => $email = $this->faker->safeEmail(),
            'name'=> $this->faker->name(),
            'password'=> $password = 'Gulabzari2020@',
            'password_confirmation' => $password

        ])->assertStatus(status: 201)
            ->assertJsonStructure([
                'access_token', 'token_type'
                ]);
        //$this->assertTrue(true);
        //dd($response);

        $this->assertDatabaseHas(table: 'users', data: ['email'=>$email]);


        $response->assertStatus(status: 201);


    }

    /**
     * @return void
     */
    public function test_if_database_allows_duplicated_emails(): void
    {

        $email = 'sulemancontact@yahoo.com';

        User::factory()->create([
            'email' => $email,
        ]);

        $response = $this->postJson('/api/auth/register', data: [
            'email' => $email,
            'name'=> $this->faker->name(),
            'password'=> $password = 'Gulabzari2020@',
            'password_confirmation' => $password

        ])->assertJsonFragment(['email'=> ['The email has already been taken.']]);



    }
}
