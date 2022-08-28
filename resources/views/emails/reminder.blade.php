@component('mail::message')
# Introduction

The body of your message.

@component('mail::table')
    |Task title|Task description|Task description|
    |:--------|:--------|:--------|
    @foreach($reminders as $reminder)
        |{{$reminder['title']}}|{{$reminder['description']}}|{{$reminder['deadline']}}
    @endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
