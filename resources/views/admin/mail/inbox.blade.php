@extends('admin.master')
@push('css')
<link rel="stylesheet" href="backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
@endpush
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
    </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
            @if (session('success'))
              <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-body">
              <h6 class="card-title">Data Table</h6>
              <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                      <thead>
                        <tr>
                            <th>Si</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($inboxes as $index => $inbox)
                        <tr class="{{$inbox->status==0?'bg-secondary':''}}">
                          <td>{{$index+1}}</td>
                          <td>{{$inbox->name}}</td>
                          <td>{{$inbox->email}}</td>
                          <td>
                            @php
                            $str = $inbox->subject;
                            @endphp
                        <div>
                            @if (strlen($str) > 15)
                                {{ substr($str, 0, 20) . '.....' }}
                            @else
                                {{ $str }}
                            @endif
                        </div>
                          </td>    
                          <td>
                            @php
                            $str = $inbox->message;
                            @endphp
                        <div>
                            @if (strlen($str) > 15)
                                {{ substr($str, 0, 20) . '.....' }}
                            @else
                                {{ $str }}
                            @endif
                        </div>
                          </td>    
                          <td class="btn-group">
                            <a href="{{route('inbox.show',$inbox->id)}}" class="btn btn-sm btn-primary mx-1">Show</a>

                            <form action="{{route('destroy',$inbox->id)}}" method="POST" onsubmit="return confirm('Are you delete this!')">
                                @csrf
                                @method('GET')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
            </div>
        </div>
      </div>
  </div>
</div>
@endsection
@if(count($inboxes) > 10)
@section('footer_script')
    <script src="backend/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="backend/js/data-table.js"></script>
    <script src="backend/js/template.js"></script>
@endsection
@endif