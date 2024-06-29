@extends('backend.master')
@section('content')

        @if (Session::has('error'))
            <script>
                Swal.fire({
                    title: "Error",
                    text: "please choose all data",
                    icon: "error"
                });
            </script>
        @endif

    @section('site-title')
        Admin | Update Product
    @endsection
    @section('page-main-title')
        Update Product
    @endsection
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('updatePro')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Name</label>
                                    <input class="form-control" value="{{$product->name}}" type="text" name="name" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Quantity</label>
                                    <input class="form-control" value="{{$product->qty}}" type="text" name="qty" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Regular Price</label>
                                    <input class="form-control" value="{{$product->regular_price}}" type="number" name="regular_price" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Sale Price</label>
                                    <input class="form-control" value="{{$product->sale_price}}" type="number" name="sale_price" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Available Size</label>
                                    <select name="size[]" class="form-control size-color" multiple="multiple">
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Available Color</label>
                                    <select name="color[]" class="form-control size-color" multiple="multiple">
                                        <option value="Red">Red</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Grey">Grey</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Pink">Pink</option>
                                        <option value="Black">Black</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Category</label>
                                    <select name="category" class="form-control">
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>    
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label text-danger">Recommend image size ..x.. pixels.</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                </div>
                                <input type="text" name="old_thumbnail" value="{{$product->thumbnail}}" id="">
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Product">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
