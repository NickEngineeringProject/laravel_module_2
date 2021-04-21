<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //генерирует токен на основе телефона и пароля
    public function __invoke(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $token = Str::uuid()->toString();

        $user = User::where('phone', $request->get('phone'))
            ->where('password', $request->get('password'))
            ->firstOrFail();

        $user->api_token = $token;

        $user->save();

        return Response::json($token, 200);
    }
}
