@extends('layouts.app')

@section('content')

<div class="container">

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body">
            <h4><strong>List Data Companies</strong></h4>
            <a href="{{ route('company.create') }}" class="btn btn-primary my-3 float-right">Create</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Website</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($company) && $company->count())
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($company as $cp)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $cp->nama }}</td>
                            <td>{{ $cp->email }}</td>
                            <td>
                                <img src="{{ $cp->logo }}" alt="{{ $cp->name }}" width="50px" height="50px"
                                    class="rounded-lg">
                            </td>
                            <td>{{ $cp->website }}</td>
                            <td>
                                <form onsubmit="return confirm('Are you sure ?');" action="{{ route('company.destroy', $cp) }}" method="POST">
                                <a href="{{ route('company.edit', $cp) }}" class="btn btn-success btn-sm">Edit</a>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                @method('delete') 
                                @csrf() 
                                </form>
                            </td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                        @else
                        <tr>
                            <td colspan="10">There are no data.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <h6>Amount of data : {{ $company->total()}} </h6>
            {!! $company->links() !!}
        </div>
    </div>
</div>


@endsection
