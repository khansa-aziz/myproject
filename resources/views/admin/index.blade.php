
@extends('admin.layout.layout')

@section('content')

<!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Admins</h1>
            </div>

            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            Admins
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

        <!--begin::Card-->
        <div class="card">

            <!--begin::Card Header-->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">

                    <h3 class="card-title mb-0">
                        Admin List
                    </h3>

                    <a href="{{ route('admins.create') }}"
                        class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>
                        Add Admin
                    </a>

                </div>
            </div>
            <!--end::Card Header-->


            <!--begin::Card Body-->
            <div class="card-body p-0">

                @if(session('success'))
                    <div class="alert alert-success m-3">
                        {{ session('success') }}
                    </div>
                @endif


                <div class="table-responsive">

                    <table id="adminTable"
                        class="table table-hover table-striped mb-0">

                        <thead>
                            <tr>
                                <th width="80">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th width="180">Actions</th>
                            </tr>
                        </thead>


                        <tbody>

                            @forelse($admins as $admin)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    <td>
                                        {{ $admin->name }}
                                    </td>


                                    <td>
                                        {{ $admin->email }}
                                    </td>


                                    <td>
                                        {{ $admin->created_at->format('d M Y') }}
                                    </td>


                                    <td>

                                        <div class="d-flex gap-2">

                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.edit', $admin->id) }}"
                                                class="btn btn-warning btn-sm d-flex align-items-center justify-content-center"
                                                style="width: 75px;">

                                                <i class="bi bi-pencil me-1"></i>
                                                Edit

                                            </a>


                                            <!-- Delete Button -->
                                            <form action="{{ route('admins.destroy', $admin->id) }}"
                                                method="POST"
                                                class="m-0"
                                                onsubmit="return confirm('Are you sure you want to delete this admin?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                                    style="width: 75px;">

                                                    <i class="bi bi-trash me-1"></i>
                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center py-4">

                                        <div class="text-muted">

                                            <i class="bi bi-people fs-3 d-block mb-2"></i>

                                            No admins found.

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
            <!--end::Card Body-->

        </div>
        <!--end::Card-->

    </div>
</div>
<!--end::App Content-->


@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        new DataTable('#adminTable');
    });
</script>
