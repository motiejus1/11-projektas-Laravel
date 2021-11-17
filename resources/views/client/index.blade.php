@extends('layouts.app')

@section('content')
<div class="container">
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Description</th>
        <th>Company</th>
        <th>Actions</th>
    </tr>

    @foreach ($clients as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->name}}</td>
            <td>{{$client->surname}}</td>
            <td>{{$client->description}}</td>
            <td>{{$client->clientCompany->title}}</td>
            <td>Actions</td>
        </tr>
    @endforeach
</table>
</div>
@endsection
