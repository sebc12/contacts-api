<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index()
    {
        return Contact::paginate(30);
    }

    public function edit(Request $request, $id)
    
    {
        $contact = Contact::findOrfail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $contact->update($validatedData);

        return response()->json($contact, 200);
    }

    public function delete($id)
    {
        $contact = Contact::findOrfail($id);
        $contact->delete();

        return response()->json(null, 204);
    }

}
