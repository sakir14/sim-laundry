<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Throwable;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        if (app()->environment('production') && config('mail.default') === 'log') {
            return back()->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email reset password belum dikonfigurasi. Atur layanan email API seperti Resend di Railway terlebih dahulu.',
                ]);
        }

        if (app()->environment('production') && config('mail.default') === 'resend' && blank(config('services.resend.key'))) {
            return back()->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email reset password belum dikonfigurasi. Atur RESEND_API_KEY di Railway terlebih dahulu.',
                ]);
        }

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email reset password belum bisa dikirim. Periksa API key dan domain pengirim di layanan email.',
                ]);
        }

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
