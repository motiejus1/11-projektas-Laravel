@extends('layouts.app')

@section('content')
{{-- Modal - isokantis langas
1. Kliento sukurimo forma isokanciame lange x

2. Kliento redagavimo forma isokanciame lange

3. Show funkcionalumas isokanciame lange x
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
            <td>
                <button type="button" class="btn btn-success show-client" data-clientid='{{$client->id}}'>Show</button>
                <button type="button" class="btn btn-secondary update-client" data-clientid='{{$client->id}}'>Update</button>

            </td>
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
                        <span class="invalid-feedback clientName" role="alert"></span>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="clientSurname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                    <div class="col-md-6">
                        <input id="clientSurname" type="text" class="form-control" name="clientSurname">
                        <span class="invalid-feedback clientSurname" role="alert"></span>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="clientDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <textarea id="clientDescription" name="clientDescription" class="summernote form-control">

                        </textarea>
                        <span class="invalid-feedback clientDescription" role="alert"></span>
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
                        <span class="invalid-feedback clientCompany" role="alert"></span>
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
          <h5 class="modal-title show-clientNameSurname"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="show-clientDescription"></p>
          <p class="show-clientCompany"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="clientAjaxForm">
                <input type='hidden' id='edit-clientid'>
                <div class="form-group row">
                    <label for="clientName" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="edit-clientName" type="text" class="form-control" name="clientName">
                        <span class="invalid-feedback clientName" role="alert"></span>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="clientSurname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                    <div class="col-md-6">
                        <input id="edit-clientSurname" type="text" class="form-control" name="clientSurname">
                        <span class="invalid-feedback clientSurname" role="alert"></span>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="clientDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <textarea id="edit-clientDescription" name="clientDescription" class="summernote form-control">

                        </textarea>
                        <span class="invalid-feedback clientDescription" role="alert"></span>
                    </div>

                </div>
                <div class="form-group row clientCompany">
                    <label for="clientCompany" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                    <div class="col-md-6">

                        <select id="edit-clientCompany" class="form-control" name="clientCompany">
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}"> {{$company->title}}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback clientCompany" role="alert"></span>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary updateClientModal">Update</button>
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
                    if($.isEmptyObject(data.error)) {
                        $(".invalid-feedback").css("display", 'none');
                        $("#createClientModal").modal("hide");
                        $(".clients").append("<tr><td>"+ data.clientId +"</td><td>"+ data.clientName +"</td><td>"+ data.clientSurname +"</td><td>"+ data.clientDescription +"</td><td>"+ data.clientCompany +"</td><td>Actions</td></tr>");
                        $(".alerts").append("<div class='alert alert-success'>"+ data.success +"</div");

                        $("#clientName").val('');
                        $("#clientSurname").val('');
                        $("#clientDescription").val('');

                    } else {
                        $(".invalid-feedback").css("display", 'none');
                        $.each(data.error, function(key, error){
                            //key = laukelio pavadinimas prie kurio ivyko klaida
                            var errorSpan = '.' + key;
                            $(errorSpan).css('display', 'block');
                            $(errorSpan).html('');
                            $(errorSpan).append('<strong>'+ error + "</strong>");

                        });
                    }

                }
            });

    });

    $(".show-client").click(function() {

       $('#showClientModal').modal('show');
       var clientid = $(this).attr("data-clientid");

       $.ajax({
                type: 'GET',
                url: '/clients/showAjax/' + clientid ,// action
                success: function(data) {
                    $('.show-clientNameSurname').html('');
                    $('.show-clientDescription').html('');
                    $('.show-clientCompany').html('');

                    $('.show-clientNameSurname').append(data.clientId + '. ' + data.clientName + ' ' + data.clientSurname );
                    $('.show-clientDescription').append(data.clientDescription);
                    $('.show-clientCompany').append(data.clientCompany);
                }
            });



       console.log(clientid);
    });

    $(".update-client").click(function() {
        var clientid = $(this).attr('data-clientid');
        $("#editClientModal").modal("show");
        $.ajax({
                type: 'GET',
                url: '/clients/editAjax/' + clientid ,// action
                success: function(data) {
                    $("#edit-clientid").val(data.clientId);
                  $("#edit-clientName").val(data.clientName);
                  $("#edit-clientSurname").val(data.clientSurname);
                  $("#edit-clientDescription").val(data.clientDescription);
                  $("#edit-clientCompany").val(data.clientCompany);
                }
            });
    })

    $(".updateClientModal").click(function() {
        var clientid = $("#edit-clientid").val();
        var clientName = $("#edit-clientName").val();
        var clientSurname = $("#edit-clientSurname").val();
        var clientDescription = $("#edit-clientDescription").val();
        var clientCompany = $("#edit-clientCompany").val();

        $.ajax({
                type: 'POST',
                url: '/clients/updateAjax/' + clientid ,
                data: {clientName:clientName, clientSurname:clientSurname,clientDescription:clientDescription, clientCompany:clientCompany },
                success: function(data) {
                    if($.isEmptyObject(data.error)) {
                        $(".invalid-feedback").css("display", 'none');
                        $("#editClientModal").modal("hide");
                        $(".alerts").append("<div class='alert alert-success'>"+ data.success +"</div");

                    } else {
                        $(".invalid-feedback").css("display", 'none');
                        $.each(data.error, function(key, error){
                            //key = laukelio pavadinimas prie kurio ivyko klaida
                            var errorSpan = '.' + key;
                            $(errorSpan).css('display', 'block');
                            $(errorSpan).html('');
                            $(errorSpan).append('<strong>'+ error + "</strong>");

                        });
                    }

                }
            });




    })

 });

</script>
@endsection
