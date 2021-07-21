@extends('welcome')
@section('content')
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Выполнить задачи
            </h3>
            @if($tasks->isNotEmpty())
            @foreach($tasks as $task)
                    <div class="pb-4 mb-4 fst-italic border-bottom">
                        <strong>
                            <h5>
                                <h3>
                                    {{ $task->title }}
                                </h3>
                            </h5>
                        </strong>
                        <p>{{ $task->created_at->format('Y-m-d') }}</p>
                        <h5><a href="{{ url('/tasks/'.$task->id) }}">{{ $task->body }}</a></h5>
                        @include('tasks.akcia',['names' => $task->names])
                    </div>
                @endforeach
            @endif
            {{ $tasks->links() }}
            <br>
{{--            @can('blok')--}}
            <a href="{{ url('/tasks/create') }}"><div class="btn btn-primary">Добавить</div></a>
{{--            @endcan--}}
        </div>
@endsection
