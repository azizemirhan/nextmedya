@extends('admin.layouts.master')
@section('title', 'Mesaj Detayı')
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
                                <div class="p-4">
                                    <div class="d-flex justify-content-between mb-4">
                                        <h4 class="mail-usr-name">{{ $mail->subject }}</h4>
                                        <div class="action-btns d-flex gap-2">
                                            @if($mail->trashed())
                                                {{-- Geri Yükle Butonu --}}
                                                <form action="{{ route('admin.mailbox.restore', $mail->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-rotate-ccw">
                                                            <polyline points="1 4 1 10 7 10"></polyline>
                                                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                                        </svg>
                                                        Geri Yükle
                                                    </button>
                                                </form>
                                                {{-- Kalıcı Sil Butonu --}}
                                                <form action="{{ route('admin.mailbox.forceDelete', $mail->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Bu mesajı KALICI olarak silmek istediğinize emin misiniz? Bu işlem geri alınamaz.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-trash-2">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                        Kalıcı Olarak Sil
                                                    </button>
                                                </form>
                                            @else
                                                {{-- Sil Butonu --}}
                                                <form action="{{ route('admin.mailbox.destroy', $mail->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Bu mesajı çöp kutusuna taşımak istediğinize emin misiniz?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-trash">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        </svg>
                                                        Sil
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex user-info mb-4">
                                        <div class="f-body">
                                            <div class="meta-mail-time">
                                                <p class="user-email">
                                                    <strong>Gönderen:</strong>
                                                    {{ $mail->sender->name ?? $mail->sender_name ?? 'Bilinmeyen Gönderici' }}
                                                    <small>&lt;{{ $mail->sender->email ?? $mail->sender_email ?? 'N/A' }}
                                                        &gt;</small>
                                                </p>
                                                <p class="user-email">
                                                    <strong>Alıcı:</strong>
                                                    {{ $mail->recipient->name ?? 'Bilinmiyor' }}
                                                    <small>&lt;{{ $mail->recipient->email ?? 'N/A' }}&gt;</small>
                                                </p>
                                                <p class="meta-time align-self-center mt-2">
                                                    <strong>Tarih:</strong>
                                                    {{ $mail->created_at->format('d M Y, H:i') }}
                                                    ({{ $mail->created_at->diffForHumans() }})
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="mail-content-container mt-4">
                                        {!! $mail->body !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
