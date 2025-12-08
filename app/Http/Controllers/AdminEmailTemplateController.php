<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class AdminEmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort;
        $dir = $request->dir;

        $query = EmailTemplate::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('subject', 'LIKE', "%{$search}%");
            });
        }

        if ($sort && $dir) {
            if (in_array($sort, ['name', 'subject', 'created_at', 'id'])) {
                $query->orderBy($sort, $dir);
            }
        } else {
            $query->latest();
        }

        $templates = $query->paginate(10)->appends(request()->query());
        return view('admin.email_templates.index', compact('templates', 'search'));
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
            'body' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (substr_count($value, '{{') !== substr_count($value, '}}')) {
                        return $fail("Format variable pada template tidak seimbang ({{ ... }}).");
                    }

                    preg_match_all('/{{(.*?)}}/', $value, $matches);

                    foreach ($matches[1] as $inside) {
                        $trim = trim($inside);

                        if ($trim === '') {
                            return $fail("Template variable tidak boleh kosong seperti {{ }}.");
                        }

                        if (!preg_match('/^[A-Za-z0-9_.-]+$/', $trim)) {
                            return $fail("Nama variable dalam template tidak valid: {{$trim}}");
                        }
                    }
                }
            ]
        ]);


        EmailTemplate::create($validated);

        swal('success', 'Template berhasil dibuat!', 'Success');
        return redirect()->route('admin.email-templates.index');
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

        swal('success', 'Template berhasil diperbarui!', 'Success');
        return redirect()->route('admin.email-templates.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
        swal('success', 'Template berhasil dihapus!', 'Success');
        return redirect()->route('admin.email-templates.index');
    }
}
