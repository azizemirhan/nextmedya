@extends('admin.layouts.master')
@section('title', 'Kişiler')
@section('content')
    <div class="row layout-spacing layout-top-spacing" id="cancel-row">
        <div class="col-lg-12">
            <div class="widget-content searchable-container list">
                <div class="row">
                    <div
                        class="col-xl-8 col-lg-7 col-md-7 col-sm-12 filtered-list-search layout-spacing align-self-center">
                        {{-- Filtreleme Formuna bir ID ekliyoruz --}}
                        <form id="contact-filter-form" class="form-inline my-2 my-lg-0" method="GET"
                              action="{{ route('admin.contacts.index') }}">
                            <div class="">
                                <input type="text" name="q" class="form-control product-search"
                                       value="{{ request('q') }}" placeholder="İsim, unvan, şirket ara...">
                            </div>
                            {{-- Buraya select gibi başka filtreler de ekleyebilirsiniz --}}
                        </form>
                    </div>
                    <div
                        class="col-xl-4 col-lg-5 col-md-5 col-sm-12 text-sm-end text-center layout-spacing align-self-center">
                        <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary"><i
                                class="bi bi-plus-circle"></i> Yeni Kişi Ekle</a>
                    </div>
                </div>

                {{-- YENİ: AJAX ile güncellenecek olan alan --}}
                <div id="contact-list-container">
                    {{-- Başlangıçta listeyi partial ile yüklüyoruz --}}
                    @include('admin.contacts._contact_list', ['contacts' => $contacts])
                </div>

            </div>
        </div>
    </div>
    <!-- Paylaş Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalLabel">Kişiyi Paylaş</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2 fw-semibold" id="share-name"></div>
                    <div class="input-group">
                        <input type="text" id="share-link" class="form-control" readonly>
                        <button class="btn btn-outline-secondary" type="button" id="btn-copy-link">
                            Kopyala
                        </button>
                    </div>
                    <div class="form-text mt-2">Bu bağlantıyı ekip arkadaşlarınla paylaş.</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const $form = $('#contact-filter-form');
            const $input = $('.product-search');
            const $wrap = $('#contact-list-container');

            // Delegated: yeni gelen pagination linkleri de çalışır
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                const pageUrl = $(this).attr('href'); // string
                performFilter(pageUrl);
            });

            // Canlı arama (debounce)
            $input.on('keyup', debounce(() => performFilter(null), 300));

            function performFilter(pageUrl = null) {
                const base = new URL(pageUrl || $form.attr('action'), window.location.origin);
                const params = new URLSearchParams($form.serialize());
                base.search = params.toString();
                const fullUrl = base.toString();

                history.replaceState({}, '', fullUrl);

                $.ajax({
                    url: fullUrl,
                    type: 'GET',
                    beforeSend: () => $wrap.css('opacity', .5),
                    success: (html) => $wrap.html(html),
                    error: (xhr) => console.error('Filtreleme hatası:', xhr.status, xhr.responseText),
                    complete: () => $wrap.css('opacity', 1)
                });
            }

            function debounce(fn, delay) {
                let t;
                return function () {
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(this, arguments), delay);
                };
            }
        });
    </script>
@endpush
