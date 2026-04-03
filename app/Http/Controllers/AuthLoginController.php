<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support;

class AuthLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('web.users.sign-in');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserLoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = \Auth::user();

        $message_template = 'С возвращением, <b>:nickname</b>!';
        $message = Support\Str::replace(':nickname', $user->nickname, $message_template);

        $route_data = [$user, $user->username];
        $flash_data = ['type' => 'success', 'message' => $message];

        return redirect()->intended(route('users.show', $route_data))->with('flash', $flash_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = \Auth::user();

        $message_template = 'До скорой встречи, <b>:nickname</b>!';
        $message = Support\Str::replace(':nickname', $user->nickname, $message_template);

        Facades\Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('users')->with('flash', ['type' => 'info', 'message' => $message]);
    }
}
