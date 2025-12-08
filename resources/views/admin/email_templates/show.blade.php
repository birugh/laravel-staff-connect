@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h2>Email Template Detail</h2>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Template Info</h3>
    </div>
    <div class="h-separator"></div>

    <div class="flex justify-between items-start mb-4">
        <div class="flex flex-col">
            <label>Name</label>
            <label class="label-user">{{ $template->name }}</label>
        </div>

        <div class="flex flex-col">
            <label>Subject</label>
            <label class="label-user">{{ $template->subject }}</label>
        </div>
    </div>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Body</h3>
    </div>
    <div class="h-separator"></div>

    <pre class="mt-2 bg-gray-100 p-4 whitespace-pre-wrap">{{ $template->body }}</pre>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Dynamic Fields</h3>
    </div>
    <div class="h-separator"></div>

    @if (count($fields))
    <ul class="list-disc ml-6">
        @foreach ($fields as $field)
        <li>{{ $field }}</li>
        @endforeach
    </ul>
    @else
    <p class="text-center my-6 italic">No dynamic fields found.</p>
    @endif
</div>

<div class="dashboard__create">
    <a class="btn btn-primary" href="{{ route('admin.email-templates.edit', $template) }}">Edit</a>
    <a class="btn btn-secondary" href="{{ route('admin.email-templates.index') }}">Cancel</a>
</div>

@endsection