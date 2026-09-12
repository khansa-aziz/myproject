
@extends('admin.layout.layout')

@section('content')

<!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Create Admin</h1>
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

                        <li class="breadcrumb-item active" aria-current="page">
                            Create
                        </li>

                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>
<!--end::App Content Header-->


<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title mb-0">
                            Admin Information
                        </h3>
                    </div>

                    <form
                        action="{{ route('admins.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

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
                                    placeholder="Enter admin name"
                                    value="{{ old('name') }}"
                                    required>
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
                                    placeholder="Enter admin email"
                                    value="{{ old('email') }}"
                                    required>
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
                                    placeholder="Enter password"
                                    required>
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
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- Admin Image --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">
                                    Admin Image
                                </label>

                                <input
                                    type="file"
                                    name="image"
                                    id="image"
                                    class="form-control"
                                    accept="image/jpeg,image/png,image/webp">

                                @error('image')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="text-muted">
                                    Allowed: JPG, JPEG, PNG, WEBP. Maximum size: 2MB.
                                </small>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('admins.index') }}"
                                class="btn btn-secondary">
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-check-lg me-1"></i>
                                Create Admin

                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
</div>
<!--end::App Content-->

@endsection

