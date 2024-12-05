@extends('admin.includes.layout')
@section('title','Dashboard')
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

          <!-- Recent Sales -->
          <div class="col-6">
            <div class="card recent-sales overflow-auto">

              <div class="card-body">
                <h5 class="card-title">Recently Ordered</h5>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Customer</th>
                      <th scope="col">Product</th>
                      <th scope="col">Price</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"><a href="#">#2457</a></th>
                      <td>Brandon Jacob</td>
                      <td><a href="#" class="text-primary">At praesentium minu</a></td>
                      <td>$64</td>
                      <td><span class="badge bg-success">Confirmed</span></td>
                    </tr>
                  </tbody>
                </table>

              </div>

            </div>
          </div>
          <!-- End Recent Sales -->

       <!-- Recent Sales -->
       <div class="col-6">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">
            <h5 class="card-title">Recent Abandoned Carts</h5>

            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col">Customer</th>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Brandon Jacob <br/><span class="badge bg-primary">+91 123456778</span></td>
                  <td><a href="#" class="text-primary">At praesentium minu</a></td>
                  <td>$64</td>
                </tr>
              </tbody>
            </table>

          </div>

        </div>
      </div>
      <!-- End Recent Sales -->


        </div>
      </div><!-- End Left side columns -->

    </div>
  </section>
@endsection
