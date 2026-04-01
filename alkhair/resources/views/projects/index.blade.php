<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Projets - AL-KHAIR</title>
</head>
<body>
    <h1>Liste des Projets AL-KHAIR</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <ul>
        @forelse($projects as $project)
            <li>
                <strong>{{ $project->title }}</strong> - {{ $project->description }}
                (Objectif: {{ $project->goalAmount }} DH)
            </li>
        @empty
            <p>Aucun projet disponible pour le moment.</p>
        @endforelse
    </ul>

</body>
</html>
