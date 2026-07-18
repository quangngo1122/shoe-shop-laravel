<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\Address;
use App\Models\User;
use App\Repository\Eloquent\AddressRepository;
use App\Repository\Eloquent\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Mockery;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_store_redirects_to_verification_page_when_email_notification_fails()
    {
        $request = Mockery::mock(UserRegisterRequest::class);
        $request->shouldReceive('validated')->andReturn([
            'name' => 'Nguyễn Văn A',
            'email' => 'test@example.com',
            'password' => 'Abc123!@#',
            'password_confirm' => 'Abc123!@#',
            'phone_number' => '0912345678',
            'city' => 1,
            'district' => 1,
            'ward' => 1,
            'apartment_number' => '123A',
        ]);

        $user = Mockery::mock(User::class)->makePartial();
        $user->shouldReceive('notify')->once()->andThrow(new Exception('SMTP failed'));
        $user->id = 42;
        $user->email = 'test@example.com';

        $userRepository = Mockery::mock(UserRepository::class);
        $userRepository->shouldReceive('create')->once()->andReturn($user);

        $addressRepository = Mockery::mock(AddressRepository::class);
        $addressRepository->shouldReceive('updateOrCreate')->once()->andReturn(new Address());

        Route::get('/verify-email/{user}', function ($user) {
            return 'ok';
        })->name('user.verification.notice');

        config(['auth.verification.expire.resend' => 60]);
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();
        DB::shouldReceive('rollBack')->never();
        Log::shouldReceive('warning')->once();
        Log::shouldReceive('error')->never();

        $userVerify = Mockery::mock('alias:App\\Models\\UserVerify');
        $userVerify->shouldReceive('updateOrCreate')->once()->andReturn(new \stdClass());

        $controller = new RegisterController($userRepository, $addressRepository);
        $response = $controller->store($request);

        $this->assertTrue($response->isRedirect());
        $this->assertEquals(route('user.verification.notice', $user->id), $response->getTargetUrl());
        $this->assertEquals('Tài khoản đã được tạo, nhưng email xác nhận chưa gửi được. Bạn có thể gửi lại từ màn hình tiếp theo.', session('warning'));
    }
}
