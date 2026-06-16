<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
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

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'contact_created',
            'description' => "Created contact: {$contact->name}",
            'ip_address' => $request->ip(),
        ]);

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

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'contact_updated',
            'description' => "Updated contact: {$contact->name}",
            'ip_address' => $request->ip(),
        ]);

        return response()->json($contact);
    }

    public function destroy(Request $request, Contact $contact): JsonResponse
    {
        abort_if($contact->user_id !== $request->user()->id, 403);

        $name = $contact->name;
        $contact->delete();

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'contact_deleted',
            'description' => "Deleted contact: {$name}",
            'ip_address' => $request->ip(),
        ]);

        return response()->json(null, 204);
    }
}
