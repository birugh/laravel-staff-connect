@extends('layouts.user')

@section('content')
<h1>Add New User</h1>

<form method="POST" action="{{ route('admin.user-profile.store') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label>User</label><br>
        <select name="user_id">
            <option value="" hidden>PILIH USER</option>
            @foreach ($users as $u)
            <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
        @error('user_id')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>NIK</label><br>
        <input type="number" name="nik" value="{{ old('nik') }}">
        @error('nik')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Phone Number</label><br>
        <input type="text" name="phone_number" value="{{ old('phone_number') }}">
        @error('phone_number')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Address</label><br>
        <textarea name="address">{{ old('address') }}</textarea>
        @error('address')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label>Date of Birth</label><br>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
        @error('date_of_birth')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>


    <div>
        <label>Foto Profil</label><br>
        <input type="file" name="profile_path">
        @error('profile_path')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Add</button>
</form>
@endsection