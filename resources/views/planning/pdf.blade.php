<!DOCTYPE html>
<html>
<head>
    <title>Planning</title>
</head>
<body>
<h1>Planning des examens</h1>
<table border="1">
    <thead>
    <tr>
        <th>Date et créneau</th>
        <th>Module</th>
        <th>Local</th>
        <th>Enseignant</th>
    </tr>
    </thead>
    <tbody>
    @foreach($examens as $examen)
        <tr>
            <td>{{ $examen->date_creneau }}</td>
            <td>{{ $examen->module->nom }}</td>
            <td>{{ $examen->local->nom }}</td>
            <td>{{ $examen->module->enseignant->nom }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
