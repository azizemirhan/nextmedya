@extends('layouts.master')
@section('custom_header')
    @include('layouts.header-dark')
@endsection
@section('content')
<section class="profile__area pt-130 pb-20">
    <div class="container">
       <div class="profile__inner p-relative">
          <div class="row">
             @include('admin.layouts.sidebar')
             @yield('content3')
          </div>
       </div>
    </div>
 </section>
@endsection

