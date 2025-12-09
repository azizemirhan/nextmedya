@extends('admin.layouts.master')

{{-- Controller'dan gelen $page_title'a göre başlığı dinamik olarak ayarlar --}}
@section('title', $page_title ?? 'Gelen Kutusu')

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
                                        {{-- Sol Menü Linkleri --}}
                                        <ul class="nav nav-pills d-block">
                                            <li class="nav-item">
                                                <a class="nav-link list-actions {{ request()->routeIs('admin.mailbox.index') ? 'active' : '' }}"
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
                                                <a class="nav-link list-actions {{ request()->routeIs('admin.mailbox.sent') ? 'active' : '' }}"
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
                                            <li class="nav-item">
                                                <a class="nav-link list-actions {{ request()->routeIs('admin.mailbox.important') ? 'active' : '' }}"
                                                   href="{{ route('admin.mailbox.important') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                    Önemli
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions {{ request()->routeIs('admin.mailbox.trash') ? 'active' : '' }}"
                                                   href="{{ route('admin.mailbox.trash') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-trash">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                    Çöp Kutusu
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="mailbox-inbox" class="accordion mailbox-inbox">
                                <div class="message-box">
                                    <div class="message-box-scroll" id="ct">
                                        @forelse ($mails as $mail)
                                            <div
                                                class="mail-item mailInbox {{ !$mail->is_read && !$mail->trashed() ? 'mail-unread' : '' }}">
                                                <div class="mb-0">
                                                    <div class="mail-item-heading">
                                                        <div class="mail-item-inner d-flex align-items-center">

                                                            {{-- ÖNEMLİ YILDIZ İKONU --}}
                                                            @if(!$mail->trashed())
                                                                <div class="meta-star">
                                                                    <form
                                                                        action="{{ route('admin.mailbox.toggleImportant', $mail->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn btn-link p-0 m-0"
                                                                                style="color: #e2a03f; box-shadow: none; background: transparent; border: none;">
                                                                            @if($mail->is_important)
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="24" height="24"
                                                                                     viewBox="0 0 24 24"
                                                                                     fill="currentColor"
                                                                                     stroke="currentColor"
                                                                                     stroke-width="2"
                                                                                     stroke-linecap="round"
                                                                                     stroke-linejoin="round"
                                                                                     class="feather feather-star">
                                                                                    <polygon
                                                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                                                </svg>
                                                                            @else
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="24" height="24"
                                                                                     viewBox="0 0 24 24" fill="none"
                                                                                     stroke="currentColor"
                                                                                     stroke-width="2"
                                                                                     stroke-linecap="round"
                                                                                     stroke-linejoin="round"
                                                                                     class="feather feather-star">
                                                                                    <polygon
                                                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                                                </svg>
                                                                            @endif
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif

                                                            <div class="f-body flex-grow-1" style="cursor:pointer;"
                                                                 onclick="window.location='{{ route('admin.mailbox.show', $mail->id) }}';">
                                                                <div class="meta-mail-time">
                                                                    <p class="user-email">
                                                                        @if(request()->routeIs('admin.mailbox.sent'))
                                                                            Alıcı: {{ $mail->recipient->name ?? $mail->recipient_email }}
                                                                        @else
                                                                            Gönderen: {{ $mail->sender->name ?? $mail->sender_name ?? 'Bilinmeyen Gönderici' }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div class="meta-title-tag">
                                                                    <p class="mail-content-excerpt">
                                                                        <span
                                                                            class="mail-title">{{ $mail->subject }} - </span>
                                                                        {{ Str::limit(strip_tags($mail->body), 60) }}
                                                                    </p>
                                                                    <p class="meta-time align-self-center">{{ $mail->trashed() ? $mail->deleted_at->diffForHumans() : $mail->created_at->diffForHumans() }}</p>
                                                                </div>
                                                            </div>

                                                            {{-- ÇÖP KUTUSU İÇİN AKSİYON BUTONLARI --}}
                                                            @if($mail->trashed())
                                                                <div
                                                                    class="mail-actions d-flex align-items-center gap-2 ms-auto pe-3">
                                                                    <form
                                                                        action="{{ route('admin.mailbox.restore', $mail->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn btn-sm btn-outline-success">
                                                                            Geri Yükle
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center p-5">Bu klasörde mesaj bulunamadı.</div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $mails->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
