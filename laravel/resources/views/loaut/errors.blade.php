{{--@if($errors->isNotEmpty())--}}
{{--@foreach($errors as $error)--}}
{{--    <div class="alert alert-danger">--}}
{{--        {{ $error }}--}}
{{--    </div>--}}
{{--@endforeach--}}
{{--@endif--}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
