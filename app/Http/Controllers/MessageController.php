<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::latest()->paginate(5);
        return view('', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => ['required'],
            'receiver_id' => ['required', 'unique'],
            'subject' => ['required', 'min:5', 'max:50'],
            'body' => ['required', 'min:10', 'max:255'],
            'sent' => ['required'],
            'is_read' => ['required'],
        ]);

        Message::create($validated);

        return redirect('')->with('success', 'Message berhasil di buat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::find($id);
        return view('', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $message = Message::find($id);
        return view('', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = Message::findOrFail($id);

        $validated = $request->validate([
            'sender_id' => ['required'],
            'receiver_id' => ['required', 'unique'],
            'subject' => ['required', 'min:5', 'max:50'],
            'body' => ['required', 'min:10', 'max:255'],
            'sent' => ['required'],
            'is_read' => ['required'],
        ]);

        $message->update($validated);

        return redirect('')->with('success', 'Message berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect('')->with('success', 'Message berhasil di hapus');
    }
}
