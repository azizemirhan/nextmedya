@extends('admin.layouts.master')
@section('title', 'Yeni Yazı Ekle')
@section('content')
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Yeni Yazı Oluştur</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form class="row" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data"
                    id="post-form">
                    @csrf
                    @include('admin.posts._form')
                </form>
            </div>
        </div>
    </div>
@endsection
