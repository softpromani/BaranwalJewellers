@extends('admin.includes.layout')
@section('title', 'Product')
@section('content')

    <div class="pagetitle">
        <h1>Add Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Add Product</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Product</h5>

            <!-- No Labels Form -->
            <form class="row g-3"
                action="{{ isset($editproduct) ? route('admin.product.update', $editproduct->id) : route('admin.product.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($editproduct)
                    @method('PATCH')
                @endisset
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Product name" value="{{ isset($editproduct) ? $editproduct->name : '' }}">
                </div>

                <div class="col-md-12">
                    <label for="inputDescription" class="form-label">Description</label>
                    <textarea id="editor" name="description" placeholder="Product Description">{!! isset($editproduct) ? $editproduct->description : '' !!}</textarea>
                </div>

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Thumbnail Image</label>
                    <input type="file" class="form-control" name="thumbnail_image">
                </div>

                <div class="col-md-4">
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" class="form-control" name="category_id">
                        <option value="" selected disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ isset($editproduct) ? ($editproduct->category_id == $category->id ? 'selected' : '') : ''  }}>{{ ucfirst($category->name) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Images</label>
                    <input type="file" class="form-control" name="images">
                </div> --}}

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Packing Charge <span class="text-info">(In Rs. Only)</span></label>
                    <input type="number" class="form-control" name="packing_charge" placeholder="Packing Charge" value="{{ isset($editproduct) ? $editproduct->packing_charge : '' }}">
                </div>

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Hallmarking Charge <span class="text-info">(In Rs. Only)</label>
                    <input type="number" class="form-control" name="hallmarking_charge" placeholder="Hallmarking Charge" value="{{ isset($editproduct) ? $editproduct->hallmarking_charge : '' }}">
                </div>

                {{-- <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Price">
                </div> --}}

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Making Charge <span class="text-info">(In Percentage Only)</label>
                    <input type="number" class="form-control" name="making_charge" placeholder="Making Charge" value="{{ isset($editproduct) ? $editproduct->making_charge : '' }}">
                </div>

                {{-- <div class="col-md-4">
                    <label for="discount_type" class="form-label">Discount Type</label>
                    <select id="discount_type" class="form-control" name="discount_type">
                        <option value="" selected disabled>Select Discount Type</option>
                        <option value="percentage">Percentage</option>
                        <option value="flat">Flat</option>
                    </select>
                </div>


                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Discount</label>
                    <input type="number" class="form-control" name="discount" placeholder="Discount">
                </div> --}}

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Stock</label>
                    <input type="text" class="form-control" name="stock" placeholder="Stock" value="{{ isset($editproduct) ? $editproduct->packing_charge : '' }}">
                </div>

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Tax <span class="text-info">(In Percentage Only)</label>
                    <input type="number" class="form-control" name="tax" placeholder="Tax" value="{{ isset($editproduct) ? $editproduct->tax : '' }}">
                </div>

                <div class="col-md-4">
                    <label for="metal_id" class="form-label">Metal</label>
                    <select id="metal_id" class="form-control" name="metal_id">
                        <option value="" selected disabled>Select Metal</option>
                        @foreach ($metals as $metal)
                            <option value="{{ $metal->id }}" {{ isset($editproduct) ? ($editproduct->metal_id == $metal->id ? 'selected' : '') : ''  }} >{{ ucfirst($metal->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="caret_id" class="form-label">Carat</label>
                    <select id="caret_id" class="form-control" name="carat_id">
                        <option value="" selected disabled>Select Carat</option>
                        @foreach ($carats as $carat)
                            <option value="{{ $carat->id }}"  {{ isset($editproduct) ? ($editproduct->carat_id == $carat->id ? 'selected' : '') : ''  }}>{{ $carat->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Weight <span class="text-danger">(In gms only)</span></label>
                    <input type="number" class="form-control" step="0.1" name="weight" placeholder="Weight (In gms)" value="{{ isset($editproduct) ? $editproduct->weight : '' }}">
                </div>

                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>

        </div>
    </div>

<!-- Include CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'), {
        toolbar: [
            'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'
        ],
        link: {
            addTargetToExternalLinks: true,
        },
    }).catch(error => {
        console.error(error);
    });
</script>
@endsection
