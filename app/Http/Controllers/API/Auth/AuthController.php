<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //аутентифицируем пользователя если токен эквивалентен
    public function __invoke(Request $request)
    {
        return User::where('api_token', mb_substr($request->header('Authorization'), '7'))->get();
    }
}
