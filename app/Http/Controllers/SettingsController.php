<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('settings.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_message' => 'nullable|string|max:1000',
            'whatsapp_greeting' => 'nullable|string|max:500',
        ]);

        Auth::user()->update([
            'whatsapp_message' => $request->input('whatsapp_message'),
            'whatsapp_greeting' => $request->input('whatsapp_greeting'),
        ]);

        return redirect()->route('settings.edit')->with('success', 'Configurações do WhatsApp atualizadas com sucesso!');
    }
}
