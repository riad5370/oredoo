@extends('frontend.include.master')
@section('body')
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>About us</h1>
                         <p class="links"><a href="{{route('index')}}">Home <i class="las la-angle-right"></i></a> pages</p>
                     </div>
                 </div>  
             </div>
         </div>
     </div>
</div>

<!--about-us-->
<section class="about-us">
    <div class="container-fluid">
        <div class="about-us-area">
            <div class="row ">
                <div class="col-lg-12 ">
                    <div class="image">
                        <img src="{{asset('uploads/about/'.$about->first()->image)}}" alt="">
                    </div>
               
                    <div class="description">
                        <h3 >{{$about->first()->title}}</h3>
                        <p>{{$about->first()->description}}</p>
                        <a href="{{route('contact')}}" class="btn-custom">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
@endsection