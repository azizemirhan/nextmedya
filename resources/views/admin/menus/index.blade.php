@extends('admin.layouts.master')

@section('title', 'Menü Yönetimi')

@section('content')
    <div class="container-fluid py-3">
        <div class="row g-3">
            {{-- SOL SÜTUN: Menü Ekle + Sayfa Kartları (draggable) --}}
            <div class="col-lg-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light fw-semibold">Menü Bilgisi</div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label">Aktif Menü</label>
                            <select id="menuSelect" class="form-select">
                                @foreach($menus as $m)
                                    @php
                                        $mName = is_array($m->name) ? ($m->name[app()->getLocale()] ?? reset($m->name)) : $m->name;
                                    @endphp
                                    <option value="{{ $m->id }}" @selected($m->id === $menu->id)>{{ $mName }} ({{ $m->slug }})</option>
                                    {{ $mName }} ({{ $m->slug }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Farklı menü seçtiğinde sayfa o menüyle yeniden yüklenir.</div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Konum (Header/Footer)</label>
                            <select id="menuPlacement" class="form-select">
                                <option value="header" @selected($menu->placement === 'header')>Header</option>
                                <option value="footer" @selected($menu->placement === 'footer')>Footer</option>
                                <option value="both"   @selected($menu->placement === 'both')>Header + Footer</option>
                                <option value="none"   @selected($menu->placement === 'none')>Hiçbiri</option>
                            </select>
                            <div class="form-text">Temada hangi bölgede kullanılacağını işaretle.</div>
                        </div>

                        <div class="text-muted small">Slug: <code>{{ $menu->slug }}</code></div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                        <span class="fw-semibold">Sayfalar</span>
                        <div class="w-50">
                            <input id="pageSearch" type="search" class="form-control form-control-sm" placeholder="Ara...">
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div id="pageCards" class="d-grid gap-2">
                            {{-- AJAX ile doldurulacak. Her kart draggable olacak. --}}
                        </div>
                        <div class="small text-muted mt-2">Kartı sağdaki tuvale sürükleyip bırakın.</div>
                    </div>
                </div>
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                        <span class="fw-semibold">Hizmetler</span>
                        <div class="w-50">
                            <input id="serviceSearch" type="search" class="form-control form-control-sm"
                                   placeholder="Ara...">
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div id="serviceCards" class="d-grid gap-2">
                            {{-- AJAX ile doldurulacak. Her kart draggable olacak. --}}
                        </div>
                        <div class="small text-muted mt-2">Hizmet kartını sağdaki tuvale sürükleyip bırakın.</div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light fw-semibold">Özel Menü Öğesi</div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label">Başlık ({{ strtoupper(app()->getLocale()) }})</label>
                            <input type="text" id="customTitle" class="form-control" placeholder="Örn: İletişim">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">URL</label>
                            <input type="text" id="customUrl" class="form-control" placeholder="/iletisim veya https://...">
                        </div>
                        <button id="addCustomItem" class="btn btn-primary w-100">Ekle (Köke)</button>
                        <div class="form-text">Eklendikten sonra sağda sürükleyip yerleştirebilirsiniz.</div>
                    </div>
                </div>

            </div>

            {{-- SAĞ SÜTUN: Menü Tuvali (Sortable, nested) --}}
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                        <span class="fw-semibold">Menü Öğeleri</span>
                        <div class="d-flex gap-2">
                            <button id="newMenuBtn" class="btn btn-sm btn-success">Yeni Menü Ekle</button>
                            <button id="deleteMenuBtn" class="btn btn-sm btn-outline-danger">Menüyü Sil</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul id="menuRoot" class="menu-root list-unstyled">
                            @foreach($menu->items()->whereNull('parent_id')->get() as $item)
                                @include('admin.menus.partials.item', ['item' => $item])
                            @endforeach
                        </ul>
                        <div class="text-muted small">Alt menü oluşturmak için bir öğeyi diğerinin ALTINA doğru sürükleyin. Vurgulu alan görünür.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Yeni Menü Modal --}}
    <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="createMenuForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuLabel">Yeni Menü Oluştur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Menü Adı</label>
                        <input type="text" name="name" class="form-control" placeholder="Örn: Ana Menü" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug (opsiyonel)</label>
                        <input type="text" name="slug" class="form-control" placeholder="örn: main-menu">
                        <div class="form-text">Boş bırakırsan isimden otomatik oluşturulur.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konum</label>
                        <select name="placement" class="form-select" required>
                            <option value="header">Header</option>
                            <option value="footer">Footer</option>
                            <option value="both">Header + Footer</option>
                            <option value="none">Hiçbiri</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Vazgeç</button>
                    <button class="btn btn-success" type="submit">Oluştur</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('styles')
    <style>
        /* Tuval genel stil */
        .menu-root li { margin-bottom: .5rem; }
        .menu-item { border:1px solid #e5e7eb; border-radius:.5rem; background:#fff; }
        .menu-item-header { cursor: pointer; user-select:none; display:flex; align-items:center; justify-content:space-between; padding:.5rem .75rem; }
        .menu-item-header:hover { background:#f8f9fa; }
        .menu-children { margin: .5rem .75rem .75rem 1.25rem; padding-left:.75rem; border-left:2px dashed #e5e7eb; }

        /* Drag hedefi vurgusu */
        .drop-as-child { background: #f3f9ff; border-color:#86b7fe !important; box-shadow: inset 0 0 0 2px rgba(13,110,253,.1); }

        /* Sayfa kartları */
        .page-card { border:1px solid #e5e7eb; border-radius:.5rem; padding:.5rem .75rem; background:#fff; }
        .page-card .title { font-weight:600; }
        .page-card .slug { font-size:.8rem; color:#6c757d; }

        /* Konteyner hazırlığı */
        .menu-item { position: relative; }

        /* Drop zone gizli; yalnızca hover hedefinde görünür */
        .submenu-dropzone{
            display: none;
            margin: .5rem .75rem .75rem 1.25rem;  /* header'dan sonra, children alanında */
            min-height: 48px;
            padding: .75rem;
            border: 2px dotted rgba(25,135,84,.65);          /* success green dotted */
            background: rgba(25,135,84,.10);                 /* transparan yeşil */
            color: #198754;                                   /* success metin */
            border-radius: .5rem;                             /* köşeler */
            font-weight: 600;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            user-select: none;
            pointer-events: none;                             /* drop'u engellemesin */
        }

        /* Hedef li aktifken göster */
        .menu-item.drop-as-child > .submenu-dropzone{
            display: flex;
        }

        /* (İsteğe bağlı) hedef li'nin çerçevesini de yumuşakça vurgula */
        .menu-item.drop-as-child{
            background: rgba(25,135,84,.04);
            border-color: rgba(25,135,84,.35) !important;
        }

        .service-card {
            border: 1px solid #e5e7eb;
            border-radius: .5rem;
            padding: .5rem .75rem;
            background: #f8f9ff; /* Sayfalardan ayırt etmek için hafif mavi */
            border-color: #c7d2fe;
        }

        .service-card .title {
            font-weight: 600;
            color: #4338ca; /* Mavi ton */
        }

        .service-card .slug {
            font-size: .8rem;
            color: #6366f1;
        }

        .service-card:hover {
            background: #eef2ff;
            border-color: #a5b4fc;
        }

    </style>
@endpush
@push('scripts')
    <script>
        (function() {
            function debounce(fn, wait) {
                let t;
                return function () {
                    const c = this, a = arguments;
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(c, a), wait);
                };
            }

            function escapeHtml(s) {
                return String(s ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
            }


            const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const menuId = {{ $menu->id }};
            const CURRENT_LOCALE = @json(app()->getLocale());
            const ACTIVE_LANGUAGES = @json(config('app.active_languages', ['tr' => 'Türkçe', 'en' => 'English']));
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': CSRF } });

            // Sortable Variables
            let leftSortable, servicesSortable;

            // Header için locale'e göre başlık çöz
            function resolveTitleForHeader(titleField) {
                if (titleField && typeof titleField === 'object') {
                    return titleField[CURRENT_LOCALE] || Object.values(titleField)[0] || 'Untitled';
                }
                return titleField || 'Untitled';
            }

            // Sayfa kartlarını yükle
            function loadPages(q = '') {
                $.get("{{ route('admin.menus.pages') }}", { q }, function(list) {
                    const $wrap = $('#pageCards').empty();
                    list.forEach(p => {
                        const $card = $(`
                            <div class="page-card" data-page-id="${p.id}"
                                 data-title="${escapeHtml(p.title)}"
                                 data-url="${escapeHtml(p.url)}">
                                <div class="title">${escapeHtml(p.title)}</div>
                                <div class="slug">/${escapeHtml(p.slug)}</div>
                            </div>
                        `);
                        $wrap.append($card);
                    });
                    mountLeftSortable();
                }).fail(function(e) {
                    console.error('LOAD_PAGES_ERROR', e);
                });
            }

            // Hizmet kartlarını yükle
            function loadServices(q = '') {
                $.get("{{ route('admin.menus.services') }}", { q }, function(list) {
                    const $wrap = $('#serviceCards').empty();
                    list.forEach(s => {
                        const $card = $(`
                            <div class="service-card" data-service-id="${s.id}"
                                 data-title="${escapeHtml(s.title)}"
                                 data-url="${escapeHtml(s.url)}">
                                <div class="title">${escapeHtml(s.title)}</div>
                                <div class="slug">/services/${escapeHtml(s.slug)}</div>
                            </div>
                        `);
                        $wrap.append($card);
                    });
                    mountLeftSortable();
                }).fail(function(e) {
                    console.error('LOAD_SERVICES_ERROR', e);
                });
            }

            // Arama işlevleri
            $('#pageSearch').on('input', debounce(function() {
                loadPages($(this).val());
            }, 250));

            $('#serviceSearch').on('input', debounce(function() {
                loadServices($(this).val());
            }, 250));

            // Sol: kartlar sortable (pull: clone)
            function mountLeftSortable() {
                // Pages sortable
                if (leftSortable) leftSortable.destroy();
                const pageCardsEl = document.getElementById('pageCards');
                if (pageCardsEl) {
                    leftSortable = new Sortable(pageCardsEl, {
                        group: { name: 'menus', pull: 'clone', put: false },
                        sort: false,
                        draggable: '.page-card',
                        animation: 150,
                        fallbackOnBody: true,
                        swapThreshold: 0.65
                    });
                }

                // Services sortable
                if (servicesSortable) servicesSortable.destroy();
                const serviceCardsEl = document.getElementById('serviceCards');
                if (serviceCardsEl) {
                    servicesSortable = new Sortable(serviceCardsEl, {
                        group: { name: 'menus', pull: 'clone', put: false },
                        sort: false,
                        draggable: '.service-card',
                        animation: 150,
                        fallbackOnBody: true,
                        swapThreshold: 0.65
                    });
                }
            }

            // Menü değişince sayfayı seçime göre yükle
            $(document).on('change', '#menuSelect', function() {
                const id = this.value;
                if (id) {
                    window.location = "{{ route('admin.menus.index') }}?menu=" + encodeURIComponent(id);
                }
            });

            // Menü silme
            $(document).on('click', '#deleteMenuBtn', async function() {
                const id = $('#menuSelect').val();
                if (!id) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Önce bir menü seçin',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }

                const result = await Swal.fire({
                    title: 'Emin misiniz?',
                    text: 'Seçili menüyü silmek istediğinize emin misiniz? Bu işlem geri alınamaz.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Evet, sil!',
                    cancelButtonText: 'Vazgeç'
                });

                if (!result.isConfirmed) return;

                const $btn = $(this).prop('disabled', true).text('Siliniyor...');

                try {
                    const res = await $.ajax({
                        url: "{{ url('/admin/menus') }}/" + encodeURIComponent(id),
                        type: 'DELETE'
                    });

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Menü silindi',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    setTimeout(() => {
                        window.location = res.redirect || "{{ route('admin.menus.index') }}";
                    }, 1000);

                } catch (e) {
                    console.error('DELETE_MENU_ERROR', e);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: e?.responseJSON?.message || 'Menü silinemedi',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } finally {
                    $btn.prop('disabled', false).text('Menüyü Sil');
                }
            });

            // Placement değişimini anlık kaydet
            $(document).on('change', '#menuPlacement', function() {
                const placement = this.value;
                $.post("{{ route('admin.menus.placement', ['menu' => $menu->id]) }}", {
                    placement: placement
                }).done(function() {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Konum güncellendi',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).fail(function(e) {
                    console.error('PLACEMENT_ERROR', e);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Konum güncellenemedi',
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
            });

            // Yeni menü modal
            let newMenuModal;
            $(document).on('click', '#newMenuBtn', function() {
                newMenuModal = new bootstrap.Modal(document.getElementById('newMenuModal'));
                newMenuModal.show();
            });

            // Yeni Menü form submit
            $(document).on('submit', '#createMenuForm', async function(e) {
                e.preventDefault();
                const form = this;
                const payload = {
                    name: form.name.value.trim(),
                    slug: form.slug.value.trim() || null,
                    placement: form.placement.value
                };

                if (!payload.name) {
                    form.name.focus();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Menü adı gerekli',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }

                try {
                    const res = await $.post("{{ route('admin.menus.store') }}", payload);

                    if (newMenuModal) newMenuModal.hide();

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Menü oluşturuldu',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    setTimeout(() => {
                        window.location = "{{ route('admin.menus.index') }}?menu=" + encodeURIComponent(res.menu.id);
                    }, 1000);

                } catch (err) {
                    console.error('CREATE_MENU_ERROR', err);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: err?.responseJSON?.message || 'Menü oluşturulamadı',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });

            // renderMenuItem fonksiyonu
            function renderMenuItem(item) {
                const headerTitle = escapeHtml(resolveTitleForHeader(item.title));
                const url = escapeHtml(item.url || '');
                const target = item.target === '_blank' ? '_blank' : '_self';
                const classes = escapeHtml(item.classes || '');
                const rel = escapeHtml(item.rel || '');

                // Dil sekmeleri oluştur
                let tabsHtml = '<ul class="nav nav-tabs nav-tabs-sm" role="tablist">';
                let tabContentHtml = '<div class="tab-content mt-2">';

                let firstLang = true;
                Object.entries(ACTIVE_LANGUAGES).forEach(([code, langName]) => {
                    const isActive = firstLang ? 'active' : '';
                    const showActive = firstLang ? 'show active' : '';
                    const titleValue = (item.title && typeof item.title === 'object')
                        ? escapeHtml(item.title[code] || '')
                        : (firstLang ? headerTitle : '');

                    tabsHtml += `
            <li class="nav-item" role="presentation">
                <button class="nav-link ${isActive}" data-bs-toggle="tab"
                        data-bs-target="#item-${item.id}-lang-${code}" type="button">
                    ${code.toUpperCase()}
                </button>
            </li>`;

                    tabContentHtml += `
            <div class="tab-pane fade ${showActive}" id="item-${item.id}-lang-${code}" role="tabpanel">
                <input type="text" class="form-control input-title"
                       data-lang="${code}" value="${titleValue}">
            </div>`;

                    firstLang = false;
                });

                tabsHtml += '</ul>';
                tabContentHtml += '</div>';

                const $li = $(`
      <li class="menu-item" data-id="${item.id}">
        <div class="menu-item-header">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-grip-vertical text-muted"></i>
            <span class="title">${headerTitle}</span>
          </div>
          <div class="btn-group btn-group-sm">
            <button class="btn btn-outline-secondary btn-toggle" type="button">Düzenle</button>
            <button class="btn btn-outline-danger btn-delete" type="button">Sil</button>
          </div>
        </div>
        <div class="menu-item-body collapse">
          <div class="p-3 border-top">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Başlık</label>
                ${tabsHtml}
                ${tabContentHtml}
              </div>
              <div class="col-md-12">
                <label class="form-label">URL</label>
                <input type="text" class="form-control input-url" value="${url}">
              </div>
              <div class="col-md-4">
                <label class="form-label">Target</label>
                <select class="form-select input-target">
                  <option value="_self" ${target === '_self' ? 'selected' : ''}>_self</option>
                  <option value="_blank" ${target === '_blank' ? 'selected' : ''}>_blank</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">CSS Class</label>
                <input type="text" class="form-control input-classes" value="${classes}">
              </div>
              <div class="col-md-4">
                <label class="form-label">Rel</label>
                <input type="text" class="form-control input-rel" value="${rel}">
              </div>
            </div>
            <div class="mt-3 d-flex gap-2">
              <button class="btn btn-primary btn-save" type="button">Kaydet</button>
              <button class="btn btn-outline-secondary btn-toggle" type="button">Kapat</button>
            </div>
          </div>
        </div>
        <div class="submenu-dropzone">alt menü buraya yükleyin</div>
        <ul class="menu-children list-unstyled"></ul>
      </li>
    `);
                return $li;
            }

            // Sağ: nested sortable
            function mountNode($ul) {
                const ulElement = $ul[0];
                if (!ulElement) return;

                new Sortable(ulElement, {
                    group: { name: 'menus', pull: true, put: true },
                    draggable: '> li',
                    handle: '.menu-item-header',
                    animation: 150,

                    onAdd: async function(evt) {
                        const el = evt.item;

                        // Sayfa kartından mı geldi?
                        if (el.classList.contains('page-card')) {
                            const pageId = el.getAttribute('data-page-id');
                            const title  = el.getAttribute('data-title');
                            const url    = el.getAttribute('data-url');

                            const parentLi = $ul.closest('li.menu-item');
                            const parentId = parentLi.length ? parentLi.data('id') : null;

                            const titleObj = {};
                            titleObj[CURRENT_LOCALE] = title;

                            try {
                                const res = await $.post("{{ route('admin.menus.items.store') }}", {
                                    menu_id:  menuId,
                                    parent_id: parentId,
                                    title:    titleObj,
                                    url:      url,
                                    page_id:  pageId
                                });

                                const item = res.item;
                                const $li = renderMenuItem(item);
                                $(el).replaceWith($li[0]);
                                mountNode($li.children('ul.menu-children'));
                                serializeAndSync();

                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Sayfa menüye eklendi',
                                    showConfirmButton: false,
                                    timer: 2000
                                });

                            } catch (e) {
                                console.error('STORE_PAGE_ERROR', e);
                                $(el).remove();
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Sayfa eklenemedi',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        }
                        // Hizmet kartından mı geldi?
                        else if (el.classList.contains('service-card')) {
                            const serviceId = el.getAttribute('data-service-id');
                            const title     = el.getAttribute('data-title');
                            const url       = el.getAttribute('data-url');

                            const parentLi = $ul.closest('li.menu-item');
                            const parentId = parentLi.length ? parentLi.data('id') : null;

                            const titleObj = {};
                            titleObj[CURRENT_LOCALE] = title;

                            try {
                                const res = await $.post("{{ route('admin.menus.items.store') }}", {
                                    menu_id:   menuId,
                                    parent_id: parentId,
                                    title:     titleObj,
                                    url:       url,
                                    service_id: serviceId
                                });

                                const item = res.item;
                                const $li = renderMenuItem(item);
                                $(el).replaceWith($li[0]);
                                mountNode($li.children('ul.menu-children'));
                                serializeAndSync();

                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Hizmet menüye eklendi',
                                    showConfirmButton: false,
                                    timer: 2000
                                });

                            } catch (e) {
                                console.error('STORE_SERVICE_ERROR', e);
                                $(el).remove();
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Hizmet eklenemedi',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        } else {
                            serializeAndSync();
                        }
                    },

                    onMove: function(evt) {
                        const $targetLi = $(evt.to).closest('li.menu-item');
                        $('.menu-item').removeClass('drop-as-child');
                        if ($targetLi.length) $targetLi.addClass('drop-as-child');
                    },

                    onStart: function() {
                        $('body').addClass('dragging');
                    },

                    onEnd: function() {
                        $('body').removeClass('dragging');
                        $('.menu-item').removeClass('drop-as-child');
                        serializeAndSync();
                    },

                    onChoose: function() {
                        $('.menu-item').removeClass('drop-as-child');
                    },

                    onUnchoose: function() {
                        $('.menu-item').removeClass('drop-as-child');
                    }
                });
            }

            function mountAllSortables() {
                $('#menuRoot, #menuRoot .menu-children').each(function() {
                    mountNode($(this));
                });
            }

            // Toggle/Save/Delete event handlers
            $(document)
                .on('click', '.menu-item .btn-toggle, .menu-item .menu-item-header', function(e) {
                    if ($(e.target).is('.btn-delete')) return;
                    const $li = $(this).closest('.menu-item');
                    $li.find('> .menu-item-body').collapse('toggle');
                })
                .on('click', '.menu-item .btn-save', async function () {
                    const $li = $(this).closest('.menu-item');
                    const id = $li.data('id');

                    // TÜM dillerdeki başlıkları topla
                    const titleObj = {};
                    $li.find('> .menu-item-body .input-title').each(function () {
                        const lang = $(this).data('lang');
                        const val = $(this).val().trim();
                        if (lang) {
                            titleObj[lang] = val;
                        }
                    });

                    console.log('Saving item:', id, 'Titles:', titleObj); // Debug için

                    const payload = {
                        title: titleObj,
                        url: $li.find('.input-url').val(),
                        target: $li.find('.input-target').val(),
                        classes: $li.find('.input-classes').val(),
                        rel: $li.find('.input-rel').val(),
                        _method: 'PUT'
                    };

                    try {
                        const response = await $.post(`{{ url('/admin/menus/items') }}/${id}`, payload);
                        console.log('Update response:', response); // Debug için

                        // Başlığı güncelle (mevcut dil)
                        const currentTitle = titleObj[CURRENT_LOCALE] || Object.values(titleObj)[0] || 'Untitled';
                        $li.find('> .menu-item-header .title').text(currentTitle);
                        $li.find('> .menu-item-body').collapse('hide');

                        // Başarı mesajı (opsiyonel)
                        alert('Menü öğesi başarıyla güncellendi!');
                    } catch (e) {
                        console.error('UPDATE_ERROR', e);
                        alert('Güncelleme başarısız: ' + (e.responseJSON?.message || 'Bilinmeyen hata'));
                    }
                })
                .on('click', '.menu-item .btn-delete', async function() {
                    const result = await Swal.fire({
                        title: 'Emin misiniz?',
                        text: 'Bu menü öğesini silmek istediğinize emin misiniz?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Evet, sil!',
                        cancelButtonText: 'Vazgeç'
                    });

                    if (!result.isConfirmed) return;

                    const $li = $(this).closest('.menu-item');
                    const id = $li.data('id');
                    const $deleteBtn = $(this).prop('disabled', true).text('Siliniyor...');

                    try {
                        await $.ajax({
                            url: `{{ url('/admin/menus/items') }}/${id}`,
                            type: 'DELETE'
                        });

                        $li.remove();
                        serializeAndSync();

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Menü öğesi silindi',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });

                    } catch (e) {
                        console.error('DELETE_ERROR', e);
                        $deleteBtn.prop('disabled', false).text('Sil');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: e?.responseJSON?.message || 'Silme hatası',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });

            // Custom item ekle (köke)
            $('#addCustomItem').on('click', async function() {
                const titleVal = $('#customTitle').val().trim();
                if (!titleVal) {
                    $('#customTitle').focus();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Başlık alanı gerekli',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }
                const urlVal = $('#customUrl').val().trim();

                const titleObj = {};
                titleObj[CURRENT_LOCALE] = titleVal;

                const $addBtn = $(this).prop('disabled', true).text('Ekleniyor...');

                try {
                    const res = await $.post("{{ route('admin.menus.items.store') }}", {
                        menu_id:  menuId,
                        parent_id: null,
                        title:    titleObj,
                        url:      urlVal || null,
                        page_id:  null,
                        service_id: null
                    });

                    const item = res.item;
                    const $li = renderMenuItem(item);
                    $('#menuRoot').append($li);
                    mountNode($li.children('ul.menu-children'));
                    $('#customTitle').val('');
                    $('#customUrl').val('');
                    serializeAndSync();

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Özel menü öğesi eklendi',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });

                } catch (e) {
                    console.error('CUSTOM_ADD_ERROR', e);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: e?.responseJSON?.message || 'Ekleme hatası',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } finally {
                    $addBtn.prop('disabled', false).text('Ekle (Köke)');
                }
            });

            // Serialize ve senkronizasyon fonksiyonları
            function serializeTree() {
                const flat = [];
                function walk($ul, parentId = null) {
                    $ul.children('li').each(function(index) {
                        const id = $(this).data('id');
                        if (id) {
                            flat.push({
                                id: id,
                                parent_id: parentId,
                                order: index + 1
                            });
                            walk($(this).children('ul.menu-children'), id);
                        }
                    });
                }
                walk($('#menuRoot'));
                return flat;
            }

            async function serializeAndSync() {
                try {
                    const items = serializeTree();
                    if (items.length > 0) {
                        await $.post("{{ route('admin.menus.update') }}", { items: items });
                    }
                } catch (e) {
                    console.error('SYNC_ERROR', e);
                }
            }

            // Başlangıç işlemleri
            $(document).ready(function() {
                mountAllSortables();
                loadPages();
                loadServices();

                // Tüm collapse elementlerini Bootstrap ile başlat
                $('.collapse').each(function() {
                    new bootstrap.Collapse(this, {
                        toggle: false
                    });
                });
            });

            // Admin Menü Yönetimi - Mega Menu Desteği
// Bu kodu mevcut admin/menus/index.blade.php içindeki script bölümüne ekleyin

// Mega Menu toggle fonksiyonality
            $(document).on('change', '.input-is-mega-menu', function() {
                const $li = $(this).closest('.menu-item');
                const $megaFields = $li.find('> .menu-item-body .mega-menu-fields');

                if ($(this).is(':checked')) {
                    $megaFields.slideDown();
                    $li.attr('data-is-mega', '1');
                    $li.find('> .menu-item-header .title').before('<span class="badge bg-primary me-2">MEGA</span>');
                } else {
                    $megaFields.slideUp();
                    $li.attr('data-is-mega', '0');
                    $li.find('> .menu-item-header .badge').remove();
                }
            });

// renderMenuItem fonksiyonunu güncelle (mega menu desteği ile)
            function renderMenuItem(item) {
                const headerTitle = escapeHtml(resolveTitleForHeader(item.title));
                const url = escapeHtml(item.url || '');
                const target = item.target === '_blank' ? '_blank' : '_self';
                const classes = escapeHtml(item.classes || '');
                const rel = escapeHtml(item.rel || '');
                const isMega = item.is_mega_menu ? true : false;
                const icon = escapeHtml(item.icon || '');
                const columnWidth = item.column_width || 1;

                // Başlık sekmeleri
                let tabsHtml = '<ul class="nav nav-tabs nav-tabs-sm" role="tablist">';
                let tabContentHtml = '<div class="tab-content mt-2">';

                // Açıklama sekmeleri (mega menu için)
                let descTabsHtml = '<ul class="nav nav-tabs nav-tabs-sm" role="tablist">';
                let descTabContentHtml = '<div class="tab-content mt-2">';

                let firstLang = true;
                Object.entries(ACTIVE_LANGUAGES).forEach(([code, langName]) => {
                    const isActive = firstLang ? 'active' : '';
                    const showActive = firstLang ? 'show active' : '';
                    const titleValue = (item.title && typeof item.title === 'object')
                        ? escapeHtml(item.title[code] || '')
                        : (firstLang ? headerTitle : '');
                    const descValue = (item.description && typeof item.description === 'object')
                        ? escapeHtml(item.description[code] || '')
                        : '';

                    // Başlık sekmeleri
                    tabsHtml += `
            <li class="nav-item" role="presentation">
                <button class="nav-link ${isActive}" data-bs-toggle="tab"
                        data-bs-target="#item-${item.id}-lang-${code}" type="button">
                    ${code.toUpperCase()}
                </button>
            </li>`;

                    tabContentHtml += `
            <div class="tab-pane fade ${showActive}" id="item-${item.id}-lang-${code}" role="tabpanel">
                <input type="text" class="form-control input-title"
                       data-lang="${code}" value="${titleValue}">
            </div>`;

                    // Açıklama sekmeleri
                    descTabsHtml += `
            <li class="nav-item" role="presentation">
                <button class="nav-link ${isActive}" data-bs-toggle="tab"
                        data-bs-target="#item-desc-${item.id}-lang-${code}" type="button">
                    ${code.toUpperCase()}
                </button>
            </li>`;

                    descTabContentHtml += `
            <div class="tab-pane fade ${showActive}" id="item-desc-${item.id}-lang-${code}" role="tabpanel">
                <input type="text" class="form-control input-description"
                       data-lang="${code}" value="${descValue}">
            </div>`;

                    firstLang = false;
                });

                tabsHtml += '</ul>';
                tabContentHtml += '</div>';
                descTabsHtml += '</ul>';
                descTabContentHtml += '</div>';

                const megaBadge = isMega ? '<span class="badge bg-primary me-2">MEGA</span>' : '';
                const iconHtml = icon ? `<i class="${icon} me-1"></i>` : '';
                const megaFieldsDisplay = isMega ? 'block' : 'none';

                const $li = $(`
<li class="menu-item" data-id="${item.id}" data-is-mega="${isMega ? '1' : '0'}">
    <div class="menu-item-header">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-grip-vertical text-muted"></i>
            ${megaBadge}
            ${iconHtml}
            <span class="title">${headerTitle}</span>
        </div>
        <div class="btn-group btn-group-sm">
            <button class="btn btn-outline-secondary btn-toggle" type="button">Düzenle</button>
            <button class="btn btn-outline-danger btn-delete" type="button">Sil</button>
        </div>
    </div>
    <div class="menu-item-body collapse">
        <div class="p-3 border-top">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input input-is-mega-menu"
                               type="checkbox"
                               id="mega-menu-${item.id}"
                               ${isMega ? 'checked' : ''}>
                        <label class="form-check-label" for="mega-menu-${item.id}">
                            <strong>Mega Menü</strong>
                            <small class="d-block text-muted">Alt menüleri çok kolonlu olarak göster</small>
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Başlık</label>
                    ${tabsHtml}
                    ${tabContentHtml}
                </div>

                <div class="col-12 mega-menu-fields" style="display: ${megaFieldsDisplay}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">İkon (Font Awesome)</label>
                            <input type="text" class="form-control input-icon"
                                   value="${icon}" placeholder="fas fa-box">
                            <small class="text-muted">Örn: fas fa-box, fas fa-tools</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kolon Genişliği</label>
                            <select class="form-select input-column-width">
                                <option value="1" ${columnWidth == 1 ? 'selected' : ''}>1/4 Genişlik</option>
                                <option value="2" ${columnWidth == 2 ? 'selected' : ''}>2/4 Genişlik</option>
                                <option value="3" ${columnWidth == 3 ? 'selected' : ''}>3/4 Genişlik</option>
                                <option value="4" ${columnWidth == 4 ? 'selected' : ''}>Tam Genişlik</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Açıklama (Mega Menü Kolonunda Gösterilir)</label>
                            ${descTabsHtml}
                            ${descTabContentHtml}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">URL</label>
                    <input type="text" class="form-control input-url" value="${url}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Target</label>
                    <select class="form-select input-target">
                        <option value="_self" ${target === '_self' ? 'selected' : ''}>_self</option>
                        <option value="_blank" ${target === '_blank' ? 'selected' : ''}>_blank</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">CSS Class</label>
                    <input type="text" class="form-control input-classes" value="${classes}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Rel</label>
                    <input type="text" class="form-control input-rel" value="${rel}">
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button class="btn btn-primary btn-save" type="button">Kaydet</button>
                <button class="btn btn-outline-secondary btn-toggle" type="button">Kapat</button>
            </div>
        </div>
    </div>
    <div class="submenu-dropzone">${isMega ? 'mega menü öğelerini buraya yükleyin' : 'alt menü buraya yükleyin'}</div>
    <ul class="menu-children list-unstyled"></ul>
</li>
    `);

                return $li;
            }

// Save butonuna mega menu alanlarını ekle
            $(document).on('click', '.menu-item .btn-save', async function () {
                const $li = $(this).closest('.menu-item');
                const id = $li.data('id');

                // TÜM dillerdeki başlıkları topla
                const titleObj = {};
                $li.find('> .menu-item-body .input-title').each(function () {
                    const lang = $(this).data('lang');
                    const val = $(this).val().trim();
                    if (lang) {
                        titleObj[lang] = val;
                    }
                });

                // Mega menu için açıklamaları topla
                const descObj = {};
                $li.find('> .menu-item-body .input-description').each(function () {
                    const lang = $(this).data('lang');
                    const val = $(this).val().trim();
                    if (lang) {
                        descObj[lang] = val;
                    }
                });

                const isMegaMenu = $li.find('.input-is-mega-menu').is(':checked');

                const payload = {
                    title: titleObj,
                    url: $li.find('.input-url').val(),
                    target: $li.find('.input-target').val(),
                    classes: $li.find('.input-classes').val(),
                    rel: $li.find('.input-rel').val(),
                    is_mega_menu: isMegaMenu,
                    icon: isMegaMenu ? $li.find('.input-icon').val() : null,
                    description: isMegaMenu ? descObj : null,
                    column_width: isMegaMenu ? $li.find('.input-column-width').val() : 1,
                    _method: 'PUT'
                };

                try {
                    const response = await $.post(`{{ url('/admin/menus/items') }}/${id}`, payload);

                    // Başlığı güncelle
                    const currentTitle = titleObj[CURRENT_LOCALE] || Object.values(titleObj)[0] || 'Untitled';
                    $li.find('> .menu-item-header .title').text(currentTitle);

                    // Mega badge güncelle
                    if (isMegaMenu && !$li.find('> .menu-item-header .badge').length) {
                        $li.find('> .menu-item-header .title').before('<span class="badge bg-primary me-2">MEGA</span>');
                    } else if (!isMegaMenu) {
                        $li.find('> .menu-item-header .badge').remove();
                    }

                    // İkon güncelle
                    if (response.item.icon) {
                        if (!$li.find('> .menu-item-header i:not(.bi-grip-vertical)').length) {
                            $li.find('> .menu-item-header .title').before(`<i class="${response.item.icon} me-1"></i>`);
                        } else {
                            $li.find('> .menu-item-header i:not(.bi-grip-vertical)').attr('class', response.item.icon + ' me-1');
                        }
                    } else {
                        $li.find('> .menu-item-header i:not(.bi-grip-vertical)').remove();
                    }

                    $li.find('> .menu-item-body').collapse('hide');

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Menü öğesi güncellendi',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } catch (e) {
                    console.error('UPDATE_ERROR', e);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: e.responseJSON?.message || 'Güncelleme başarısız',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });

        })();
    </script>
@endpush
