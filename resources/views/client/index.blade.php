@extends('layouts.app')

@section('content')
{{-- Modal - isokantis langas
1. Kliento sukurimo forma isokanciame lange x

2. Kliento redagavimo forma isokanciame lange

3. Show funkcionalumas isokanciame lange x
--}}

{{-- Paieska --}}
<div class="container">

    <div class="search-form row">
        <div class="col-md-8">
            <button class="test-delete" type="button">Test delete</button>
            {{-- data-target =  --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createClientModal">
                Create New Client Modal
            </button>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showClientModal">
                Show Client Modal
            </button>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="search-field" name="search-field"/>
            <button type="button" class="btn btn-primary" id="search-button" >Search</button>
            <span class="search-feedback">
            </span>
        </div>
    </div>
    <div class="sort-form row">
    {{-- 2 selectus: pasirenkame stulpeli, kitame rikiavimo tvarka --}}
        <select id="sortCol" name="sortCol">
            <option value='id' selected="true">ID</option>
            <option value='name'>Name</option>
            <option value='surname'>Surname</option>
            <option value='description'>Description</option>
            <option value='company_id'>Company</option>
        </select>

        <select id="sortOrder" name="sortOrder">
            <option value='ASC' selected="true">ASC</option>
            <option value='DESC'>DESC</option>
        </select>

        <select id="company_id" name="company_id">
            <option value="all" selected="true"> Show All </option>
        @foreach ($companies as $company)
            <option value='{{$company->id}}'>{{$company->title}}</option>
        @endforeach
        </select>
    <button type="button" id="filterClients" class="btn btn-primary">Filter Clients</button>

    </div>

<div class="alerts">
</div>

<div class="search-alert">
</div>

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
        <tr class="rowClient{{$client->id}}">
            <td class="colClientId">{{$client->id}}</td>
            <td class="colClientName">{{$client->name}}</td>
            <td class="colClientSurname">{{$client->surname}}</td>
            <td class="colClientDescription">{{$client->description}}</td>
            <td class="colClientCompanyTitle">{{$client->clientCompany->title}}</td>
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

    function createTable(clients){
        $(".clients tbody").html("");
        $(".clients tbody").append("<tr><th>ID</th><th>Name</th><th>Surname</th><th>Description</th><th>Company</th><th>Actions</th></tr>");
        $.each(clients, function(key, client){
                var clientRow = "<tr class='rowClient"+ client.id +"'>";
                clientRow += "<td class='colClientId'>"+ client.id +"</td>";
                clientRow += "<td class='colClientName'>"+ client.name +"</td>";
                clientRow += "<td class='colClientSurname'>"+ client.surname +"</td>";
                clientRow += "<td class='colClientDescription'>"+ client.description +"</td>";
                clientRow += "<td class='colClientCompanyTitle'>"+ client.companyTitle +"</td>";

                clientRow += "<td>";
                clientRow += "<button type='button' class='btn btn-success show-client' data-clientid='"+ client.id +"'>Show</button>";
                clientRow += "<button type='button' class='btn btn-secondary update-client' data-clientid='"+ client.id +"'>Update</button>";
                clientRow += "</td>";
                clientRow += "</tr>";

                $(".clients tbody").append(clientRow);
        });
    }

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

                        var clientRow = "<tr class='rowClient"+ data.clientId +"'>";
                            clientRow += "<td class='colClientId'>"+ data.clientId +"</td>";
                            clientRow += "<td class='colClientName'>"+ data.clientName +"</td>";
                            clientRow += "<td class='colClientSurname'>"+ data.clientSurname +"</td>";
                            clientRow += "<td class='colClientDescription'>"+ data.clientDescription +"</td>";
                            clientRow += "<td class='colClientCompanyTitle'>"+ data.clientCompany +"</td>";
                            clientRow += "<td>";
                            clientRow += "<button type='button' class='btn btn-success show-client' data-clientid='"+ data.clientId +"'>Show</button>";
                            clientRow += "<button type='button' class='btn btn-secondary update-client' data-clientid='"+ data.clientId +"'>Update</button>";
                            clientRow += "</td>";
                            clientRow += "</tr>";

                        $(".clients").append(clientRow);

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


    //click jinai neseka dinamiskai per javascript sukurtu elementu
    // $(".show-client").click(function() {
       $(document).on('click', '.show-client', function() {

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

    // $(".update-client").click(function() {
        $(document).on('click', '.update-client', function() {

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


                        $(".rowClient"+ clientid + " .colClientName").html(data.clientName);
                        $(".rowClient"+ clientid + " .colClientSurname").html(data.clientSurname);
                        $(".rowClient"+ clientid + " .colClientDescription").html(data.clientDescription);
                        $(".rowClient"+ clientid + " .colClientCompanyTitle").html(data.clientCompany);

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

    //kazkokio mygtuko paspaudimu istrinsiu konkretu klienta is dizaino
    //klienta kurio id yra 3
    //kazkurio is klientu varda pakeisti i "pakeistas per javascript"
    // pakeisti ir pavarde

    $(".test-delete").click(function() {
        // $(".client8").remove();
        $(".rowClient3 .colClientName").html("pakeistas per javascript");
        $(".rowClient3 .colClientSurname").html("pakeistas per javascript pavarde");
    })

    // $("#search-button").click(function() {

      // kad paeiska pradetu veikti tik kai ivedem 3 simbolius
      // riboti uzklausu kieki
      $(document).on('input', '#search-field', function() {
        //yra sekama kas ivedama i input
        var searchField = $("#search-field").val();
        var searchFieldCount = searchField.length;

        if(searchFieldCount != 0 && searchFieldCount < 3) {
            $(".search-feedback").css('display', 'block');
            $(".search-feedback").html("Min 3 symbols");
        } else {
            $(".search-feedback").css('display', 'none');


        $.ajax({
                type: 'GET',
                url: '/clients/searchAjax/',
                data: {searchField: searchField },
                success: function(data) {
                    if($.isEmptyObject(data.error)) {
                        console.log(data.success);
                        $(".clients").css("display", "block");
                        $(".search-alert").html("");
                        $(".search-alert").html(data.success);
                        createTable(data.clients);
                    } else {

                        $(".clients").css("display", "none");
                        $(".clients tbody").html("");
                        $(".search-alert").html("");
                        $(".search-alert").append(data.error);
                        // console.log(data.error)
                    }

                }
            });
        }

    })

    $(document).on('click', '#filterClients', function() {
        var sortCol = $("#sortCol").val();
        var sortOrder = $("#sortOrder").val();
        var company_id = $("#company_id").val();


        $.ajax({
                type: 'GET',
                url: '/clients/indexAjax/',
                data: {sortCol: sortCol, sortOrder: sortOrder, company_id: company_id },
                success: function(data) {
                    if($.isEmptyObject(data.error)) {
                        createTable(data.clients);
                    } else {

                        console.log(data.error)
                    }

                }
            });
    });

    // $(document).on('click', '#filterClients', function() {
    //     var company_id = $("#company_id").val();

    //     $.ajax({
    //             type: 'GET',
    //             url: '/clients/filterAjax/',
    //             data: {company_id: company_id },
    //             success: function(data) {
    //                 if($.isEmptyObject(data.error)) {
    //                     createTable(data.clients);
    //                 } else {
    //                     console.log(data.error)
    //                 }

    //             }
    //         });
    // })


 });

</script>
@endsection
