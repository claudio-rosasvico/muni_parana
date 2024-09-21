@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }}  {!! $attributes->merge(['class' => 'form-control rounded']) !!}>{{ $slot }}</select>
