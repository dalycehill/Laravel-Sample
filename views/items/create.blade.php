@extends('main')

@section('stylesheets')

    {!! Html::style('css/parsley.css') !!}

@endsection

@section('content')

    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <h1 class="text-center marginT20">Create New Item</h1>
            <hr>

            {!! Form::open(['route' => 'items.store', 'files' => true, 'data-parsley-validate' => '']) !!}

                {{ Form::label('category', 'Category:') }}
                {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'required' => '', 'placeholder' => 'Please select one']) }}

                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

                {{ Form::label('description', 'Description:') }}  
                {{ Form::textarea('description', null, array('class' => 'form-control', 'required' => '')) }}

                {{ Form::label('price', 'Price:') }}
                {{ Form::text('price', null, array('class' => 'form-control', 'required' => '')) }}
                
                {{ Form::label('quantity', 'Quantity:') }}
                {{ Form::text('quantity', null, array('class' => 'form-control', 'required' => '', 'type' => 'number')) }}

                {{ Form::label('sku', 'Sku:') }}
                {{ Form::text('sku', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

                {{ Form::label('picture', 'Picture:') }}
                {{ Form::file('picture', array('class' => 'form-control', 'required' => '')) }}

                {{ Form::submit('Create Item', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top: 20px;')) }}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')

    {!! Html::script('js/parsley.min.js') !!}

@endsection