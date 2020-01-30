@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1 class="marginT20">All Categories</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('categories.create') }}" class="btn btn-primary margin_create" role="button">Create New Category</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                
                <tbody>

                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-block">Edit</a>
                            {{-- @if($item->id) --}}
                            {!! Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'DELETE']) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}</td>
                            {{-- @endif --}}
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    
@endsection