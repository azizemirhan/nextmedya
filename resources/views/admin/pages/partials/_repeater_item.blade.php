@php
    // Başlık için kullanılacak alanı bul
    $itemTitle = $item['name'][app()->getLocale()] ??
                $item['title'][app()->getLocale()] ??
                $item['category_title'][app()->getLocale()] ??
                $item['service_title'][app()->getLocale()] ??
                $item['label'][app()->getLocale()] ??
                'Öğe #' . ($index + 1);
@endphp

<div class="repeater-item-accordion mb-2">
    <div class="repeater-item-header">
        <i class="bi bi-grip-vertical repeater-drag-handle" style="cursor: move;"></i>
        <button class="repeater-toggle-btn" type="button" data-bs-toggle="collapse"
                data-bs-target="#repeater-{{$section->id}}-{{$fieldName}}-{{$index}}">
            <i class="bi bi-chevron-down collapse-icon"></i>
            <span class="repeater-title">{{ $itemTitle }}</span>
        </button>
        <button type="button" class="btn-close-repeater remove-repeater-item"></button>
    </div>

    <div class="collapse" id="repeater-{{$section->id}}-{{$fieldName}}-{{$index}}">
        <div class="repeater-item-body">
            @foreach($field['fields'] as $repeaterField)
                @php
                    $repeaterFieldName = $repeaterField['name'];
                    $repeaterFieldValue = $item[$repeaterFieldName] ?? null;
                @endphp

                <div class="mb-3 field-wrapper">
                    {{-- İÇ İÇE REPEATER --}}
                    @if($repeaterField['type'] === 'repeater')
                        <label class="form-label fw-bold">{{ $repeaterField['label'] }}</label>
                        <div class="repeater-items-container sortable-repeater" data-repeater-name="{{ $repeaterFieldName }}" style="padding-left: 20px; border-left: 3px solid #e0e6ed;">
                            @if(is_array($repeaterFieldValue) && count($repeaterFieldValue) > 0)
                                @foreach($repeaterFieldValue as $subIndex => $subItem)
                                    @include('admin.pages.partials._repeater_item', [
                                        'item' => $subItem,
                                        'index' => $subIndex,
                                        'field' => $repeaterField,
                                        'section' => $section,
                                        'fieldName' => $repeaterFieldName,
                                        'activeLanguages' => $activeLanguages
                                    ])
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-success btn-sm add-repeater-item">+ Ekle</button>

                        {{-- ÇOK DİLLİ ALAN --}}
                    @elseif(isset($repeaterField['translatable']) && $repeaterField['translatable'])
                        <label class="form-label">{{ $repeaterField['label'] }}</label>
                        <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                            @foreach($activeLanguages as $code => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            data-bs-toggle="tab"
                                            data-bs-target="#repeater-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$code}}"
                                            type="button" role="tab">{{ strtoupper($code) }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-2">
                            @foreach($activeLanguages as $code => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="repeater-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$code}}"
                                     role="tabpanel">
                                    @php
                                        $val = is_array($repeaterFieldValue) ? ($repeaterFieldValue[$code] ?? '') : '';
                                    @endphp
                                    @include('admin.pages.partials._input_element', [
                                        'field' => $repeaterField,
                                        'lang' => $code,
                                        'value' => $val
                                    ])
                                </div>
                            @endforeach
                        </div>

                        {{-- TEK DİLLİ ALAN --}}
                    @else
                        <label class="form-label">{{ $repeaterField['label'] }}</label>
                        @include('admin.pages.partials._input_element', [
                            'field' => $repeaterField,
                            'lang' => null,
                                        'value' => $repeaterFieldValue
                        ])
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>