@props(['name', 'label'])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea class="form-control" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>
        {{ $slot }}
    </textarea>
</div>
