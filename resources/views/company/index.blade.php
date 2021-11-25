@extends('layouts.app')

@section('content')
<div class="container">
{{-- 1. Table apglebti forma --}}
{{-- 2. Jquery ir Ajax


--}}

<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Address</th>
        <th> Total Clients </th>
        <th>Actions</th>
        <th></th>
    </tr>

    @foreach ($companies as $company)
        <tr>
            <td>{{$company->id}}</td>
            <td>{{$company->title}}</td>
            <td>{{$company->description}}</td>
            <td>{{$company->address}}</td>
            <td>{{$company->companyClients->count()}} </td>
            <td>
                    <button class="btn btn-danger" type="button">Delete</button>
                <a href="{{route('company.show',[$company])}}"" class="btn btn-primary">Show </a>
            </td>
            <td><input class="delete-company" type="checkbox"  name="companyDelete[]" value="{{$company->id}}" /></td>
        </tr>
    @endforeach
</table>
{{-- Isves id pazymetu elementu --}}
<button class="btn btn-primary" id="show-checked">Show Checked</button>
<script>
    // I console mums isvestu informacija kuris checkbox buvo paspaustas
    // Delete mygtuka, prie kurios kompanijos buvo paspaustas delete

    $(document).ready(function() {

            $("#show-checked").click(function() {
                //pasirinkciau visus delete-company elementus, kurie turi atributa checked
                //visus dele-company kurie yra pazymeti

                //elementu masyvas, ne reiksmiu

                // var checkedElValues =  $(".delete-company:checked");

                //masyvas, kuri siusime per ajax
                var checkedCompanies = [];

                // foreach(delete-company as $company )
                $.each( $(".delete-company:checked"), function( key, company) {
                    // console.log( company.value );
                    checkedCompanies[key] = company.value;
                });

                console.log(checkedCompanies);
                // console.log(checkedElValues);

                // console.log($(".delete-company:checked"));
            })

        $(".delete-company").click(function(){
            var company_id = $(this).val();

            // $(this).prop("checked") = true;

            // console.log(company_id);

            //1. ka mes siunciam ajax? ne vienas company_id , o tiek kiek pazymejom
            //2. mes i ajax uzklausa turime paduoti masyva, [1,5,7], skaiciai yra pazymetu kompaniju ID



            //nusiuntem ajax uzklausa su company id
            //ajax istryne company
            //mes isvedem sekmes nesekmes zinute

        })
    })
</script>
</div>
@endsection
