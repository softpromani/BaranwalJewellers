@extends('admin.includes.layout')
@section('title', 'Customer List')
@section('content')

    <div class="pagetitle">
        <h1>Customer List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Customer List</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Filter Customers</h5>
            <form action="{{ route('admin.customerList') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone" value="{{ request('phone') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Filter Card -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Customer List</h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Registered at</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $start = ($users->currentPage() - 1) * $users->perPage() + 1;
                    @endphp
                    @forelse ($users as $index => $user)
                        <tr>
                            <th scope="row">{{ $start + $index }}</th>
                            <td>{{ isset($user->name) && $user->name != Null ? $user->name : 'BAM User' }}</td>
                            <td>+91 {{ $user->phone }}</td>
                            <td>{{ $user->address ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M,Y') }}</td>
                            <td>
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No data found!</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            {{ $users->links('pagination::bootstrap-4') }}

        </div>
    </div>
@endsection
