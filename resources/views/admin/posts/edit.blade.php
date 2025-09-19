@extends('admin.layouts.master')
@section('title', 'Yazıyı Düzenle')
@section('content')
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>"{{ Str::limit($post->title, 50) }}" Yazısını Düzenle</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form class="row" action="{{ route('admin.posts.update', $post) }}" method="POST"
                    enctype="multipart/form-data" id="post-form">
                    @csrf
                    @method('PUT')
                    @include('admin.posts._form', ['post' => $post])
                </form>
            </div>
        </div>
    </div>
@endsection
