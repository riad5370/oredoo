@extends('admin.master')
@push('css')
<link rel="stylesheet" href="backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tag</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
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
                        <h3 class="card-title">Tag List</h3>
                        <h3 class="card-title"><span class="float-right">Total Data: {{$total_tag}}</span></h3>
                        <div class="table-responsive">
                            <table class="table" id="dataTableExample">
                                <thead>
                                <tr>
                                    <th>Si</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $key=>$tag)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$tag->name}}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-{{$tag->status == 1?'success':'light'}}">{{$tag->status == 1?'Published':'Unpublished'}}</a>
                                        </td>
                                        <td>
                                            <div class="dropdown mb-2">
                                            <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                              </button>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('tags.status',$tag->id)}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">{{$tag->status == 1?'Unpublished':'Published'}}</span></a>

                                                <a class="dropdown-item d-flex align-items-center" href="{{route('tags.edit',$tag->id)}}"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>

                                                <form action="{{route('tags.destroy',$tag->id)}}" method="POST" onsubmit="return confirm('Are you delete this!')">
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
    </div>
@endsection
@if(count($tags) > 10)
@section('footer_script')
    <script src="backend/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="backend/js/data-table.js"></script>
    <script src="backend/js/template.js"></script>
@endsection
@endif