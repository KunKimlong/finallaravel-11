@extends('backend.master')
@section('content')
    @if (Session::has('success'))
        {{-- Session::get('success') --}}
        <script>
            Swal.fire({
            title: "Done",
            text: "Category Created",
            icon: "success"
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            Swal.fire({
            title: "Error",
            text: "please enter category",
            icon: "error"
            });
        </script>
    @endif
    @section('site-title')
        Admin | Add Category
    @endsection
    @section('page-main-title')
        Add Category
    @endsection
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route("addCate")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label">Name</label>
                                    <input class="form-control" type="text" placeholder="Name:" name="name" />
                                </div>   
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Add Category">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
