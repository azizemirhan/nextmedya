{{-- resources/views/admin/pages/partials/_input_element.blade.php --}}
@php
    $dataAttrs = 'data-name="' . $field['name'] . '"' . ($lang ? ' data-lang="' . $lang . '"' : '');
    // Value'yu kontrol et - eğer dizi ise boş string kullan
    $value = '';
    if (isset($field['value'])) {
        $value = is_array($field['value']) ? '' : $field['value'];
    }
@endphp

@if($field['type'] === 'textarea')
    <div class="quill-editor-wrapper">
        <div class="quill-editor">{!! $value ?? '' !!}</div>
        <input type="hidden" {!! $dataAttrs !!}>
    </div>
@elseif($field['type'] === 'file')
    <input type="file" class="form-control" {!! $dataAttrs !!}>
@elseif($field['type'] === 'select' && isset($field['options']))
    <select class="form-select" {!! $dataAttrs !!}>
        @foreach($field['options'] as $val => $label)
            <option value="{{ $val }}">{{ $label }}</option>
        @endforeach
    </select>
@else
    <input type="{{ $field['type'] }}" class="form-control" {!! $dataAttrs !!} value="{{ $value }}">
@endif
