<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: blue;
        color: white;
        text-align: center;
        padding: 10px 0;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brands Page') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 mt-3">
                @if(session('success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <h6>Brands</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Action</th>
                        </tr>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td scope="cole">{{$brand->id}}</td>
                            <td scope="cole">{{$brand->brand_name}}</td>
                            <td scope="cole"><img src="{{asset($brand->brand_image)}}" width="70px" height="40px" alt=""></td>
                            <td scope="cole">{{$brand->created_at->diffForHumans()}}</td>
                            <td scope="cole">{{$brand->user_id}}</td>
                            <td scope="cole">
                                <a href="" class="btn btn-info">Edit</a>
                                <a href="" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </thead>
                </table>

                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <div class="card blue-border">
                                <div class="card-header">
                                    Add New Brand
                                </div>
                                <div class="card-body">
                                    <form action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="CategoryName" class="form-label">Brand Name</label>
                                            <input type="text" name="brand_name" class="form-control">
                                            @error('brand_name')
                                            <div class="small text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            <label for="CategoryName" class="form-label">Brand Image</label>
                                            <input type="file" name="brand_image" class="form-control">
                                            @error('brand_image')
                                            <div class="small text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            <input type="submit" class="btn btn-primary mt-3" value="Submit" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</x-app-layout>
<!-- Add this inside the <head> tag of your layout file -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>