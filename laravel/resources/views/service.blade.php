@extends('welcome')

@section('content')
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Отправить Уведомление
            </h3>
            @include('loaut.errors')
            <form action="{{ url('/service') }}" method="Post">
                @csrf

                <div class="mb-3">
                    <label for="inputTitle">Заголовок Уведомления</label>
                    <input class="form-control" id="inputTitle" placeholder="Заголовок" name="title">
                </div>
                <div class="mb-3">
                    <label for="inputText">Текст уведомления</label>
                    <input  class="form-control" id="inputText" placeholder="Текст" name="text">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
@endsection
