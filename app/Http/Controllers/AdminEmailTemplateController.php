<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class AdminEmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = EmailTemplate::latest()->paginate(5);
        return view('admin.email_templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.email_templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'subject' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);

        $template = EmailTemplate::create($validated);

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Template berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailTemplate $emailTemplate)
    {
        preg_match_all('/{{(.*?)}}/', $emailTemplate->body, $matches);
        $fields = $matches[1];
        return view('admin.email_templates.show', [
            'template' => $emailTemplate,
            'fields' => $fields
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        return view('admin.email_templates.edit', compact('emailTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'subject' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);

        $emailTemplate->update($validated);

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Template berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Template berhasil dihapus!');
    }
}
