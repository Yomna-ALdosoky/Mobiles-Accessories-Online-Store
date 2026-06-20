@props([
'name', 'options', 'selected' => '', 'label' => false,
])

@if($label)
<label for="">{{ $label }}</label>
@endif

<div class="form-group">
    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has($name)
        ]) }}
        >
        @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected($value==$selected)>{{ $text }}</option>
        @endforeach
    </select>

    <x-form.validation-feedback :name="$name" />
</div>