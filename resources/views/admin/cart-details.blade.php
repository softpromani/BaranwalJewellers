@extends('admin.includes.layout')
@section('title','Cart Details')
@section('content')

<div class="pagetitle">
    <h1>Cart Details</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Cart Details</li>
      </ol>
    </nav>
</div>
<!-- End Page Title -->


<div class="card">
    <div class="card-body">
      <h5 class="card-title">Cart Details</h5>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">SL</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($carts as $cart)
            <tr>
                <td scope="row">{{ $loop->index+1 }}</td>
                <td scope="row">
                    <img src="{{ asset('storage/'.$cart->product->thumbnail_image) }}" width="50" />
                </td>
                <td>{{ $cart->product->name }}</td>
                <td>₹ {{ $cart->product->final_amount }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center">No data found!</td>
              </tr>
            @endforelse


        </tbody>
      </table>

    </div>
</div>

@endsection
