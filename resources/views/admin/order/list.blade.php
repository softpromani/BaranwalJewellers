@extends('admin.includes.layout')
@section('title','Order List')
@section('content')

<div class="pagetitle">
    <h1>Order List</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Order List</li>
      </ol>
    </nav>
</div>
<!-- End Page Title -->


<div class="card">
    <div class="card-body">
      <h5 class="card-title">Order List</h5>

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
            @php
                $start = ($orders->currentPage() - 1) * $orders->perPage() + 1;
            @endphp
            @forelse ($orders as $order)
            <tr>
                <th scope="row">{{ $start + $index }}</th>
                <td>{{ $order->order_id }}</td>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M,Y') }}</td>
                <td>{{ $order->user->name }}<br/><span class="badge bg-info">{{ $order->user->phone }}</span></td>
                <td>₹ {{ $order->order_amount }}</td>
                <td>
                    @if ($order->order_status == 'completed')
                      <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Completed</span>
                    @else
                      <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Pending</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.orderDetail',  $order->id ) }}"><i class="bi bi-eye"></i></a>
                </td>
              </tr>

            @empty
              <tr>
                <td colspan="7" class="text-center">No data found!</td>
              </tr>
            @endforelse

        </tbody>
      </table>
      {{ $orders->links('pagination::bootstrap-4') }}
    </div>
  </div>
@endsection
