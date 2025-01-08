@extends('admin.includes.layout')
@section('title', 'Order Detail')
@section('content')

    <div class="pagetitle">
        <h1>Order Detail</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Order Detail</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="row gy-3" >
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap flex-md-nowrap gap-10 justify-content-between mb-4">
                        <div class="d-flex flex-column gap-10 mt-3">
                            <h4 class="text-capitalize">Order ID #{{ $order->order_id }}</h4>
                            <div class="">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
                            </div>
                        </div>
                        <div class="text-sm-right flex-grow-1">
                            <div class="d-flex flex-column gap-2 mt-3">
                                <div class="order-status d-flex justify-content-sm-end gap-10 text-capitalize">
                                    <span class="title-color">Order Status: </span>
                                    @if ($order->order_status == 'confirmed')
                                        <span class="badge bg-primary"><i class="bi bi-check-circle me-1"></i> Confirmed</span>
                                    @elseif ($order->order_status == 'pending')
                                    <span class="badge bg-warning"><i class="bi bi-exclamation-octagon me-1"></i> Pending</span>
                                    @elseif ($order->order_status == 'canceled')
                                    <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Canceled</span>
                                    @elseif ($order->order_status == 'pending_for_payment')
                                    <span class="badge bg-info"><i class="bi bi-exclamation-octagon me-1"></i> Pending for payment</span>
                                    @else
                                        <span class="badge bg-success"><i class="bi bi-exclamation-octagon me-1"></i> Delivered</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table fz-12 table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Total price</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($order->order_details as $detail)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>
                                        <img class="avatar avatar-60 rounded img-fit"
                                        src="{{ asset('storage/'.$detail->product->thumbnail_image) }}"
                                        alt="Image Description" width="50">
                                    </td>
                                    <td>
                                        <div class="media align-items-center gap-10">

                                            <div>
                                                <h6 class="title-color">{{ $detail->product->name }}</h6>
                                                <div><strong>Qty :</strong> {{ $detail->quantity }} </div>
                                            </div>
                                        </div>

                                    </td>

                                    <td>₹ {{ ($detail->price/$detail->quantity) ?? 0.00 }}</td>
                                    <td>
                                        ₹ {{ isset($detail->discount) ? $detail->discount : 0.00 }}
                                    </td>
                                    <td>₹ {{ $detail->price }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">No data found!</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <div class="row justify-content-md-end mb-3">
                        <div class="col-md-9 col-lg-8">
                            <dl class="row gy-1 text-sm-right">
                                <dt class="col-5">Item price</dt>
                                <dd class="col-6 title-color">
                                    <strong>₹ {{ $order->order_amount }}</strong>
                                </dd>
                                <dt class="col-5 text-capitalize">Item discount</dt>
                                <dd class="col-6 title-color">
                                    -
                                    <strong>₹{{ isset($order->disount_amount) ? $order->disount_amount : 0.0 }}</strong>
                                </dd>

                                <dt class="col-5"><strong>Total</strong></dt>
                                <dd class="col-6 title-color">
                                    <strong>₹ {{ $order->order_amount - $order->disount_amount }}</strong>
                                </dd>
                            </dl>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex flex-column gap-3">
            <div class="card">
                <div class="card-body text-capitalize d-flex flex-column gap-4 mt-3">
                    <div class="d-flex flex-column align-items-center gap-2">
                        <h4 class="mb-0 text-center">Order &amp; Shipping Info</h4>
                    </div>
                    <div class="">
                        <label class="font-weight-bold title-color fz-14">Change order status</label>
                        <select name="order_status" id="order_status" class="form-control order-status" data-id="{{ $order->id }}">
                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }} > Pending</option>
                            <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}> Confirmed</option>
                            <option value="canceled" {{ $order->order_status == 'canceled' ? 'selected' : '' }}>Canceled </option>
                            <option value="pending_for_payment" {{ $order->order_status == 'pending_for_payment' ? 'selected' : '' }}>Pending for payment </option>
                            <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered </option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between align-items-center gap-10 form-control h-auto flex-wrap">
                        <span class="title-color">
                            Payment status
                        </span>
                        <div class="d-flex justify-content-end min-w-100 align-items-center gap-2">
                            @if ($order->order_status == 'paid')
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Paid</span>
                            @else
                            <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Unpaid</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-2 align-items-center justify-content-between mb-4 mt-3">
                        <h4 class="d-flex gap-2">
                            <img src="#"
                                alt="">
                            Customer information
                        </h4>
                    </div>
                    <div class="media flex-wrap gap-3">
                        <div class="media-body d-flex flex-column gap-1">
                            <span class="title-color"><strong>{{ $order->user->name ?? '' }} </strong></span>
                            <span class="title-color break-all"><strong>+91 {{ $order->user->phone ?? '' }}</strong></span>
                            <span class="title-color break-all">{{ $order->user->email ?? 'N/A' }}</span>
                            <span class="title-color break-all">{{ $order->user->address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('change', '.order-status', function () {

            let orderId = $(this).data('id');
            let newStatus = $(this).val();
            $.ajax({
                url: "{{ url('admin/updateorder-status') }}/" + orderId, // Append the order ID
                method: 'POST',
                data: {
                    status: newStatus, // Pass the new status
                    _token: "{{ csrf_token() }}" // CSRF token for POST request
                },
                success: function (response) {
                    if(response.status == 1)
                    {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                          })
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                          })
                    }

                    location.reload();
                },
                error: function (xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                      });
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

@endsection
