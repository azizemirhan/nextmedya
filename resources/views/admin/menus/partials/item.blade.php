<li class="menu-item" data-id="{{ $item->id }}">
    <div class="menu-item-header">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-grip-vertical text-muted"></i>
            {{-- Başlığı mevcut dile göre göster --}}
            <span class="title">{{ $item->getTranslation('title', app()->getLocale()) }}</span>
        </div>
        <div class="btn-group btn-group-sm">
            <button class="btn btn-outline-secondary btn-toggle" type="button">Düzenle</button>
            <button class="btn btn-outline-danger btn-delete" type="button">Sil</button>
        </div>
    </div>
    <div class="menu-item-body collapse">
        <div class="p-3 border-top">
            <div class="row g-3">
                {{-- === DİNAMİK DİL SEKMELERİ BAŞLANGIÇ === --}}
                <div class="col-12">
                    <label class="form-label">Başlık</label>
                    <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                        @foreach($activeLanguages as $code => $lang)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        data-bs-toggle="tab"
                                        data-bs-target="#edit-item-{{$item->id}}-{{$code}}"
                                        type="button">{{ strtoupper($code) }}</button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content mt-2">
                        @foreach($activeLanguages as $code => $lang)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                 id="edit-item-{{$item->id}}-{{$code}}"
                                 role="tabpanel">
                                <input type="text"
                                       class="form-control input-title"
                                       data-lang="{{ $code }}"
                                       value="{{ $item->getTranslation('title', $code) }}"
                                       placeholder="Başlık ({{ strtoupper($code) }})">
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- === DİNAMİK DİL SEKMELERİ BİTİŞ === --}}

                <div class="col-md-12">
                    <label class="form-label">URL</label>
                    <input type="text" class="form-control input-url" value="{{ $item->url }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Target</label>
                    <select class="form-select input-target">
                        <option value="_self" @selected($item->target === '_self')>_self</option>
                        <option value="_blank" @selected($item->target === '_blank')>_blank</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">CSS Class</label>
                    <input type="text" class="form-control input-classes" value="{{ $item->classes }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Rel</label>
                    <input type="text" class="form-control input-rel" value="{{ $item->rel }}">
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button class="btn btn-primary btn-save" type="button">Kaydet</button>
                <button class="btn btn-outline-secondary btn-toggle" type="button">Kapat</button>
            </div>
        </div>
    </div>
    @if($item->children->count())
        <div class="submenu-dropzone">alt menü buraya yükleyin</div>
        <ul class="menu-children list-unstyled">
            @foreach($item->children as $child)
                @include('admin.menus.partials.item', ['item' => $child])
            @endforeach
        </ul>
    @else
        <div class="submenu-dropzone">alt menü buraya yükleyin</div>
        <ul class="menu-children list-unstyled"></ul>
    @endif
</li>
