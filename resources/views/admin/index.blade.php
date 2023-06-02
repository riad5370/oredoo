@extends('admin.master')
@section('content')
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-8">
               <div class="card">
                   <div class="card-header">
                       <h4>Welcome to <span style="font-size: 16px;color:red">{{Auth::user()->name}}</span></h4>
                   </div>
                   <div class="card-body">
                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam blanditiis corporis delectus distinctio enim harum perspiciatis sed sequi tempore, velit.</p>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection
