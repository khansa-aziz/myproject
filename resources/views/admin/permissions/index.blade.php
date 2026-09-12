@extends('admin.layout.layout')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Admin Permissions</h3>
                </div>

                <div class="card-body">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- Permissions Form --}}
                    <form
                        method="POST"
                        action="{{ route('permissions.save') }}"
                        id="permissionForm">

                        @csrf


                        {{-- Select Admin --}}
                        <div class="mb-4">

                            <label for="admin_id" class="form-label">
                                Select Admin
                            </label>

                            <select
                                name="admin_id"
                                id="admin_id"
                                class="form-select"
                                required>

                                <option value="">
                                    -- Select Admin --
                                </option>

                                @foreach ($admins as $admin)

                                    <option value="{{ $admin->id }}">
                                        {{ $admin->name }}

                                        @if ($admin->role)
                                            - {{ $admin->role->name }}
                                        @endif
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Permissions Table --}}
                        <div class="table-responsive">

                            <table class="table table-bordered align-middle">

                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>None</th>
                                        <th>Read</th>
                                        <th>Read & Write</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    {{-- Dashboard --}}
                                    <tr>
                                        <td>Dashboard</td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[dashboard]"
                                                value="none"
                                                checked>
                                        </td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[dashboard]"
                                                value="read">
                                        </td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[dashboard]"
                                                value="read_write">
                                        </td>
                                    </tr>


                                    {{-- Admins --}}
                                    <tr>
                                        <td>Admins</td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[admins]"
                                                value="none"
                                                checked>
                                        </td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[admins]"
                                                value="read">
                                        </td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[admins]"
                                                value="read_write">
                                        </td>
                                    </tr>


                                    {{-- Roles --}}
                                    <tr>
                                        <td>Roles</td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[roles]"
                                                value="none"
                                                checked>
                                        </td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[roles]"
                                                value="read">
                                        </td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[roles]"
                                                value="read_write">
                                        </td>
                                    </tr>


                                    {{-- Permissions --}}
                                    <tr>
                                        <td>Permissions</td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[permissions]"
                                                value="none"
                                                checked>
                                        </td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[permissions]"
                                                value="read">
                                        </td>

                                        <td>
                                            <input
                                                type="radio"
                                                name="permissions[permissions]"
                                                value="read_write">
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>


                        {{-- Save Button --}}
                        <div class="mt-3">

                            <button
                                type="submit"
                                class="btn btn-primary"
                                id="savePermissions">
                                Save Permissions
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const adminSelect = document.getElementById('admin_id');

    if (!adminSelect) {
        return;
    }

    adminSelect.addEventListener('change', function () {

        const adminId = this.value;

        if (!adminId) {
            return;
        }

        fetch(`/admin/permissions/${adminId}/get`)
            .then(response => {

                if (!response.ok) {
                    throw new Error('Failed to load permissions.');
                }

                return response.json();
            })

            .then(permissions => {

                // Reset all permissions to "none"
                document.querySelectorAll(
                    'input[type="radio"][value="none"]'
                ).forEach(radio => {
                    radio.checked = true;
                });


                // Apply saved permissions
                Object.entries(permissions).forEach(
                    ([module, permission]) => {

                        const radio = document.querySelector(
                            `input[name="permissions[${module}]"][value="${permission}"]`
                        );

                        if (radio) {
                            radio.checked = true;
                        }

                    }
                );

            })

            .catch(error => {
                console.error('Permission loading error:', error);
            });

    });

});
</script>

@endpush