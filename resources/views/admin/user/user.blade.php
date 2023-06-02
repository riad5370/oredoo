@extends('admin.master')
@push('css')
<link rel="stylesheet" href="backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Basic Tables</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 ">
            <form action="{{route('multi.delete')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        @if(session('select'))
                            <div class="alert alert-warning">{{session('select')}}</div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <h3 class="card-title">User List</h3>
                        <h3 class="card-title"><span class="float-right">Total User: {{ $total_user }}</span></h3>
                        <div class="card-title">
                            <button name="click" value="1" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure this')">Delete Checked</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="dataTableExample">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"> check all</th>
                                    <th>Si</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key=>$user)
                                    <tr>
                                        <td><input type="checkbox" name="check[]" value="{{$user->id}}"></td>
                                        <th>{{$key+1}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if($user->image == null)
                                                <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                                            @else
                                                <img src="{{asset('uploads/user/'.$user->image)}}" alt="">
                                            @endif
                                        </td>
                                        <td>{{$user->created_at->diffForHumans()}}</td>
                                        <td>
                                            <button name="click" value="{{$user->id}}" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure this')">Delete</button>
                                            {{-- <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                                @csrf
                                                
                                                <input type="submit" value="Delete"  class="btn btn-danger btn-sm" onclick="return confirm('are you sure delete this!')">
                                            </form> --}}
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
@section('footer_script')
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
      <script src="backend/vendors/datatables.net/jquery.dataTables.js"></script>
      <script src="backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
     <script src="backend/js/data-table.js"></script>
     <script src="backend/js/template.js"></script>
@endsection