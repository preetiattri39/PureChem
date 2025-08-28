<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;

class Synthesis extends Controller
{
    public function index()
    {
        $synthesisContentFilePath = storage_path('app/private/content/synthesis.php');
        $content = file_exists($synthesisContentFilePath) ? include $synthesisContentFilePath : [];

        return view('pages.customSynthesis', $content);
    }

        public function submitForm(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'molecule_name' => 'required|string|max:255',
                'purity' => 'required|string|max:100',
                'molecular_weight' => 'required|string|max:100',
                'quantity' => 'required|string',
                'unit' => 'required|string',
                'special_instructions' => 'nullable|string|max:1000',
                'structure_required' => 'required|in:yes,no',
                'upload_method' => 'nullable|in:upload,draw',
                'structure_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'canvas_data' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $formData = $request->all();
            $structureImagePath = null;

            if ($formData['structure_required'] === 'yes') {
                if ($request->hasFile('structure_file')) {
                    $structureImagePath = $this->handleUploadedImage($request->file('structure_file'));
                } elseif ($request->filled('canvas_data')) {
                    $structureImagePath = $this->handleCanvasImage($request->canvas_data);
                }
            }

            $this->sendAdminEmail($formData, $structureImagePath);

            return response()->json([
                'success' => true,
                'message' => 'Your synthesis request has been submitted successfully. We will contact you soon with a quote.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Custom Synthesis Form Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    private function handleUploadedImage($file)
    {
        $filename = 'synthesis_' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('synthesis/structures', $filename, 'public');
        
        return $path;
    }

    private function handleCanvasImage($canvasData)
    {
        $imageData = str_replace('data:image/png;base64,', '', $canvasData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedImage = base64_decode($imageData);

        $filename = 'synthesis_canvas_' . Str::random(10) . '_' . time() . '.png';
        $path = 'synthesis/structures/' . $filename;
        
        Storage::disk('public')->put($path, $decodedImage);
        
        return $path;
    }

    private function sendAdminEmail($formData, $structureImagePath)
    {
        $adminEmail = config('mail.admin_email', 'admin@swizchem.com');
        
        $mailData = [
            'molecule_name' => $formData['molecule_name'],
            'purity' => $formData['purity'],
            'molecular_weight' => $formData['molecular_weight'],
            'quantity' => $formData['quantity'],
            'special_instructions' => $formData['special_instructions'] ?? 'None',
            'structure_image_path' => $structureImagePath,
            'structure_image_url' => $structureImagePath ? Storage::url($structureImagePath) : null,
            'submission_date' => now()->format('Y-m-d H:i:s')
        ];

        Mail::to(replace_shortcodes('[email-form-submission-test]'))->send(new FormSubmissionMail($mailData, 'mails.synthesis'));
        \Log::info('Synthesis form Submitted and mail sent successfully', $mailData);
    }
}
