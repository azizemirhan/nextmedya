@extends('layouts.master')
@section('content')
<section class="profile__area pt-130 pb-20">
    <div class="container">
       <div class="profile__inner p-relative">
          <div class="row">
             @include('user.layouts.sidebar')
             @yield('content2')
          </div>
       </div>
    </div>
 </section>
@endsection
