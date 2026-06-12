<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $contacts = $request->user()->contacts()
            ->orderBy('name')
            ->get();

        return response()->json($contacts);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
        ]);

        $contact = $request->user()->contacts()->create($data);

        return response()->json($contact, 201);
    }

    public function show(Request $request, Contact $contact): JsonResponse
    {
        abort_if($contact->user_id !== $request->user()->id, 403);

        return response()->json($contact);
    }

    public function update(Request $request, Contact $contact): JsonResponse
    {
        abort_if($contact->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
        ]);

        $contact->update($data);

        return response()->json($contact);
    }

    public function destroy(Request $request, Contact $contact): JsonResponse
    {
        abort_if($contact->user_id !== $request->user()->id, 403);

        $contact->delete();

        return response()->json(null, 204);
    }
}
