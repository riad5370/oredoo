@extends('frontend.include.master')
@section('body')
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Sign up</h4>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <!--form-->              
                    <form action="{{route('guest.store')}}" class="sign-form widget-form" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Username*">
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address*">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password*">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Already have an account? <a href="{{route('login.index')}}" class="btn-link">Login</a> </p>
                    </form>
                       <!--/-->
                </div> 
            </div>
         </div>
    </div>
</section>       
@endsection