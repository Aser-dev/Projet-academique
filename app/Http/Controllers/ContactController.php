<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact');
    }

    public function store(ContactMessageRequest $request): RedirectResponse
    {
        // Anti-spam honeypot: si rempli, on bloque.
        if ($request->filled('hp_website')) {
            abort(403);
        }

        ContactMessage::create($request->validated());

        return back()->with('success', 'Votre message a été envoyé. Merci !');
    }
}

