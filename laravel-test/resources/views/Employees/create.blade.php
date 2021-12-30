@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card shadow-lg">
        <div class="card-body">
            <h4><strong>Create Data</strong></h4>
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                        placeholder="Enter name" value="{{ old('nama') }}">
                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                        id="email" placeholder="Enter email" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <select class="form-control @error('company_id') is-invalid @enderror" name="company_id"
                        id="company_select2" data-toggle="select2" data-width="100%">
                        <option value="" selected disabled>Choose company...</option>
                        @foreach ($company as $company)
                        <option value="{{ $company->id }}"
                            {{ old('company_id') == $company->id ? 'selected="true"' : ''  }}> {{ $company->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('company_id')
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

@push('js')
<script>
    $(document).ready(function () {
        $('#company_select2').select2({
            theme: 'bootstrap4',
        });
    });

</script>
@endpush
