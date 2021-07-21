@extends('welcome')
@section('content')
    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                From the Firehose
            </h3>

            <div class="row">
                <example-component></example-component>
            </div>
            @inject('pushall','App\Service\Pushall')



        </div>
@endsection
