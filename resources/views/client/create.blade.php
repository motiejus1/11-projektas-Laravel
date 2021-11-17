@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('client.store') }}">
        @csrf

        <div class="form-group row">
            <label for="clientName" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="clientName" type="text" class="form-control @error('clientName') is-invalid @enderror" name="clientName" value="{{ old('clientName') }}" required>

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
                <input id="clientSurname" type="text" class="form-control @error('clientSurname') is-invalid @enderror" name="clientSurname" value="{{ old('clientSurname') }}" required>

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
                    {{ old('clientDescription') }}
                </textarea>
                @error('clientDescription')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
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

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
