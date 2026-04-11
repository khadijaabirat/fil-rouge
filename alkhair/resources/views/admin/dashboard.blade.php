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
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="text-red-500 underline">Se déconnecter</button>
        </form>
    </div>

</body>
</html>
