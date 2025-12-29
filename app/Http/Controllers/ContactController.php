<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string',
        ]);

        Mail::to('allanchopen@gmail.com')->send(
            new ContactMail($data)
        );

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Mensaje enviado correctamente. ¡Gracias por contactarnos!'
            ]);
        }

        return redirect()->back()->with('success', 'Mensaje enviado correctamente. ¡Gracias por contactarnos!');
    }
}
