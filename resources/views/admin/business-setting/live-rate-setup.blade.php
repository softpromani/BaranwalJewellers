@extends('admin.includes.layout')
@section('title', 'Live Rate Setup')
@section('content')

    <div class="pagetitle">
        <h1>Live Rate Setup</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Live Rate Setup</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->

    <div class="card">
        <div class="card-body">

            <h5 class="card-title">MCX Live Rate<span class="text-danger"> ( Please add price in ₹ only )</span></h5>
            <!-- No Labels Form -->
            <form class="row g-3" action="{{ route('admin.liveRate') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Silver Jewellery</label>
                    <input type="number" class="form-control" name="silver_jewellery" placeholder="Price" value="{{ getLiveRate('silver_jewellery') }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Gold Jewellery 99.99%</label>
                    <input type="number" class="form-control" name="gold_jewellery_99" placeholder="Price" value="{{ getLiveRate('gold_jewellery_99') }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Gold Jewellery 24K 999 RTGS Bank</label>
                    <input type="number" class="form-control" name="gold_jewellery_24k" placeholder="Price" value="{{ getLiveRate('gold_jewellery_24k') }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Gold Jewellery 22K 916</label>
                    <input type="number" class="form-control" name="gold_jewellery_22k" placeholder="Price" value="{{ getLiveRate('gold_jewellery_22k') }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Gold Jewellery 18K 750</label>
                    <input type="number" class="form-control" name="gold_jewellery_18k" placeholder="Price" value="{{ getLiveRate('gold_jewellery_18k') }}">
                </div>
                {{-- <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Gold Costing</label>
                    <input type="number" class="form-control" name="gold_costing" placeholder="Price" value="{{ getLiveRate('gold_costing') }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Silver Costing</label>
                    <input type="number" class="form-control" name="silver_costing" placeholder="Price" value="{{ getLiveRate('silver_costing') }}">
                </div> --}}

                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection
