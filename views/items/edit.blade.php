@extends('main')

@section('stylesheets')

    {!! Html::style('css/parsley.css') !!}

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 marginT20">
            <h1>Edit Item</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {!! Form::model($item, ['route' => ['items.update', $item->id], 'method' => 'PATCH', 'files' => true, 'data-parsley-validate' => '']) !!}

            {{ Form::label('category', "Category:") }}
            {{ Form::select('category_id', $categories, $item->category, ['class' => 'form-control', 'placeholder' => 'Please select one'] ) }}
            {{-- Category: {{ $item->category2->category }} --}}
            {{-- <select name="category_id" class="form-control">
                    <option>Please select one</option>
                    @foreach ($categories as $category_id=>$category)
                        <option value="{{$category_id}}" {{ ($category_id == $item->category) ? 'selected=selected' : '' }}>
                            {{$category}}
                        </option>
                    @endforeach
                </select> --}}

            {{ Form::label('title', "Title:") }}
            {{ Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

            {{ Form::label('description', "Description:") }}
            {{ Form::text('description', null, ['class' => 'form-control', 'required' => '']) }}

            {{ Form::label('price', "Price:") }}
            {{ Form::text('price', null, ['class' => 'form-control', 'required' => '']) }}

            {{ Form::label('quantity', "Quantity:") }}
            {{ Form::text('quantity', null, ['class' => 'form-control', 'required' => '']) }}

            {{ Form::label('sku', "Sku:") }}
            {{ Form::text('sku', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

            {{ Form::label('oldPicture', "Current Picture:") }}
            <p> {{ $item->picture }} </p>
            <img src="/images/{{ $item->picture }}" class="img-fluid">
            
            {{ Form::label('picture', "Update Picture:") }}
            {{ Form::file('picture', ['class' => 'form-control'])}}
        </div>
        
        <div class="col-md-6 text-center">
            {!! Html::linkRoute('items.index', 'Cancel', array($item->id), array('class' => 'btn btn-danger btn-block')) !!}
            {!! Form::submit('Save', ['class' => 'btn btn-success btn-block']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')

    {!! Html::script('js/parsley.min.js') !!}

@endsection