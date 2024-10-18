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
        <th>Dates et créneaux</th>
        <th>Module</th>
        <th>Local</th>
        <th>Groupes</th>
        <th>Enseignants</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['dates_creneaux'] }}</td>
            <td>{{ $item['module'] }}</td>
            <td>{{ $item['local'] }}</td>
            <td>{{ $item['groupes'] }}</td>
            <td>{{ $item['enseignants'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
