<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('upload-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file', // Validate the uploaded file
        ]);
    
        $file = $request->file('file');
        $uuid = Str::uuid();
        $filename = $uuid . '.' . $file->getClientOriginalExtension();
    
        // Move file to the public/uploads/ directory
        $file->move(public_path('uploads'), $filename);
    
        // Save file details in the database
        $uploadedFile = UploadedFile::create([
            'original_name' => $file->getClientOriginalName(),
            'filename' => $filename,
            'uuid' => $uuid,
        ]);
    
        return back()->with([
            'success' => 'File uploaded successfully!',
            'preview_link' => route('preview', $uuid) // Change to preview route
        ]);
    }

    public function preview($uuid)
    {
        $file = UploadedFile::where('uuid', $uuid)->firstOrFail();
        $path = public_path('uploads/' . $file->filename); // Updated path
    
        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }
    
        return view('preview', [
            'file' => $file,
            'mimeType' => mime_content_type($path)
        ]);
    }
    

    public function download($uuid)
    {
        $file = UploadedFile::where('uuid', $uuid)->firstOrFail();
        $path = public_path('uploads/' . $file->filename); // Updated path
    
        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }
    
        return response()->download($path, $file->original_name);
    }

}