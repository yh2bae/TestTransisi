@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card shadow-lg">
        <div class="card-body">
            <h4><strong>Edit Data</strong></h4>
            <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Enter name"  value="{{ old('nama', $company->nama) }}">
                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ old('email', $company->email) }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control  @error('website') is-invalid @enderror" name="website" id="website" placeholder="Enter website" value="{{ old('website', $company->website) }}">
                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Logo</label>
                    <input type="hidden" name="oldLogo" value="{{ $company->logo }}">

                    @if($company->logo)
                    <img src="{{ asset('storage/'. $company->logo) }}" class="img-fluid d-block mb-3 rounded-lg" width="100px" height="100px" alt="{{ $company->nama }}">
                    @else
                    <img class="img-preview img-fluid">
                    @endif

                    <input type="file" class="form-control @error('logo') is-invalid @enderror" accept="image" name="logo" id="logo">
                    @error('logo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection