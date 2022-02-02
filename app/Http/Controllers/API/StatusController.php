<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function status_create(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);

            Status::create([
                'name' => $request->name,
            ]);

            $status = Status::where('name', $request->name)->first();


            return ResponseFormatter::success([
                'name' => $status,
            ], 'Status Registered'
            );

        } catch (Exception $error)
        {
            return ResponseFormatter::error([
                'massage' => 'Something went wrong',
                'error' => $error
            ], 'Register Failed', 500
            );

        }
    }
}
