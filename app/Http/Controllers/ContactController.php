<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;
use App\Models\ContactSubmission;

class ContactController extends Controller
{
     public function index()
    {
        return view('pages.contact');
    }

    public function submitForm(Request $request)
    {
        if ($request->filled('website')) {
            abort(403, 'Spam detected');
        }

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'instructions' => 'nullable|string',
            'g-recaptcha-response' => 'required|captcha'
        ], [
            'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha verification failed. Please try again.'
        ]);

        $submission = ContactSubmission::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'] ?? null,
            'message' => $validated['instructions'],
            'user_id' => auth()->id(),
            'is_sent' => false,
        ]);

        try {
            Mail::to(replace_shortcodes('[email-form-submission]'))->send(new FormSubmissionMail($validated, 'mails.contact','Message from Contact Form'));
            $submission->update(['is_sent' => true]);
            \Log::info('Contact Form Submitted and mail sent successfully', $validated);
        } catch (\Exception $e) {
            \Log::error('Contact email failed: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you! Our team will be in touch with you shortly.');
    }
}
