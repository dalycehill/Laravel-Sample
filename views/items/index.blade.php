@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1 class="marginT20">All Items</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('items.create') }}" class="btn btn-primary margin_create" role="button">Create New Item</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Item</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                
                <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td><a href="{{ route('items.edit', $item->id) }}" class="btn btn-success btn-block">Edit</a>
                            {!! Form::open(['route'=>['items.destroy', $item->id], 'method'=>'DELETE']) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    
@endsection