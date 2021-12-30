<!DOCTYPE html>
<html>

<head>
    <title>Employees PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($employees as $em)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$em->nama}}</td>
                <td>{{$em->email}}</td>
                <td>{{$em->company->nama}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
