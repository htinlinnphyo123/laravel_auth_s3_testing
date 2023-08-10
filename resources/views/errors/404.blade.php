<x-guest-layout>
    @if(isset($error))
        <p class="text-red-500 text-center">{{ $error }}</p>
    @else
        <p class="text-red-500 text-center">404 Not Found.</p>
    @endif
</x-guest-layout>