<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use AuthenticationTrait;

    /**
     * @var string
     */
    public $guardName = 'web';

    /**
     * @param Request $request
     *
     * @return array
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|unique:clients,email',
            'password' => 'required|min:8',
        ]);

        $client = Client::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return [
            'status'  => 'success',
            'message' => 'User created successfully.',
            'user'    => $client
        ];
    }
}
