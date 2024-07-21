@props(['id' => 'id-select', rand(), 'label' => null])

<div class="mb-2 form-wrapper">
    @if ($label)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif  

    <select id="{{ $id }}" {{ $attributes->merge(['class' => 'form-select']) }}>
        {{ $slot }}
    </select>
</div>