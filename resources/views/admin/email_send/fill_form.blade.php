@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Fill in the Data for the Template: {{ $template->name }}</h1>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Template Preview</h3>
    </div>
    <div class="h-separator"></div>

    <div class="flex flex-col gap-2 mb-4">
        <div>
            <label>Subject:</label>
            <label class="label-user">{{ $template->subject }}</label>
        </div>

        <div>
            <label>Body Template</label>
            <pre class="bg-gray-100 p-4 whitespace-pre-wrap mt-1">{{ $template->body }}</pre>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="error-message mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.messages.templates.send') }}" method="POST">
    @csrf

    <input type="hidden" name="template_id" value="{{ $template->id }}">
    <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">

    <div class="container-content">
        <div class="container-action">
            <h3>Dynamic Fields</h3>
        </div>

        <div class="h-separator"></div>

        @forelse ($fields as $field)
        <div class="mb-2">
            <label class="label-field req">{{ ucwords(str_replace('_', ' ', $field)) }}</label><br>
            <input class="field"
                type="text"
                name="fields[{{ $field }}]"
                value="{{ old('fields.'.$field) }}"
                required>
        </div>
        @empty
        <p class="text-center my-6 italic">There are no dynamic fields in this template.</p>
        @endforelse
    </div>

    <div class="container-content">
        <div class="container-action">
            <h3>Delivery Settings</h3>
        </div>

        <div class="h-separator"></div>

        <div class="mb-2">
            <label class="label-field">Schedule Delivery</label><br>
            <input class="field" type="datetime-local" name="sent" value="{{ old('sent') }}">
        </div>

        <div class="mb-2">
            <label class="label-field req">Delivery Frequency</label><br>
            <select class="field" name="recurrence">
                <option value="">One-time Only</option>
                <option value="hourly" {{ old('recurrence')=='hourly' ? 'selected':'' }}>Hourly</option>
                <option value="daily" {{ old('recurrence')=='daily' ? 'selected':'' }}>Daily</option>
                <option value="weekly" {{ old('recurrence')=='weekly' ? 'selected':'' }}>Weekly</option>
                <option value="monthly" {{ old('recurrence')=='monthly' ? 'selected':'' }}>Monthly</option>
            </select>
        </div>
    </div>

    <div class="dashboard__create">
        <button type="submit" class="btn btn-primary cursor-pointer">Send</button>
        <a class="btn btn-secondary" href="{{ route('admin.messages.templates.create') }}">Cancel</a>
    </div>

</form>
@endsection