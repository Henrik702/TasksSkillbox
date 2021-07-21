@php
    $names = $names ?? collect();
@endphp

@if($names->isNotEmpty())
    @foreach($names as $name)
        <a class="badge badge-secondary" href="{{ url('/tasks/names/'.$name->getRouteKey()) }}" style="color: #BC302E">{{ $name->name }}</a>
    @endforeach
@endif

{{--{{ url('/tasks/names/'.$name->id) }}--}}

{{--@if($task->name->isNotEmpty())--}}
{{--    @foreach($task->name as $name)--}}
{{--        <a class="badge badge-secondary" href="#" style="color: #BC302E">{{ $name->name }}</a>--}}
{{--    @endforeach--}}
{{--@endif--}}



