@extends('main')

@section('stylesheets')

    {!! Html::style('css/parsley.css') !!}

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 marginT20">
            <h1>Edit Category</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PATCH', 'data-parsley-validate' => '']) !!}
            {{ Form::label('category', "Category:") }}
            {{ Form::text('category', null, ['class' => 'form-control', 'required' => '']) }}
        </div>
        
        <div class="col-md-6 text-center">
            {!! Html::linkRoute('categories.index', 'Cancel', array($category->id), array('class' => 'btn btn-danger btn-block')) !!}
            {!! Form::submit('Save', ['class' => 'btn btn-success btn-block']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')

    {!! Html::script('js/parsley.min.js') !!}

@endsection