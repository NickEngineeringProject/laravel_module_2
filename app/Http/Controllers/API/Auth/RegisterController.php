<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    //Регистрация пользователя
    public function __invoke(UserRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            'password' => $request->get('password'),
            'document_number' => $request->get('document_number'),
        ]);

        return Response::json($user, 204);
    }
}
