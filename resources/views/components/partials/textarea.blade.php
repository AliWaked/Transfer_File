@props(['name', 'label'])

<div class="form-control">
    <textarea name="{{ $name }}" id="{{ $name }}"></textarea>
    <label for="{{ $name }}">{{ $label }}</label>
</div>
