@extends('admin.includes.layout')
@section('title','Product')
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
            <th scope="col">Order ID</th>
            <th scope="col">Order Date</th>
            <th scope="col">Customer Info</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Order Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>ORDER-123</td>
            <td>24 Nov, 2024</td>
            <td>Customer name<br/><span class="badge bg-info">12345678</span></td>
            <td>₹544</td>
            <td>
                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Completed</span>
                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Pending</span>
            </td>
            <td>
                <a class="btn btn-warning"><i class="bi bi-eye"></i></a>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
</div>
@endsection
