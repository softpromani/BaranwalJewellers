@extends('admin.includes.layout')
@section('title', 'Category')
@section('content')

    <div class="pagetitle">
        <h1>Category Setup</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Category</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Category</h5>

            <!-- No Labels Form -->
            <form class="row g-3"
                action="{{ isset($editCategory) ? route('admin.category.update', $editCategory->id) : route('admin.category.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($editCategory))
                    @method('patch')
                @endif
                <div class="col-md-6">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="name" placeholder="Category Name"
                        value="{{ isset($editCategory) ? $editCategory->name : '' }}">
                </div>

                <div class="col-md-6">
                    <label for="sequence" class="form-label">Sequence</label>
                    <select id="sequence" name="sequence" class="form-select">
                        <option value="" selected>Select Sequence</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ isset($editCategory) && $editCategory->sequence == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="filePic">
                </div>
                <div class="signatureImageShow">
                    @if (isset($editCategory->image))
                        <img id="output" src="{{ asset('storage/' . $editCategory->image) }}" class=""
                            alt=" Image" style="max-height: 161px; max-width:166px; border-radius:5px;">
                    @endif
                </div>
                {{-- @isset($editCategory)
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $editCategory->image) }}" width="100" />
                    </div>
                @endisset --}}

                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Category List</h5>

            <div class="table-responsive">
                <!-- Table with hoverable rows -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $start = ($categories->currentPage() - 1) * $categories->perPage() + 1;
                        @endphp
                        @forelse ($categories as $index => $category)
                            <tr>
                                <th scope="row">{{ $start + $index }}</th>
                                <td>
                                    <img src="{{ asset('storage/' . $category->image) }}" width="80" />
                                </td>
                                <td>{{ $category->name ?? 'N/A' }}</td>
                                <td>{{ $category->sequence ?? 'N/A' }}</td>
                                <td>
                                    @if ($category->status == 1)
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>
                                    @else
                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                            Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('admin.category.edit', $category->id) }}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>

                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
            {{ $categories->links('pagination::bootstrap-4') }}

        </div>
    </div>
@endsection
@section('script-area')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#filePic').change(function() {
                readAndDisplayImage(this, '#output');
            });
        });
    </script>
@endsection
