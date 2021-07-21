@extends('welcome')
@section('content')
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Изменить задачу
            </h3>

            <form action="{{ url('/tasks/'.$task->id) }}" method="post">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="inputTitle">Պոպոխել Անվանումը</label>
                    <input class="form-control" id="inputTitle" name="title" value=" {{ $task->title }}">
                </div>
                <div class="mb-3">
                    <label for="inputBody">Պոպոխել Արաջադրանքը</label>
                    <input  class="form-control" id="inputBody" name="body" value="{{ $task->body }}">
                </div>
                <div class="mb-3">
                    <label for="inputName">Պոպոխել Ակցիաները</label>
                    <input
                        type="text"
                        class="form-control"
                        id="inputName"
                        name="names"
                        value="{{old('names', $task->names->pluck('name')->implode(',')) }}">
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Изменить</button>
            </form>
            <form method="Post" action="{{url('/tasks/'.$task->id)}}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>


        </div>
@endsection
