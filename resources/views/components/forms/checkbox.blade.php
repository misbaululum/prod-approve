@props(['checked' => false, 'name'])

<div class="form-check">
    <input type="checkbox" name="{{ $name }}" {{ $checked ? 'checked' : '' }} class="form-check-input">
    <label class="form-check-label" for="{{ $name }}">{{ $slot }}</label>
</div>
