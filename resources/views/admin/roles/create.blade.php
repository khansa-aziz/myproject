@extends('admin.layout.layout')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Add Role</h1>
            </div>

            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('roles.index') }}">Roles</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Add Role
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
                    Create Role
                </h3>
            </div>

            <div class="card-body">

                <form action="{{ route('roles.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label for="name" class="form-label">
                            Role Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Enter role name"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            Save Role
                        </button>

                        <a href="{{ route('roles.index') }}"
                            class="btn btn-secondary">

                            <i class="bi bi-arrow-left me-1"></i>
                            Back

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection