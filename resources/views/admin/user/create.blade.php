@extends('admin.master')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create User</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create User</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <form class="forms-sample" action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row py-3">
                            <label for="" class="col-form-label col-md-4">Name</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                                @error('name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row py-3">
                            <label for="" class="col-form-label col-md-4">Email Address</label>
                            <div class="col-md-8">
                                <input type="email" name="email" class="form-control" placeholder="email">
                                @error('email')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row py-3">
                            <label for="" class="col-form-label col-md-4">Password</label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                @error('password')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row py-3">
                            <label for="" class="col-form-label col-md-4">Confirm Password</label>
                            <div class="col-md-8">
                                <input type="password" name="password_confirmation" class="form-control" id="Password2" placeholder="Confirm_Password">
                            @error('password_confirmation')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row py-3">
                            <label for="" class="col-form-label col-md-4">Image</label>
                            <div class="col-md-8">
                                <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br>
                                <img id="blah" alt="" width="100">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
