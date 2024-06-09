<table>
    <thead>
    <tr>
        <th>Dates et créneaux</th>
        <th>Module</th>
        <th>Local</th>
        <th>Enseignants</th>
    </tr>
    </thead>
    <tbody>
    @foreach($examens as $examen)
        <tr>
            <td>{{ $examen->crenau->date_creneau . ' ' . $examen->crenau->crenaux }}</td>
            <td>{{ $examen->module->libelle }}</td>
            <td>{{ $examen->local->nom }}</td>
            <td>{{ $examen->enseignants->pluck('name')->join(', ') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
