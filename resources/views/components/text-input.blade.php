@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}  {!! $attributes->merge(['class' => 'form-control rounded']) !!} style="border-color: #B2BABB">
