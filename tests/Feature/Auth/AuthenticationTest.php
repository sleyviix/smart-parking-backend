<?php

namespace Tests\Feature\Auth;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
class ExampleTest extends TestCase
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

    public function test_if_token_is_generated(){

        $user = User::factory()->create([

            'email' => $email = $this->faker->safeEmail(),
            'password'=> bcrypt($password = Str::random())
        ]);


        $response = $this->postJson('/api/auth/loginToken', data: [
            'email' => $email,
            'password'=> $password

        ])->assertStatus(200)->assertJsonStructure([
            'access_token', 'token_type'
        ]);

    }
}
