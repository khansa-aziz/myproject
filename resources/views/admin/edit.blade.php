
@extends('admin.layout.layout')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Edit Admin</h1>
            </div>

            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.index') }}">Admins</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit Admin
                        </li>

                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    Edit Admin
                </h3>
            </div>

            <div class="card-body">

                <form
                    action="{{ route('admins.update', $admin->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ old('name', $admin->name) }}"
                            required>

                        @error('name')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="{{ old('email', $admin->email) }}"
                            required>

                        @error('email')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Leave blank to keep current password">

                        @error('password')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="mb-3">
                        <label for="role_id" class="form-label">
                            Role
                        </label>

                        <select
                            name="role_id"
                            id="role_id"
                            class="form-select"
                            required>

                            <option value="">Select Role</option>

                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }}"
                                    {{ old('role_id', $admin->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('role_id')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Current Image --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Current Image
                        </label>

                        <div>
                            @if($admin->image)

                                <img
                                    src="{{ asset('storage/' . $admin->image) }}"
                                    alt="{{ $admin->name }}"
                                    width="100"
                                    height="100"
                                    style="object-fit: cover; border-radius: 50%;">

                            @else

                                <span class="text-muted">
                                    No Image
                                </span>

                            @endif
                        </div>

                    </div>

                    {{-- New Image --}}
                    <div class="mb-3">

                        <label for="image" class="form-label">
                            Change Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp">

                        <small class="text-muted">
                            Allowed: JPG, JPEG, PNG, WEBP. Maximum size: 2MB.
                        </small>

                        @error('image')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary">
                            Update Admin
                        </button>

                        <a
                            href="{{ route('admins.index') }}"
                            class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection

