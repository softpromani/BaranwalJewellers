@extends('admin.includes.layout')
@section('title', 'Banner')
@section('content')

    <div class="pagetitle">
        <h1>Banner Setup</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Banner</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Banner</h5>

            <!-- No Labels Form -->
            <form class="row g-3"
                action="{{ isset($editbanner) ? route('admin.banner.update', $editbanner->id) : route('admin.banner.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($editbanner)
                    @method('PATCH')
                @endisset
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Banner URL</label>
                    <input type="text" class="form-control" name="url" placeholder="Banner URL">
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Banner Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Banner List </h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Banner Image</th>
                        <th scope="col">Banner URL</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><img src="{{ asset('storage/' . $banner->image) }}" alt="" width="100"></td>
                            <td>{{ $banner->path ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>
                                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Inactive</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-warning"><i
                                        class="bi bi-pencil-square">
                                    </i></a>
                                <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST">
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
