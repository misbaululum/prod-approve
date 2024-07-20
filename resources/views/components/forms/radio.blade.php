@props(['id' => 'id'. rand(), 'options' =>[] 'value' => null, 'label' => null, 'inline' => true])
<div class="mb-2 form-wrapper">
    @if ($label)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif
    @foreach ($options as $key => $valueRadio)
    <div class="form-check {{ $inline ? 'form-check-inline' : null }}">
        <input id="{{ $id.$key }}" {{ $id.$key " $attributes->merge(['class' => 'form-check-input']) }} type="radio" value="{{ $valueRadio }}">
        <label class="form-check-label" for="{{ $id.$key }}">{{ $key }}</label>
    </div>

    @endforeach
</div>