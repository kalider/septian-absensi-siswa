<?php

namespace Tests\Feature;


use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
	use RefreshDatabase;

	private UserService $userService;

	protected function setUp(): void
	{
		parent::setUp();

		$this->userService = $this->app->make(UserService::class);
	}

	public function testLoginSuccess()
	{
		$this->seed(UserSeeder::class);

		self::assertTrue($this->userService->login("aldi", "bebas"));
	}

	public function testLoginUserNotFound()
	{
		self::assertFalse($this->userService->login('salah', 'salah'));
	}

	public function testLoginWrongPassword()
	{
		$this->seed(UserSeeder::class);

		self::assertFalse($this->userService->login('aldi', 'salah'));
	}

	public function testRegisterSuccess()
	{
		$registerData = [];
		$registerData['name'] = "aldi 2";
		$registerData['username'] = "aldi2";
		$registerData['email'] = "septian.id";
		$registerData['password'] = "aldi2";

		self::assertTrue($this->userService->register($registerData));
	}

	public function testRegisterUsernameExist()
	{
		$this->seed(UserSeeder::class);

		$registerData = [];
		$registerData['name'] = "Sudah ada";
		$registerData['username'] = "aldi";
		$registerData['email'] = "sudah1@ada.com";
		$registerData['password'] = "sudahada";

		try {
			$this->userService->register($registerData);
		} catch (Exception $e) {
			self::assertSame('Username sudah terdaftar', $e->getMessage());
		}
	}

	public function testRegisterEmailExist()
	{
		$this->seed(UserSeeder::class);

		$registerData =[];
		$registerData['name'] = "Sudah ada";
		$registerData['username'] = "sudah_ada2";
		$registerData['email'] = "septiana@gmail.com";
		$registerData['password'] = "sudahada";

		try {
			$this->userService->register($registerData);
		} catch (Exception $e) {
			self::assertSame('Email sudah terdaftar', $e->getMessage());
		}
	}
}
