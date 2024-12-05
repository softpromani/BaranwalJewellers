@extends('admin.includes.layout')
@section('title','Product')
@section('content')

<div class="pagetitle">
    <h1>Add Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Add Product</li>
      </ol>
    </nav>
</div>
<!-- End Page Title -->

<div class="card">
    <div class="card-body">
      <h5 class="card-title">Add Product</h5>

      <!-- No Labels Form -->
      <form class="row g-3">
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Product name">
        </div>

        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Thumbnail Image</label>
            <input type="file" class="form-control" name="thumbnail_image">
          </div>
        <div class="text-left">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form>

    </div>
  </div>


@endsection
