@extends('admin.master')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-9 ">
            <form action="" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        @if(session('select'))
                            <div class="alert alert-warning">{{session('select')}}</div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <h3 class="card-title">Category List</h3>
                        <h3 class="card-title"><span class="float-right">Total Data: {{$total_category}}</span></h3>
                        <div class="table-responsive">
                            <table class="table" id="dataTableExample">
                                <thead>
                                <tr>
                                    <th>Si</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categorys as $key=>$category)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <img width="100" src="{{asset('uploads/category/'.$category->image)}}" alt="">
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-{{$category->status == 1?'success':'light'}}">{{$category->status == 1?'Published':'Unpublished'}}</a>
                                        </td>
                                        <td>
                                            <div class="dropdown mb-2">
                                            <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                              </button>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('categorys.status',$category->id)}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">{{$category->status == 1?'Unpublished':'Published'}}</span></a>

                                                <a class="dropdown-item d-flex align-items-center" href="{{route('categorys.edit',$category->id)}}"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>

                                                <form action="{{route('categorys.destroy',$category->id)}}" method="POST" onsubmit="return confirm('Are you delete this!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item d-flex align-items-center" href=""><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></button>
                                                </form>
                                                
                                              </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                    <form action="{{route('categorys.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img width="100" src="" id="blah" alt="">
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Category" class="btn btn-sm btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection