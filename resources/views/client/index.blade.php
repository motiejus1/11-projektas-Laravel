@extends('layouts.app')

@section('content')
{{-- Modal - isokantis langas
1. Kliento sukurimo forma isokanciame lange
2. Kliento redagavimo forma isokanciame lange
3. Show funkcionalumas isokanciame lange
--}}
<div class="container">

<div class="alerts">
</div>

    {{-- data-target =  --}}
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createClientModal">
        Create New Client Modal
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showClientModal">
        Show Client Modal
    </button>
<table class="clients table table-striped">
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
<div class="modal fade" id="createClientModal" tabindex="-1" role="dialog" aria-labelledby="createClientModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="clientAjaxForm">
                <div class="form-group row">
                    <label for="clientName" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="clientName" type="text" class="form-control" name="clientName">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clientSurname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                    <div class="col-md-6">
                        <input id="clientSurname" type="text" class="form-control" name="clientSurname">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clientDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <textarea id="clientDescription" name="clientDescription" class="summernote form-control">

                        </textarea>
                    </div>
                </div>
                <div class="form-group row clientCompany">
                    <label for="clientCompany" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                    <div class="col-md-6">

                        <select id="clientCompany" class="form-control" name="clientCompany">
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}"> {{$company->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary addClientModal">Add</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="showClientModal" tabindex="-1" role="dialog" aria-labelledby="showClientModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Show Client Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>

<script>

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

 $(document).ready(function() {

    $(".addClientModal").click(function() {
        var clientName = $("#clientName").val();
        var clientSurname = $("#clientSurname").val();
        var clientDescription = $("#clientDescription").val();
        var clientCompany = $("#clientCompany").val();

        $.ajax({
                type: 'POST',
                url: '{{route("client.storeAjax")}}',
                data: {clientName:clientName, clientSurname:clientSurname,clientDescription:clientDescription, clientCompany:clientCompany },
                success: function(data) {
                    console.log(data.success);
                    $("#createClientModal").modal("hide");
                    $(".clients").append("<tr><td>"+ data.clientId +"</td><td>"+ data.clientName +"</td><td>"+ data.clientSurname +"</td><td>"+ data.clientDescription +"</td><td>"+ data.clientCompany +"</td><td>Actions</td></tr>");
                    $(".alerts").append("<div class='alert alert-success'>"+ data.success +"</div");
                }
            });

    });

 });

</script>
@endsection
