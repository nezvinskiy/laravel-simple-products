@props(['name', 'errors'])

@if ($errors->has($name))
    <div {!! $attributes->merge(['class' => 'text-sm text-red-600']) !!}>
        {{ $errors->first($name) }}
    </div>
@endif
