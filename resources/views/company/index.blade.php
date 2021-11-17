@extends('layouts.app')

@section('content')
<div class="container">
<table style="table table-stripped">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>

    @foreach ($companies as $company)
        <tr>
            <td>{{$company->id}}</td>
            <td>{{$company->title}}</td>
            <td>{{$company->description}}</td>
            <td>{{$company->address}}</td>
            <td>Actions</td>
        </tr>
    @endforeach
</table>
</div>
@endsection
