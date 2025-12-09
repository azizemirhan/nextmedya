@extends('admin.layouts.master')
@section('title', 'Yeni Mesaj Oluştur')

{{-- Quill Editor için CSS --}}
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/src/plugins/src/editors/quill/quill.snow.css') }}">
@endpush

@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="mail-box-container">
                            <div class="mail-overlay"></div>
                            <div class="tab-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 text-center mail-btn-container">
                                        <a class="btn btn-block" href="{{ route('admin.mailbox.compose') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12 mail-categories-container">
                                        <ul class="nav nav-pills d-block">
                                            <li class="nav-item">
                                                <a class="nav-link list-actions"
                                                   href="{{ route('admin.mailbox.index') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-inbox">
                                                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                                        <path
                                                            d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                                    </svg>
                                                    Gelen Kutusu
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions"
                                                   href="{{ route('admin.mailbox.sent') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-send">
                                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                    </svg>
                                                    Gönderilmiş
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="mailbox-inbox" class="accordion mailbox-inbox">
                                <form action="{{ route('admin.mailbox.send') }}" method="POST">
                                    @csrf
                                    <div class="compose-box">
                                        <div class="compose-content" id="compose-mail">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4 mail-to">
                                                        <label for="recipient_email" class="form-label fw-bold">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-user">
                                                                <path
                                                                    d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                <circle cx="12" cy="7" r="4"></circle>
                                                            </svg>
                                                            Alıcı:
                                                        </label>
                                                        {{-- SELECT KUTUSU YERİNE INPUT KULLANIYORUZ --}}
                                                        <input type="email" name="recipient_email" id="recipient_email"
                                                               class="form-control" placeholder="alici@example.com"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 mail-subject">
                                                <label for="subject" class="form-label fw-bold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-mail">
                                                        <path
                                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                        <polyline points="22,6 12,13 2,6"></polyline>
                                                    </svg>
                                                    Konu:</label>
                                                <input type="text" id="subject" name="subject" class="form-control"
                                                       placeholder="Mesaj Konusu" required>
                                            </div>

                                            <div class="mail-message">
                                                <label class="form-label fw-bold">Mesaj:</label>
                                                {{-- Hidden input to store Quill editor's content --}}
                                                <input type="hidden" name="body" id="mail-body">
                                                <div id="editor-container" style="height: 300px;"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="text-end mt-4">
                                        <a href="{{ route('admin.mailbox.index') }}" class="btn btn-danger">İptal</a>
                                        <button type="submit" id="btn-send" class="btn btn-primary">Gönder</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/src/plugins/src/editors/quill/quill.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var quill = new Quill('#editor-container', {
                theme: 'snow'
            });

            // Update hidden input when text changes
            quill.on('text-change', function () {
                document.getElementById('mail-body').value = quill.root.innerHTML;
            });

            // Prevent form submission if body is empty
            var form = document.querySelector('form');
            form.addEventListener('submit', function (e) {
                // Check if quill editor content is empty (or just contains empty html like <p><br></p>)
                if (quill.getLength() <= 1) {
                    e.preventDefault();
                    alert('Mesaj içeriği boş olamaz!');
                }
            });
        });
    </script>
@endpush
