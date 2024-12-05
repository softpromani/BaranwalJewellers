@extends('admin.includes.layout')
@section('title','Banner')
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
      <form class="row g-3">
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
          <tr>
            <th scope="row">1</th>
            <td>Brandon Jacob</td>
            <td>Designer</td>
            <td>
                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>
                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Inactive</span>
            </td>
            <td>
                <a class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                <a class="btn btn-danger"><i class="bi bi-trash"></i></a>
            </td>
          </tr>

        </tbody>
      </table>

    </div>
  </div>
@endsection
