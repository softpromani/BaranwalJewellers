@extends('admin.includes.layout')
@section('title', 'Abandoned Cart')
@section('content')

    <div class="pagetitle">
        <h1>Abandoned Cart</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Abandoned Cart</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Abandoned Cart </h5>
            <div class="table-responsive">
                <!-- Table with hoverable rows -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Product Count</th>
                            <th scope="col">View Cart</th>
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
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $user->carts->count() }}</span></span>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('admin.cartDetail', $user->id) }}"><i
                                            class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No data found!</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            {{ $users->links('pagination::bootstrap-4') }}

        </div>
    </div>
@endsection
