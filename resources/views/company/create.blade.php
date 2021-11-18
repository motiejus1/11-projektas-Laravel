@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('company.store') }}">
        @csrf
        <div class="form-group row">
            <label for="companyTitle" class="col-md-4 col-form-label text-md-right">{{ __('Company Title') }}</label>

            <div class="col-md-6">
                <input id="companyTitle" type="text" class="form-control @error('companyTitle') is-invalid @enderror" name="companyTitle" >

                @error('companyTitle')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="companyDescription" class="col-md-4 col-form-label text-md-right">{{ __('Company Description') }}</label>

            <div class="col-md-6">
                <textarea id="companyDescription" name="companyDescription" class="summernote form-control @error('companyDescription') is-invalid @enderror">

                </textarea>
                @error('companyDescription')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="companyAddress" class="col-md-4 col-form-label text-md-right">{{ __('Company Address') }}</label>

            <div class="col-md-6">
                <input id="companyAddress" type="text" class="form-control @error('companyAddress') is-invalid @enderror" name="companyAddress">

                @error('companyAddress')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <input type="checkbox" id="clientsNew" name="clientsNew" value="1" />
                <span>Add new client/s?</span>
            </div>
        </div>
        {{-- 1. pazymiu checkbox
             2. Vieno kliento pridejimo forma ir mygtukas Add More Clients
             3. Paspaudus Add More Clients sekanti forma, mygtukas -
            --}}
        <div class="clients-info d-none">
            <div class="form-group row">
                <div class="col-md-4">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" id="add-more-clients">Add More Clients</button>
                </div>
            </div>
            <div class="client">
                <div class="form-group row">
                    <label for="clientName" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="clientName[]">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clientSurname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="clientSurname[]">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clientDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    <div class="col-md-6">
                        <textarea name="clientDescription[]" class="summernote form-control">
                        </textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add') }}
                </button>
            </div>
        </div>
    </form>

    <div class="client-template d-none">
        <div class="client">
            <div class="form-group row">
                <label for="clientName" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="clientName[]">
                </div>
            </div>
            <div class="form-group row">
                <label for="clientSurname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="clientSurname[]">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger removeClient">Remove Client</button>
                </div>
            </div>
            <div class="form-group row">
                <label for="clientDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                <div class="col-md-4">
                    <textarea name="clientDescription[]" class="summernote form-control">
                    </textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $("#clientsNew").click(function() {
            // console.log("paspaustas");
            $(".clients-info").toggleClass("d-none");
        });

        $("#add-more-clients").click(function() {
            //prie clients-info div turi prikabinti nauja div client
            // $(".clients-info").append("<div class='client'>Div added</div>");


            $(".clients-info").append($(".client-template").html());

            // console.log($(".client-template").html());

        })


        //n+1
        // 1
        // 1
        // 1 x

        $(document).on("click", ".removeClient", function() {
            console.log("veikia");
            $(this).parents('.client').remove();
        });
    });
</script>

@endsection
