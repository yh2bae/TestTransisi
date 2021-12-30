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
            <h4><strong>List Data Employees</strong></h4>
            <a href="{{ route('employees.create') }}" class="btn btn-primary my-3 btn-sm float-right">Create</a>
            <a href="{{ route('employees.pdf') }}" class="btn btn-warning my-3 mx-2 btn-sm" target="_blank">Export to PDF</a>
            <a href="{{ route('employees.export') }}" class="btn btn-info my-3 btn-sm" target="_blank">Export to Excel</a>
            <button type="button" class="btn btn-success btn-sm my-3 mx-2" data-toggle="modal" data-target="#importExcel">
                Import Excel
            </button>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($employees) && $employees->count())
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($employees as $em)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $em->nama }}</td>
                            <td>{{ $em->email }}</td>
                            <td>{{ $em->company->nama }}</td>
                            <td>
                                <form onsubmit="return confirm('Are you sure ?');" action="{{ route('employees.destroy', $em) }}" method="POST">
                                <a href="{{ route('employees.edit', $em) }}" class="btn btn-success btn-sm">Edit</a>
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
            <h6>Amount of data : {{ $employees->total()}} </h6>
            {!! $employees->links() !!}
        </div>
    </div>
</div>

<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('employees.import') }}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">

                    @csrf

                    <label>Pilih file excel</label>
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/app.js') }}" defer></script> 
@endsection
