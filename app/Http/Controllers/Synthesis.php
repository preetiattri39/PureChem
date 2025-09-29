<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;
use App\Models\CustomProduct;
use App\Models\CustomSynthesisSubmission;
use App\Models\Rfq;
use Illuminate\Support\Facades\Auth;

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
        if (!Auth::check()) {
            return response()->json([
                'status' => 'unauthenticated',
                'message' => 'Please login before submitting the custom synthesis form. If not registered yet, go to the register page and signup. You will be redirected in 5 seconds...',
                'login_url' => route('login'),
                'register_url' => route('register'),
            ], 401);
        }

        try {
            $validator = Validator::make($request->all(), [
                'molecule_name' => 'required|string|max:255',
                'purity' => 'required|string|max:100',
                'molecular_formula' => 'required|string|max:100',
                'quantity' => 'required|integer',
                'unit' => 'required|in:mg,g,kg',
                'special_instructions' => 'nullable|string|max:1000',
                'structure_required' => 'required|in:yes,no',
                'upload_method' => 'nullable|in:upload,draw',
                'structure_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'canvas_data' => 'nullable|string',
                'usage' => 'required|in:university_lab_research,testing_standards,product_development,regulatory_use,resale_distribution,other',
                'usage_other' => 'nullable|string|required_if:usage,other',
                'terms_accepted' => 'required|accepted',
                'g-recaptcha-response' => 'required|captcha'
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

            $customProduct = CustomProduct::create([
                'molecule_name' => $formData['molecule_name'],
                'purity' => $formData['purity'],
                'molecular_formula' => $formData['molecular_formula'],
                'unit' => $formData['unit'],
                'quantity' => $formData['quantity'],
                'structure_uploaded' => $formData['structure_required'] === 'yes',
                'structure_file' => $structureImagePath,
                'upload_method' => $formData['upload_method'] ?? null,
            ]);

            $rfq = Rfq::create([
                'user_id' => Auth::id(),
                'status' => 'open',
                'type' => 'custom',
            ]);

            $submission = CustomSynthesisSubmission::create([
                'user_id' => Auth::id(),
                'rfq_id' => $rfq->id,
                'custom_product_id' => $customProduct->id,
                'company' => $formData['company'] ?? null,
                'usage' => $formData['usage'],
                'usage_other' => $formData['usage'] === 'other' ? $formData['usage_other'] : null,
                'address' => $formData['address'] ?? null,
                'special_instructions' => $formData['special_instructions'] ?? null,
                'terms_accepted' => $formData['terms_accepted'] === 'on' ? 1 : 0,
            ]);

            $this->sendAdminEmail($formData, $structureImagePath);

            return response()->json([
                'success' => true,
                'route' => route('filament.user.pages.thread',['rfqId'=> $rfq->id]),
                'message' => 'Your synthesis request has been submitted. A chat with the admin has been opened. You will be redirected in 5 seconds.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Custom Synthesis Form Error: ' . $e->getMessage());
             return response()->json([
                'success' => false,
                // 'message' => $e->getMessage(),
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
        $adminEmail = replace_shortcodes('[email-form-submission]');

        $mailData = [
            'molecule_name' => $formData['molecule_name'],
            'purity' => $formData['purity'],
            'molecular_formula' => $formData['molecular_formula'],
            'quantity' => $formData['quantity'],
            'special_instructions' => $formData['special_instructions'] ?? 'None',
            'structure_image_path' => $structureImagePath,
            'structure_image_url' => $structureImagePath ? Storage::url($structureImagePath) : null,
            'submission_date' => now()->format('Y-m-d H:i:s'),
        ];

        Mail::to($adminEmail)->send(new FormSubmissionMail($mailData, 'mails.synthesis','RFQ for Custom Molecule'));
    }

}
