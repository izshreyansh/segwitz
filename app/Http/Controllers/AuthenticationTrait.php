<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

trait AuthenticationTrait
{
    /**
     * Perform Login And Return Token
     *
     * @param Request $request
     *
     * @return array (Token)
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request([
            'email',
            'password'
        ]);

        if (!Auth::guard($this->guardName)->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = Auth::guard($this->guardName)
            ->user()
            ->createToken(
                auth()->guard($this->guardName)->user()->name
            );

        return [
            'user'  => auth()->guard($this->guardName)->user(),
            'token' => $token->plainTextToken,
        ];
    }

    /**
     * Return user info
     */
    public function me(Request $request)
    {
        return auth()->user();
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function update(Request $request)
    {
        $userTable = $this->guardName == 'web' ? 'clients' : 'admins';
        $request->validate([
            'name'     => 'required',
            'email'    => "required|unique:{$userTable},email," . $request->user()->id,
            'password' => 'required',
        ]);

        auth()->user()->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return [
            'status'  => 'success',
            'message' => 'User updated successfully.',
            'user'    => $request->user()
        ];
    }

    /**
     * Logout user
     *
     * @return string[]
     */
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return [
            'status'  => 'success',
            'message' => 'Logout successful.'
        ];
    }
}
