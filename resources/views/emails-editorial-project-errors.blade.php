@component('mail::message')
# Introduction

{{$body_message}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::table')
| Progetto Editoriale             | Errori   |
| ------------------------------- | --------:|
@foreach ($editorial_projects as $editorial_project)

| {{$editorial_project->title}} | {{$editorial_project->error}} |

@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
