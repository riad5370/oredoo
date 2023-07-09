@extends('admin.master')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('inbox')}}">inbox</a></li>
        <li class="breadcrumb-item active" aria-current="page">show message</li>
    </ol>
</nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (session('update'))
                    <div class="alert alert-success">{{session('update')}}</div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-success">{{session('delete')}}</div>
                @endif
                <div class="card-header">
                    <h3>view Message</h3>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$message->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td style="max-width: 100%; white-space: normal;">
                                <div style="overflow-wrap: break-word; word-wrap: break-word;">
                                  {{$message->email}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td style="max-width: 100%; white-space: normal;">
                                <div style="overflow-wrap: break-word; word-wrap: break-word;">
                                  {{$message->subject}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td style="max-width: 100%; white-space: normal;">
                                <div style="overflow-wrap: break-word; word-wrap: break-word;">
                                  {{$message->message}}
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection