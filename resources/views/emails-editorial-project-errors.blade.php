@component('mail::message')
# Introduction

{{$body_message}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::table')
    | Titolo       | Errori         |
    | ------------- |:-------------:|
    @foreach($data as $item)
        | {{$item['title']}}      | {{$item['errors_count']}}      |
    @endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
