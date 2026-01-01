<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Mail\SubscriberWelcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email:rfc,dns', 'max:255'],
        ]);

        // If user requested unsubscribe from the same form
        if ($request->boolean('unsubscribe')) {
            $subscriber = Subscriber::where('email', $data['email'])->first();
            if (! $subscriber || ! $subscriber->is_active) {
                $msg = 'No existe una suscripción activa para ese correo.';
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json(['message' => $msg], 200);
                }
                return back()->with('success', $msg);
            }
            $subscriber->update(['is_active' => false]);
            $msg = 'Suscripción cancelada con éxito.';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => $msg], 200);
            }
            return back()->with('success', $msg);
        }

        $existing = Subscriber::where('email', $data['email'])->first();

        if ($existing) {
            if ($existing->is_active) {
                $msg = 'Este correo ya está suscrito.';
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json(['message' => $msg], 200);
                }
                return back()->with('success', $msg);
            }

            // Reactivar suscripción inactiva
            $existing->update(['is_active' => true]);
            $subscriber = $existing;
            $message = 'Suscripción reactivada. Gracias.';
        } else {
            $subscriber = Subscriber::create([
                'email' => $data['email'],
                'is_active' => true,
            ]);
            $message = 'Gracias — ahora estás suscrito al canal de noticias.';
        }

        try {
            Mail::to($subscriber->email)->send(new SubscriberWelcome($subscriber));
        } catch (\Throwable $e) {
            // Don't fail the request if mail delivery fails; just continue
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => $message], 200);
        }

        return back()->with('success', $message);
    }

    public function unsubscribe(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        $email = $request->query('email');

        $subscriber = Subscriber::where('email', $email)->first();

        if (! $subscriber) {
            return redirect('/')->with('success', 'Suscripción no encontrada.');
        }

        $subscriber->update(['is_active' => false]);

        return view('subscribers.unsubscribed');
    }

    public function check(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $subscriber = Subscriber::where('email', $data['email'])->first();

        return response()->json([
            'exists' => (bool) $subscriber,
            'is_active' => $subscriber ? (bool) $subscriber->is_active : false,
        ]);
    }
}
