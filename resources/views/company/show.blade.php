@extends('layouts.app')

@section('content')

<div class="container">

    <h2> {{$company->id}} {{$company->title}} </h2>
    <p> {{$company->address}} </p>
    <p> {{$company->description }} </p>

    {{-- jinai grazina masyva, su visais kompanijos klientais --}}
    {{-- <p>{{$company->companyClients}}</p> --}}

    @foreach ($clients as $client)
        <p>{{$client->id}}</p>
        <p>{{$client->name}}</p>
        <p>{{$client->surname}}</p>
    @endforeach

</div>

@endsection
