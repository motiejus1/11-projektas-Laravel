@extends('layouts.app')

@section('content')
<div class="container">
{{-- 1. Table apglebti forma --}}
{{-- 2. Jquery ir Ajax


--}}
<div class="alerts d-none">

</div>
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
        <tr class="company{{$company->id}}">
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
<button class="btn btn-primary" id="delete-selected">Delete</button>
<script>
    // I console mums isvestu informacija kuris checkbox buvo paspaustas
    // Delete mygtuka, prie kurios kompanijos buvo paspaustas delete

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

            $("#delete-selected").click(function() {
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

                //javascript masyvas => JSON masyvas
                console.log(checkedCompanies);


                // [1,7,3]
                // 3 kartus
                // checkedCompanies[0] = 1
                // checkedCompanies[1] = 7
                //ckechedCompanies[2] = 3


                $.ajax({
                type: 'POST',
                url: '{{route("company.destroySelected")}}',
                data: { checkedCompanies: checkedCompanies }, //JSON masyva
                success: function(data) {
                        $(".alerts").toggleClass("d-none");
                        for(var i=0; i<data.messages.length; i++) {
                            $(".alerts").append("<div class='alert alert-"+data.errorsuccess[i] + "'><p>"+ data.messages[i] + "</p></div>")

                            //danger arba success
                            var id = data.success[i];
                            if(data.errorsuccess[i] == "success") {
                                $(".company"+id ).remove();
                            }
                        }

                        // console.log(data.messages);
                    }
                });
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
