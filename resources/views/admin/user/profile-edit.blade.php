@extends('admin.master')
@section('content')
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                         @endif
                        <h6 class="card-title">Profile Update</h6>
                        <form class="forms-sample" action="{{route('user.update',Auth::user()->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{Auth::user()->name}}">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email address</label>
                                <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" id="Email">
                            </div>
                            <div class="form-group">
                                <label for="Password">Old Password</label>
                                <input type="password" name="old_password" class="form-control" id="Password" autocomplete="off" placeholder="Old_Password">
                                @if (session('failled'))
                                    <strong class="text-danger">{{session('failled')}}</strong>
                                @endif
                                @error('old_password')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Password1">New Password</label>
                                <input type="password" name="password" class="form-control" id="Password1" placeholder="New_Password">
                                @error('password')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Password2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="Password2" placeholder="Confirm_Password">
                                @error('password_confirmation')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Update Profile Photo</h6>
                        <form action="{{route('photo.update')}}" method="post" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br>
                                <img width="70" src="{{asset('uploads/user/'.(Auth::user()->image))}}" id="blah" alt="">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
