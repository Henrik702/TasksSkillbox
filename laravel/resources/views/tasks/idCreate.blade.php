@extends('welcome')
@section('content')
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Задачи
            </h3>
              <h4>id->{{$task->id}}</h4>{{$task->title}}
              <h2>{{$task->body}}</h2>
            @include('tasks.akcia',['names' => $task->names])
            @include('loaut.errors')
            <ul class="list-group">

            @foreach($task->box as $box)
               <li class="list-group-item">
                   <form action="{{ url('/boxes/'.$box->id) }}" method="POST">
                        @method('PATCH')
                       @csrf
                       <div class="form-check">
                           <label class="form-check-label">
                               <input
                                   class="form-check-label"
                                   name="completed"
                                   type="checkbox"
                                   onclick="this.form.submit()"
                                   {{ $box->completed ? 'checked' : '' }}
                               >
                               Завершенный ։   {{ $box->description }}
                           </label>
                       </div>
                   </form>
                 </li>
             </ul>
            @endforeach

            <form  class="card card-body mb-4" action="{{ url('/boxes') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text"
                           class="form-control"
                           placeholder="добавить описание"
                           value="{{ old('description') }}"
                           name="description"
                    >
                    <input type="hidden" value="{{ $task->id }}" name="task_id">
                    <button type="submit" class="btn btn-primary">Добавить</button>

                </div>
            </form>



            <br>
            @forelse($task->history as $item)
                <p>{{ $item->email }} - {{ $item->pivot->created_at->diffForHumans()}} - {{ $item->pivot->befor }} - {{ $item->pivot->after }} </p>
            @empty
                <p>Нет изменени</p>
            @endforelse


            @can('blok')
            <a href="{{ url('/tasks/'.$task->id.'/edit') }}"><div class="btn btn-primary">Изменить</div></a>
            @endcan
        </div>
@endsection
