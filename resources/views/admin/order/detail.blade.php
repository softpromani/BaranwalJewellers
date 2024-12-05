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
                            <h4 class="text-capitalize">Order ID #100001</h4>
                            <div class="">
                                27 Nov, 2024 , 12:24 PM
                            </div>
                        </div>
                        <div class="text-sm-right flex-grow-1">
                            <div class="d-flex flex-column gap-2 mt-3">
                                <div class="order-status d-flex justify-content-sm-end gap-10 text-capitalize">
                                    <span class="title-color">Status: </span>
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Confirmed</span>
                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Pending</span>
                                </div>

                                <div class="payment-status d-flex justify-content-sm-end gap-10">
                                    <span class="title-color">Payment Status:</span>
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Paid</span>
                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Unpaid</span>
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
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img class="avatar avatar-60 rounded img-fit"
                                        src="#"
                                        alt="Image Description">
                                    </td>
                                    <td>
                                        <div class="media align-items-center gap-10">

                                            <div>
                                                <h6 class="title-color">FireBees Modern Wooden</h6>
                                                <div><strong>Qty :</strong> 1 </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        ₹1,640.00
                                    </td>
                                    <td>₹1,099.00</td>
                                    <td>₹901.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <div class="row justify-content-md-end mb-3">
                        <div class="col-md-9 col-lg-8">
                            <dl class="row gy-1 text-sm-right">
                                <dt class="col-5">Item price</dt>
                                <dd class="col-6 title-color">
                                    <strong>₹1,640.00</strong>
                                </dd>
                                <dt class="col-5 text-capitalize">Item discount</dt>
                                <dd class="col-6 title-color">
                                    -
                                    <strong>₹1,099.00</strong>
                                </dd>

                                <dt class="col-5"><strong>Total</strong></dt>
                                <dd class="col-6 title-color">
                                    <strong>₹1,000.00</strong>
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
                        <select name="order_status" id="order_status" class="status form-control" data-id="100001">

                            <option value="pending"> Pending</option>
                            <option value="confirmed" selected=""> Confirmed</option>
                            <option value="delivered">Delivered </option>
                            <option value="canceled">Canceled </option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between align-items-center gap-10 form-control h-auto flex-wrap">
                        <span class="title-color">
                            Payment status
                        </span>
                        <div class="d-flex justify-content-end min-w-100 align-items-center gap-2">
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Paid</span>
                            <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Unpaid</span>
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
                            <span class="title-color"><strong>Ranganath V A </strong></span>
                            <span class="title-color break-all"><strong>+919632688893</strong></span>
                            <span class="title-color break-all">ranganath.ava@gmail.com</span>
                            <span class="title-color break-all">lko</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
