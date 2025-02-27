<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Henter alle kontakter med pagination
    public function index()
    {
        return Contact::paginate(30);
    }

    // Henter én specifik kontakt
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact, 200);
    }

    // Opdaterer en kontakt (PUT eller PATCH)
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $contact->update($validatedData);

        return response()->json($contact, 200);
    }

    // Sletter en kontakt
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(null, 204);
    }
}
