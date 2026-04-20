<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">

<div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Espace Administrateur</h1>
            <a href="{{ route('admin.categories.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Gérer les Catégories
            </a>
        </div>


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
            <div class="bg-white p-12 rounded-2xl text-center border-2 border-dashed border-gray-300 shadow-sm">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune association en attente</h3>
                <p class="text-gray-500">Toutes les demandes d'inscription ont été traitées.</p>
            </div>
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
                                             Voir le reçu
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
            <div class="bg-white p-12 rounded-2xl text-center border-2 border-dashed border-gray-300 shadow-sm mb-10">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun don manuel en attente</h3>
                <p class="text-gray-500">Tous les dons manuels ont été traités.</p>
            </div>
        @else
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
            <div class="bg-white p-12 rounded-2xl text-center border-2 border-dashed border-gray-300 shadow-sm mb-10">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune demande de retrait</h3>
                <p class="text-gray-500">Aucune association n'a demandé le retrait de fonds pour le moment.</p>
            </div>
        @endif

        <h2 class="text-xl font-semibold mt-10 mb-3 text-red-700">Modération : Projets (Actifs & Suspendus)</h2>
        @if(isset($managedProjects) && $managedProjects->count() > 0)
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
                        @foreach($managedProjects as $project)
                            <tr>
                                <td class="p-2 border">{{ $project->title }}</td>
                                <td class="p-2 border">{{ $project->association->name ?? 'N/A' }}</td>
                                <td class="p-2 border font-bold text-gray-700">{{ $project->status }}</td>
                                <td class="p-2 border">
                                    @if($project->status === 'SUSPENDED')
                                        <form action="{{ route('admin.restoreProject', $project->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                                Restaurer (Activer)
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.suspendProject', $project->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir SUSPENDRE ce projet ?');">
                                            @csrf
                                            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                Suspendre
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white p-12 rounded-2xl text-center border-2 border-dashed border-gray-300 shadow-sm mb-6">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun projet à modérer</h3>
                <p class="text-gray-500">Tous les projets sont en règle.</p>
            </div>
        @endif

        <h2 class="text-xl font-semibold mt-6 mb-3 text-red-700">Modération : Associations (Actives & Bannies)</h2>
        @if(isset($managedAssociations) && $managedAssociations->count() > 0)
            <div class="overflow-x-auto mb-10">
                <table class="w-full text-left border-collapse border border-red-200">
                    <thead>
                        <tr class="bg-red-100 text-red-900">
                            <th class="p-2 border">Nom de l'Association</th>
                            <th class="p-2 border">Ville</th>
                            <th class="p-2 border">Statut</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($managedAssociations as $assoc)
                            <tr>
                                <td class="p-2 border font-bold">{{ $assoc->name }}</td>
                                <td class="p-2 border">{{ $assoc->ville }}</td>
                                <td class="p-2 border font-bold {{ $assoc->status === 'BANNED' ? 'text-red-600' : 'text-green-600' }}">{{ $assoc->status }}</td>
                                <td class="p-2 border">
                                    @if($assoc->status === 'BANNED')
                                        <form action="{{ route('admin.unbanAssociation', $assoc->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                                Réactiver (Unban)
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.banAssociation', $assoc->id) }}" method="POST" onsubmit="return confirm('ALERTE : Voulez-vous vraiment BANNIR cette association ? Tous ses projets seront suspendus.');">
                                            @csrf
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                                Bannir (Ban)
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white p-12 rounded-2xl text-center border-2 border-dashed border-gray-300 shadow-sm mb-10">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune association à modérer</h3>
                <p class="text-gray-500">Toutes les associations sont en règle.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="text-red-500 underline">Se déconnecter</button>
        </form>
    </div>

</body>
</html>
