@props([
    'type' => 'text',
    'name',
    'icon',
])

<div>
    <input type="{{ $type }}" value="{{ old($name) }}" name="{{ $name }}" {{ $attributes }}>
    <i class="{{ $icon }}"></i>
    <small>{{ $errors->first($name) }}</small>
</div>
