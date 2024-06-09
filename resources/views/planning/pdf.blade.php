<!DOCTYPE html>
<html>
<head>
    <title>Planning</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<h1>Planning des examens</h1>
<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Créneau</th>
        <th>Module</th>
        <th>Local</th>
        <th>Enseignants</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pdfData as $examen)
        <tr>
            <td>{{ $examen['date'] }}</td>
            <td>{{ $examen['creneau'] }}</td>
            <td>{{ $examen['module'] }}</td>
            <td>{{ $examen['local'] }}</td>
            <td>{{ $examen['enseignants'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
