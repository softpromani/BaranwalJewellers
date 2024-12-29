@extends('admin.includes.layout')
@section('title', 'Dashboard')
@section('content')

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Live Rate <span>| Gold MCX</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-rupee"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format(getBusinessSetting('mcx_gold_rate'), 2) }} / gms</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Live Rate <span>| Silver MCX</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-rupee"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format(getBusinessSetting('mcx_silver_rate'), 2) }} / gms</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Customers </span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ \App\Models\User::active()->count() }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Products</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-shop"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ \App\Models\Product::active()->count() }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Orders</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bag-heart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ \App\Models\Order::count() }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Recent Orders -->
                    <div class="col-6">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Recent Orders</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <th scope="row"><a href="{{ route('admin.orderDetail', $order->id) }}">#{{ $order->order_id }}</a></th>
                                                <td>{{ isset($order->user->name) && $order->user->name != null ? $order->user->name : 'BAM User' }}</td>
                                                <td>{{ $order->user->phone }}</td>
                                                <td>₹ {{ $order->order_amount }}</td>
                                                <td>
                                                    @if ($order->order_status == 'confirmed')
                                                        <span class="badge bg-primary"><i
                                                                class="bi bi-check-circle me-1"></i> Confirmed</span>
                                                    @elseif ($order->order_status == 'pending')
                                                        <span class="badge bg-warning"><i
                                                                class="bi bi-exclamation-octagon me-1"></i> Pending</span>
                                                    @elseif ($order->order_status == 'canceled')
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-octagon me-1"></i> Canceled</span>
                                                    @else
                                                        <span class="badge bg-success"><i
                                                                class="bi bi-exclamation-octagon me-1"></i> Delivered</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No data found!</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Orders -->

                    <!-- Recent Abandoned Carts -->
                    <div class="col-6">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Recent Abandoned Carts</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($carts as $cart)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ isset($cart->user->name) && $cart->user->name != null ? $cart->user->name : 'BAM User' }}
                                                </td>
                                                <td>+91 {{ $cart->user->phone ?? 'N/A' }}</td>
                                                <td>₹ {{ $cart->product->final_amount ?? 0.0 }}</td>
                                                <td>
                                                    <span class="badge bg-warning"><i class="bi bi-exclamation-octagon me-1"></i> Pending</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data found!</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Abandoned Carts -->

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>
@endsection
@section('script-area')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
@endsection
