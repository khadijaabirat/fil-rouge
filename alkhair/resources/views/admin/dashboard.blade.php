<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Espace Administrateur</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-3">Associations en attente de validation (PENDING)</h2>

        @if($pendingAssociations->count() > 0)
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Nom de l'Association</th>
                        <th class="p-2 border">Ville</th>
                        <th class="p-2 border">N° Licence</th>
                        <th class="p-2 border">Document KYC</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingAssociations as $assoc)
                        <tr>
                            <td class="p-2 border">{{ $assoc->name }}</td>
                            <td class="p-2 border">{{ $assoc->ville }}</td>
                            <td class="p-2 border">{{ $assoc->licenseNumber }}</td>
                            <td class="p-2 border">
                                <a href="{{ asset('storage/' . $assoc->documentKYC) }}" target="_blank" class="text-blue-500 underline">Voir le document</a>
                            </td>
                            <td class="p-2 border">
                                <form action="{{ route('admin.validateAssociation', $assoc->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                        Valider
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Aucune association en attente pour le moment.</p>
        @endif
<h2 class="text-xl font-semibold mt-10 mb-3">Dons manuels en attente de validation</h2>


        @if($pendingDonations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border">Donateur</th>
                            <th class="p-2 border">Projet</th>
                            <th class="p-2 border">Montant</th>
                            <th class="p-2 border">Reçu (Preuve)</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingDonations as $donation)
                            <tr>
                                <td class="p-2 border">
                                    {{ $donation->isAnonymous ? 'Anonyme' : ($donation->donator->name ?? 'Inconnu') }}
                                </td>
                                <td class="p-2 border">{{ $donation->project->title ?? 'Projet supprimé' }}</td>
                                <td class="p-2 border font-bold text-green-600">{{ $donation->amount }} DH</td>
                                <td class="p-2 border">
                                    @if($donation->payment && $donation->payment->paymentReceipt)
                                        <a href="{{ asset('storage/' . $donation->payment->paymentReceipt) }}" target="_blank" class="text-blue-500 underline flex items-center">
                                            📄 Voir le reçu
                                        </a>
                                    @else
                                        <span class="text-red-500">Aucun reçu</span>
                                    @endif
                                </td>
                               <td class="p-2 border">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('admin.validateDonation', $donation->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                                                Valider
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.rejectDonation', $donation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir refuser ce don ? Le reçu sera supprimé.');">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                                Refuser
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 bg-gray-50 p-4 rounded border">Aucun don manuel en attente.</p>
        @endif
        <h2 class="text-xl font-semibold mt-10 mb-3 text-blue-700">Demandes de retrait de fonds (Associations)</h2>

        @if(isset($withdrawalRequests) && $withdrawalRequests->count() > 0)
            <div class="overflow-x-auto mb-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-100 text-blue-900">
                            <th class="p-2 border">Association</th>
                            <th class="p-2 border">RIB</th>
                            <th class="p-2 border">Projet</th>
                            <th class="p-2 border">Montant à transférer</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($withdrawalRequests as $project)
                            <tr>
                                <td class="p-2 border font-bold">{{ $project->association->name }}</td>
                                <td class="p-2 border text-red-600 font-mono">{{ $project->association->rib ?? 'Non renseigné' }}</td>
                                <td class="p-2 border">{{ $project->title }}</td>
                                <td class="p-2 border font-bold text-green-600">{{ $project->currentAmount }} DH</td>
                                <td class="p-2 border">
                                    <form action="{{ route('admin.approveWithdrawal', $project->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous avoir viré l\'argent sur le RIB de l\'association ?');">
                                        @csrf
                                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                            Confirmer le virement
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 bg-gray-50 p-4 rounded border mb-10">Aucune demande de retrait en attente.</p>
        @endif

        <h2 class="text-xl font-semibold mt-10 mb-3 text-red-700">Modération : Projets en cours</h2>
        @if(isset($activeProjects) && $activeProjects->count() > 0)
            <div class="overflow-x-auto mb-6">
                <table class="w-full text-left border-collapse border border-red-200">
                    <thead>
                        <tr class="bg-red-100 text-red-900">
                            <th class="p-2 border">Titre du Projet</th>
                            <th class="p-2 border">Association</th>
                            <th class="p-2 border">Statut</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeProjects as $project)
                            <tr>
                                <td class="p-2 border">{{ $project->title }}</td>
                                <td class="p-2 border">{{ $project->association->name ?? 'N/A' }}</td>
                                <td class="p-2 border font-bold text-gray-700">{{ $project->status }}</td>
                                <td class="p-2 border">
                                    <form action="{{ route('admin.suspendProject', $project->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir SUSPENDRE ce projet ?');">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Suspendre
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 mb-6">Aucun projet actif à modérer.</p>
        @endif

        <h2 class="text-xl font-semibold mt-6 mb-3 text-red-700">Modération : Associations Actives</h2>
        @if(isset($activeAssociations) && $activeAssociations->count() > 0)
            <div class="overflow-x-auto mb-10">
                <table class="w-full text-left border-collapse border border-red-200">
                    <thead>
                        <tr class="bg-red-100 text-red-900">
                            <th class="p-2 border">Nom de l'Association</th>
                            <th class="p-2 border">Ville</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeAssociations as $assoc)
                            <tr>
                                <td class="p-2 border font-bold">{{ $assoc->name }}</td>
                                <td class="p-2 border">{{ $assoc->ville }}</td>
                                <td class="p-2 border">
                                    <form action="{{ route('admin.banAssociation', $assoc->id) }}" method="POST" onsubmit="return confirm('ALERTE : Voulez-vous vraiment BANNIR cette association ? Tous ses projets seront suspendus.');">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            Bannir (Ban)
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 mb-10">Aucune association active à modérer.</p>
        @endif

        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="text-red-500 underline">Se déconnecter</button>
        </form>
    </div>

</body>
</html>
