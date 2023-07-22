@props([
    'type' => 'text',
    'name',
    'label',
])
<div class="form-control">
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" >
    <label for="{{ $name }}">{{ $label }}</label>
</div>
