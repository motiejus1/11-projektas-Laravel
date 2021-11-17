@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('client.store') }}">
        @csrf

        <div class="form-group row">
            <label for="clientName" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="clientName" type="text" class="form-control @error('clientName') is-invalid @enderror" name="clientName">

                @error('clientName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="clientSurname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

            <div class="col-md-6">
                <input id="clientSurname" type="text" class="form-control @error('clientSurname') is-invalid @enderror" name="clientSurname">

                @error('clientSurname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="clientDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

            <div class="col-md-6">
                <textarea id="clientDescription" name="clientDescription" class="summernote form-control @error('clientDescription') is-invalid @enderror">

                </textarea>
                @error('clientDescription')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row clientCompany">
            <label for="clientCompany" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

            <div class="col-md-6">

                <select id="clientCompany" class="form-control @error('clientCompany') is-invalid @enderror" name="clientCompany">
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}"> {{$company->title}}</option>
                    @endforeach
                </select>
                @error('clientCompany')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- checbox pazymetas - i backenda yra perduodama jo value, 1 --}}
        {{-- checkbox nepazymet - i backenda yra grazinama false --}}
        <div class="form-group row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <input type="checkbox" id="companyNew" name="companyNew" value="1" />
                <span>Add new company?</span>
            </div>
        </div>
        <div class="company-info d-none">
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
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add') }}
                </button>
            </div>
        </div>
    </form>
</div>
<script>

    $(document).ready(function() {
        $("#companyNew").click(function() {
            // console.log("paspaustas");
            $(".company-info").toggleClass("d-none");
            $(".clientCompany").toggleClass("d-none");
        });
    });
</script>
@endsection
