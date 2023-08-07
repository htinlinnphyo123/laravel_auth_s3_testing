<x-mail::message>
# Order Shipped
 
 
<x-mail::button :url="$url">
{{ $name }} is created. do you wanna join?
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>