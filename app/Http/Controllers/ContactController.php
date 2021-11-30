<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        if ($this->isAdmin()) {
            $contacts = Contact::paginate();
        } else {
            $contacts = auth()->user()->contacts()->paginate();
        }

        return [
            'message'  => 'success',
            'contacts' => $contacts
        ];
    }

    /**
     * @param Contact $contact
     *
     * @return Contact
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if ($this->isAdmin()) {
            $client_id = $request->input('client_id');
        } else {
            $client_id = auth()->user()->id;
        }

        $contact = Contact::create([
            'name'          => $request->input('name'),
            'star'          => $request->has('star'),
            'email'         => $request->input('email'),
            'phone'         => $request->input('phone'),
            'business_name' => $request->input('business_name'),
            'client_id'     => $client_id,
        ]);

        return [
            'status'  => 'success',
            'message' => 'Contact created successfully.',
            'user'    => $contact
        ];
    }

    /**
     * @param Request $request
     * @param Contact $contact
     *
     * @return array
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if ($this->isAdmin()) {
            $client_id = $request->input('client_id');
        } else {
            $client_id = auth()->user()->id;
        }

        $contact->update([
            'name'          => $request->input('name'),
            'star'          => $request->has('star'),
            'email'         => $request->input('email'),
            'phone'         => $request->input('phone'),
            'business_name' => $request->input('business_name'),
            'client_id'     => $client_id,
        ]);

        return [
            'status'  => 'success',
            'message' => 'Contact updated successfully.',
            'user'    => $contact
        ];
    }

    /**
     * @param Contact $contact
     *
     * @return string[]
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return [
            'status'  => 'success',
            'message' => 'Contact deleted successfully.'
        ];
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return basename(str_replace('\\', '/', get_class(auth()->user()))) == 'Admin';
    }
}
