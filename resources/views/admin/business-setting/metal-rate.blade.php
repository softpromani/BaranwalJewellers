@extends('admin.includes.layout')
@section('title', 'Category')
@section('content')

    <div class="pagetitle">
        <h1>Metal Rate Setup</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Metal Rate Setup</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->

    @foreach ($metals as $metal)
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Add {{ ucfirst($metal->name) }} Rate <span class="text-danger">( Please add per gms
                        price only )</span></h5>
                <!-- No Labels Form -->
                <form class="row g-3 " action="{{ route('admin.metal-rate') }}" method="POST">
                    @csrf
                    @foreach ($carats as $carat)

                        <input type="hidden" name="metal_id[]" value="{{ $metal->id }}">
                        <input type="hidden" name="carat_id[]" value="{{ $carat->id }}">

                        <div class="col-md-3">
                            <label for="inputPassword4" class="form-label">{{ $carat->name }} Price</label>
                            <input type="number" step="0.1" class="form-control" name="price[]" placeholder="Price"
                                value="{{ getCaratPrice($metal->id, $carat->id) }}">
                        </div>

                    @endforeach

                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    @endforeach
@endsection
