@extends('layouts.app')

@section('content')

<div class="container container-show">


    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{$company->id}}. {{$company->title}}</h2>
            <p class="card-text">{{$company->description }} </p>
            <p class="card-text">{{$company->address }} </p>
        </div>
    </div>

    @if ($clientsCount != 0)
        <h3 class="clients-list">Clients list</h3>
        <table class="clients table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            @foreach ($clients as $client)
            <tr class="client">
                <td>{{$client->id}}</td>
                <td>{{$client->name}}</td>
                <td>{{$client->surname}}</td>
                <td>{{$client->description}}</td>
                <td>
                    <form method="POST" action="{{route('client.destroy',[$client])}}">
                        @csrf
                        <button type="submit" class="btn btn-primary">DELETE </button>
                    </form>

                    <button class="btn btn-danger clientDelete" data-clientid="{{$client->id}}">DELETE AJAX</button>
                </td>
            </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-danger">
            <p>The company has no clients</p>
        </div>
    @endif

</div>
<script>

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        $(".clientDelete").click(function() {
            var clientID = $(this).attr("data-clientid");
            $(this).parents(".client").remove();

            //ajax

            //route(client.destroyAjax,[$client])

            $.ajax({
                type: 'POST',
                url: '/clients/deleteAjax/' + clientID ,// action
                success: function(data) {
                    alert(data.success);
                    console.log(data.clientsCount);
                    if(data.clientsCount == 0) {
                        $(".clients").remove();
                        $(".clients-list").remove();
                        $(".container-show").append("<div class='alert alert-danger'><p>The company has no clients</p></div> ")
                        //
                    }
                }
            });

        });
    });

</script>

@endsection
