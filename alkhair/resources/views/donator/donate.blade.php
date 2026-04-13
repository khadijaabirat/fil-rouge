<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Faire un don - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Soutenir le projet : <span class="text-blue-600">{{ $project->title }}</span></h1>

        <form action="{{ route('donations.store', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="amount" class="block text-gray-700 font-medium mb-2">Montant du don (DH) *</label>
                <input type="number" id="amount" name="amount" min="10" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: 100">
                @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block text-gray-700 font-medium mb-2">Message de soutien (Optionnel)</label>
                <textarea id="message" name="message" rows="3" class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500"></textarea>
                @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="isAnonymous" name="isAnonymous" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <label for="isAnonymous" class="ml-2 text-gray-700 font-medium">Je souhaite faire ce don de manière anonyme</label>
            </div>

            <div class="mb-4">
                <label for="paymentMethod" class="block text-gray-700 font-medium mb-2">Méthode de paiement *</label>
                <select id="paymentMethod" name="paymentMethod" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionnez...</option>
                    <option value="ONLINE">En ligne (Carte / PayPal)</option>
                    <option value="MANUAL">Manuel (Virement Bancaire / Agence)</option>
                </select>
                @error('paymentMethod') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div id="receipt-upload" class="mb-6 p-4 border rounded bg-gray-50" style="display: none;">
                <label for="paymentReceipt" class="block text-gray-700 font-medium mb-2">Uploader le reçu (Obligatoire pour le paiement manuel) *</label>
                <input type="file" id="paymentReceipt" name="paymentReceipt" accept=".pdf,.jpg,.jpeg,.png" class="w-full">
                <p class="text-sm text-gray-500 mt-1">Formats acceptés : PDF, JPG, PNG (Max 5Mo)</p>
                @error('paymentReceipt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('donator.dashboard') }}" class="text-gray-500 hover:text-gray-700 underline">Annuler</a>
                <form action="{{ route('donations.store', $project->id) }}" method="POST" enctype="multipart/form-data" onsubmit="document.getElementById('submitBtn').disabled = true; document.getElementById('submitBtn').innerHTML = 'Traitement en cours...';">
    @csrf

    <button type="submit" id="submitBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Confirmer le don
    </button>
</form>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethodSelect = document.getElementById('paymentMethod');
            const receiptUploadDiv = document.getElementById('receipt-upload');
            const paymentReceiptInput = document.getElementById('paymentReceipt');

            paymentMethodSelect.addEventListener('change', function () {
                if (this.value === 'MANUAL') {
                    receiptUploadDiv.style.display = 'block';
                    paymentReceiptInput.setAttribute('required', 'required');
                } else {
                    receiptUploadDiv.style.display = 'none';
                    paymentReceiptInput.removeAttribute('required');
                }
            });
        });
    </script>

</body>
</html>
