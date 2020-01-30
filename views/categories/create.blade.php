@extends('main')

@section('stylesheets')

    {!! Html::style('css/parsley.css') !!}

@endsection

@section('content')

    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <h1 class="text-center">Create New Category</h1>
            <hr>

            {!! Form::open(['route' => 'categories.store', 'data-parsley-validate' => '']) !!}
                {{ Form::label('category', 'Category:') }}
                {{ Form::text('category', null, array('class' => 'form-control', 'required' => '')) }}

                {{ Form::submit('Create Category', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top: 20px;')) }}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')

    {!! Html::script('js/parsley.min.js') !!}

@endsection