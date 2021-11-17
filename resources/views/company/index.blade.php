@extends('layouts.app')

@section('content')
<div class="container">
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Address</th>
        <th> Total Clients </th>
        <th>Actions</th>
    </tr>

    @foreach ($companies as $company)
        <tr>
            <td>{{$company->id}}</td>
            <td>{{$company->title}}</td>
            <td>{{$company->description}}</td>
            <td>{{$company->address}}</td>
            <td>{{$company->companyClients->count()}} </td>
            <td>
                <a href="{{route('company.show',[$company])}}"" class="btn btn-primary">Show </a>
            </td>
        </tr>
    @endforeach
</table>
</div>
@endsection
