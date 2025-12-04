@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Daftar Email Template</h1>

    @if (session('success'))
    <div style="color: green">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.email-templates.create') }}">+ Buat Template Baru</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 16px; width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Subject</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($templates as $template)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $template->name }}</td>
                <td>{{ $template->subject }}</td>
                <td>{{ $template->created_at }}</td>
                <td>
                    <a href="{{ route('admin.email-templates.show', $template) }}">Lihat</a> |
                    <a href="{{ route('admin.email-templates.edit', $template) }}">Edit</a> |
                    <form action="{{ route('admin.email-templates.destroy', $template) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus template ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada template.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 16px;">
        {{ $templates->links() }}
    </div>
    <a href="{{ route('admin.email-send.create') }}">Kirim Email</a>
</div>
@endsection