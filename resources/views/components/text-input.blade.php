@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-gray-0 focus:ring-gray-0 dark:focus:ring-gray-300 rounded-md shadow-sm']) !!}>
