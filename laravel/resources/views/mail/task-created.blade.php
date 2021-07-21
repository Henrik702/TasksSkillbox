@component('mail::message')
# Название

{{ $task->title }}

@component('mail::button', ['url' => '/tasks/'.$task->id])
Смотреть
@endcomponent
{{ $task->body }}
<br>
{{ config('app.name') }}
@endcomponent

