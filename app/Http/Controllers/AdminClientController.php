<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function store(Request $request)
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

    /**
     * @param Client $client
     *
     * @return Client
     */
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => "required|unique:clients,email," . $client->id,
            'password' => 'required',
        ]);

        auth()->user()->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return [
            'status'  => 'success',
            'message' => 'Client updated successfully.',
            'user'    => $client
        ];
    }

    /**
     * @param Client $client
     *
     * @return string[]
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return [
            'status'  => 'success',
            'message' => 'Client deleted successfully.'
        ];
    }

}
