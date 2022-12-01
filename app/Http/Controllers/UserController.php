<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()->view('user.login', [
            'title' => 'Login'
        ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'username' => 'required|alpha_dash',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        if ($this->userService->login($username, $password)) {
            $request->session()->put('username', $username);

            return redirect('/');
        }

        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'User or password wrong'
        ]);
    }

    public function register(): Response
    {
        return response()->view('user.register', [
            'title' => 'Register'
        ]);
    }
    public function doRegister(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_dash|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $registerData = [];
        $registerData['name'] = $request->input('name');
        $registerData['username'] = $request->input('username');
        $registerData['email'] = $request->input('email');
        $registerData['password'] = $request->input('password');

        $data = [
            'title' => 'Register'
        ];

        try {
            $this->userService->register($registerData);
           
            $data['success'] = 'Registrasi berhasil. Silahkan login';
            return response()->view('user.register', $data);
        } catch (\Exception $e) {
            $data['error'] = $e->getMessage();
            return response()->view('user.register', $data);
        }
    }
    
       public function doLogout(Request $request): Response|RedirectResponse
        {
            $request->session()->forget('username');
    
            return redirect('/login');
        }
    
}