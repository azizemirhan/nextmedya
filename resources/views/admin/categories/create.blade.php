 @extends('admin.layouts.master')

 @section('title', 'Yeni Kategori Ekle')

 @section('content')
     <div id="flLoginForm" class="col-lg-12 layout-spacing">
         <div class="statbox widget box box-shadow">
             <div class="widget-header">
                 <div class="row">
                     <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                         <h4>Yeni Kategori Oluştur</h4>
                     </div>
                 </div>
             </div>
             <div class="widget-content widget-content-area">

                 <form class="row g-3" action="{{ route('admin.categories.store') }}" method="POST"
                     enctype="multipart/form-data"> @csrf
                     @include('admin.categories._form')
                 </form>

             </div>
         </div>
     </div>
 @endsection
