@extends('admin.includes.layout')
@section('title','Abandoned Cart')
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
          <tr>
            <th scope="row">1</th>
            <td>Brandon Jacob</td>
            <td>Designer</td>
            <td>1</td>
            <td>
                <a class="btn btn-warning" href="{{ route('admin.cartDetail', 1) }}"><i class="bi bi-eye"></i></a>
            </td>
          </tr>

        </tbody>
      </table>

    </div>
  </div>
@endsection
