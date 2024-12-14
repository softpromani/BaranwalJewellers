@extends('admin.includes.layout')
@section('title', 'Product')
@section('content')

    <div class="pagetitle">
        <h1>Product List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Product List</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Product List</h5>
                <a class="btn btn-primary" href="{{ route('admin.product.create') }}">Add Product</a>
            </div>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Thumbnail Image</th>
                        <th scope="col">Images</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $product->name ?? 'N/A' }}</td>
                            <td>{{ $product->description ?? 'N/A' }}</td>
                            <td><img src="{{ asset('storage/' . $product->thumbnail_image) }}" alt=""
                                    width="100"></td>
                            <td><img src="{{ asset('storage/' . $product->images) }}" alt="" width="100"></td>
                            <td>
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Completed</span>
                                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Pending</span>
                            </td>
                            <td>
                                <a class="btn btn-warning"><i class="bi bi-eye"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning"><i
                                        class="bi bi-pencil-square">
                                    </i></a>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>

                                </form>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center"> No data found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection