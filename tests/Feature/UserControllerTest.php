<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginPageUserAlreadyLogin()
    {
        $this->withSession(['username' => 'aldi'])
            ->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);

        $this->post('/login', [
            'username' => 'aldi',
            'password' => 'bebas'
        ])->assertRedirect('/');
    }

    public function testLoginUserAlreadyLogin()
    {
        $this->withSession(['username' => 'aldi'])
            ->post('/login', [
                'username' => 'aldi',
                'password' => 'bebas'
            ])
            ->assertRedirect('/');
    }


    public function testValidationFailed()
    {
        $this->post('/login', [])
            ->assertSessionHasErrors(['username', 'password']);
    }

    public function testValidationUsernameNull()
    {
        $this->post('/login', [
            'username' => '',
            'password' => 'sayang'
        ])
            ->assertSessionHasErrors(['username']);
    }

    public function testValidationPasswordNull()
    {
        $this->post('/login', [
            'username' => 'aldi',
            'password' => ''
        ])
            ->assertSessionHasErrors(['password']);
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'username' => 'salah',
            'password' => 'salah'
        ])->assertSeeText('User or password wrong');
    }

    public function testRegisterPage()
    {
        $this->get('/register')
            ->assertSeeText('Register');
    }

    public function testRegisterSuccess()
    {
        $this->post('/register', [
            'name' => 'Septiana Renaldy',
            'username' => 'Ren',
            'email' => 'barbara@gmail.com',
            'password' => 'naon',
            'password_confirmation' => 'naon'
        ])->assertSeeText('Registrasi berhasil. Silahkan login');
    }

    public function testRegisterUsernameExist()
    {
        $this->seed(UserSeeder::class);
        
        $this->post('/register', [
            'name' => 'Septiana Renaldy',
            'username' => 'aldi',
            'email' => 'barbara@gmail.com',
            'password' => 'naon',
            'password_confirmation' => 'naon'
        ])->assertSessionHasErrors(['username']);
    }

    public function testRegisterEmailExist()
    {
        $this->seed(UserSeeder::class);
        
        $this->post('/register', [
            'name' => 'Septiana Renaldy',
            'username' => 'Ren',
            'email' => 'septiana@gmail.com',
            'password' => 'naon',
            'password_confirmation' => 'naon'
        ])->assertSessionHasErrors(['email']);
    }

    public function testRegisterPasswordNotSame()
    {
        $this->post('/register', [
            'name' => 'Muhamad Fatahillah',
            'username' => 'Ren',
            'email' => 'septiana@gmail.com',
            'password' => 'naon',
            'password_confirmation' => 'naon1'
        ])->assertSessionHasErrors(['password']);
    }

}
