<?php
namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;
class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        // here i am checking if the currently logout in users has a role_id of 2 which make him a regular user and then redirect to the users dashboard else the admin dashboard
        if (auth()->user()->roles == "ADMIN") {
            return redirect()->intended(config('fortify.home'));
        }
        return redirect()->intended(config('fortify.admin.home'));
    }
}
