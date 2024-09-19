<x-mail::message>
    # New Contact
    ## Name: {{$contactData['name']}}

    ## Email: {{$contactData['email']}}

    ## Message
    {{$contactData['message']}}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
