<li class="menu-item" data-id="{{ $item->id }}" data-is-mega="{{ $item->is_mega_menu ? '1' : '0' }}">
    <div class="menu-item-header">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-grip-vertical text-muted"></i>
            @if($item->is_mega_menu)
                <span class="badge bg-primary me-2">MEGA</span>
            @endif
            @if($item->icon)
                <i class="{{ $item->icon }} me-1"></i>
            @endif
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
                {{-- Mega Menü Toggle --}}
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input input-is-mega-menu"
                               type="checkbox"
                               id="mega-menu-{{ $item->id }}"
                                {{ $item->is_mega_menu ? 'checked' : '' }}>
                        <label class="form-check-label" for="mega-menu-{{ $item->id }}">
                            <strong>Mega Menü</strong>
                            <small class="d-block text-muted">Alt menüleri çok kolonlu olarak göster</small>
                        </label>
                    </div>
                </div>

                {{-- Başlık (Çok Dilli) --}}
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

                {{-- Mega Menü Özel Alanları --}}
                <div class="col-12 mega-menu-fields" style="display: {{ $item->is_mega_menu ? 'block' : 'none' }}">
                    <div class="row g-3">
                        {{-- İkon --}}
                        <div class="col-md-6">
                            <label class="form-label">İkon (Font Awesome)</label>
                            <input type="text"
                                   class="form-control input-icon"
                                   value="{{ $item->icon }}"
                                   placeholder="fas fa-box">
                            <small class="text-muted">Örn: fas fa-box, fas fa-tools</small>
                        </div>

                        {{-- Kolon Genişliği --}}
                        <div class="col-md-6">
                            <label class="form-label">Kolon Genişliği</label>
                            <select class="form-select input-column-width">
                                <option value="1" {{ $item->column_width == 1 ? 'selected' : '' }}>1/4 Genişlik</option>
                                <option value="2" {{ $item->column_width == 2 ? 'selected' : '' }}>2/4 Genişlik</option>
                                <option value="3" {{ $item->column_width == 3 ? 'selected' : '' }}>3/4 Genişlik</option>
                                <option value="4" {{ $item->column_width == 4 ? 'selected' : '' }}>Tam Genişlik</option>
                            </select>
                        </div>

                        {{-- Açıklama (Çok Dilli) --}}
                        <div class="col-12">
                            <label class="form-label">Açıklama (Mega Menü Kolonunda Gösterilir)</label>
                            <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                @foreach($activeLanguages as $code => $lang)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                data-bs-toggle="tab"
                                                data-bs-target="#edit-desc-{{$item->id}}-{{$code}}"
                                                type="button">{{ strtoupper($code) }}</button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content mt-2">
                                @foreach($activeLanguages as $code => $lang)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                         id="edit-desc-{{$item->id}}-{{$code}}"
                                         role="tabpanel">
                                        <input type="text"
                                               class="form-control input-description"
                                               data-lang="{{ $code }}"
                                               value="{{ $item->getTranslation('description', $code) }}"
                                               placeholder="Kolon açıklaması ({{ strtoupper($code) }})">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Normal Menü Alanları --}}
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
        <div class="submenu-dropzone">
            @if($item->is_mega_menu)
                mega menü öğelerini buraya yükleyin
            @else
                alt menü buraya yükleyin
            @endif
        </div>
        <ul class="menu-children list-unstyled">
            @foreach($item->children as $child)
                @include('admin.menus.partials.item', ['item' => $child])
            @endforeach
        </ul>
    @else
        <div class="submenu-dropzone">
            @if($item->is_mega_menu)
                mega menü öğelerini buraya yükleyin
            @else
                alt menü buraya yükleyin
            @endif
        </div>
        <ul class="menu-children list-unstyled"></ul>
    @endif
</li>