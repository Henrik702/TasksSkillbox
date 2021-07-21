@extends('welcome')

@section('content')
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Добавить задачу
            </h3>
            @include('loaut.errors')
            <form action="{{ url('/tasks') }}" method="Post">
                @csrf

                <div class="mb-3">
                    <label for="inputTitle">Անվանում</label>
                    <input class="form-control" id="inputTitle" placeholder="Վեոնագիր" name="title">
                </div>
                <div class="mb-3">
                    <label for="inputBody">Արաջադրանք</label>
                    <input  class="form-control" id="inputBody" placeholder="Ավելացնել Արաջադրանք" name="body">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
@endsection
