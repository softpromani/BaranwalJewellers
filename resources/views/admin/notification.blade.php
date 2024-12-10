@extends('admin.includes.layout')
@section('title', 'Notification')
@section('content')

    <div class="pagetitle">
        <h1>Notification</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Notification</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Notification</h5>

            <!-- No Labels Form -->
            <form class="row g-3"
                action="{{ isset($editnotification) ? route('admin.notification.update', $editnotification->id) : route('admin.notification.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($editnotification)
                    @method('PATCH')
                @endisset
                <div class="col-md-8">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>

                <div class="col-md-4">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>

                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Notification List </h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifications as $notification)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><img src="{{ asset('storage/' . $notification->image) }}" alt="" width="100">
                            </td>
                            <td>{{ $notification->title ?? 'N/A' }}</td>
                            <td>{{ $notification->description ?? 'N/A' }}</td>

                            <td>
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>
                                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Inactive</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.notification.edit', $notification->id) }}"
                                    class="btn btn-warning"><i class="bi bi-pencil-square">
                                    </i></a>
                                <form action="{{ route('admin.notification.destroy', $notification->id) }}" method="POST">
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
