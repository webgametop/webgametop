<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserViewCountController extends Controller
{
    public function __invoke(User $user)
    {
        return response()->json(['d' => $user->id]);
    }
}
