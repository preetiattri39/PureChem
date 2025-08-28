<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;
use App\Models\ContactSubmission;

class Contact extends Controller
{
     public function index()
    {
        $contactContentFilePath = storage_path('app/private/content/contact.php');
        $content = file_exists($contactContentFilePath) ? include $contactContentFilePath : [];

        return view('pages.contact', compact('content'));
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
            Mail::to(replace_shortcodes('[email-form-submission-test]'))->send(new FormSubmissionMail($validated, 'mails.contact'));
            $submission->update(['is_sent' => true]);
            \Log::info('Contact Form Submitted and mail sent successfully', $validated);
        } catch (\Exception $e) {
            \Log::error('Contact email failed: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you! Our team will be in touch with you shortly.');
    }
}
