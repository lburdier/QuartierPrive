@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Properties</h1>
    <a href="{{ route('properties.create') }}" class="btn btn-primary">Add Property</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
            <tr>
                <td>{{ $property->title }}</td>
                <td>{{ $property->description }}</td>
                <td>{{ $property->price }}</td>
                <td>
                    <a href="{{ route('properties.show', $property) }}" class="btn btn-info">View</a>
                    <a href="{{ route('properties.edit', $property) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('properties.destroy', $property) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
