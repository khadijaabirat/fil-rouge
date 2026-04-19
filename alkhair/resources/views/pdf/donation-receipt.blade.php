<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Don</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #10b981; padding-bottom: 20px; }
        .header h1 { color: #10b981; margin: 0; }
        .info-box { background: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .info-row { display: flex; justify-content: space-between; margin: 10px 0; }
        .label { font-weight: bold; color: #374151; }
        .value { color: #1f2937; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #6b7280; }
        .amount { font-size: 24px; color: #10b981; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🌟 AL-KHAIR</h1>
        <p>Plateforme Solidaire de Collecte de Dons</p>
        <p style="font-size: 14px; color: #6b7280;">Reçu N° {{ $receiptNumber }}</p>
    </div>

    <h2 style="color: #10b981;">Reçu de Don</h2>

    <div class="info-box">
        <div class="info-row">
            <span class="label">Donateur:</span>
            <span class="value">{{ $donation->isAnonymous ? 'Anonyme' : $donation->donator->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Email:</span>
            <span class="value">{{ $donation->donator->email }}</span>
        </div>
        <div class="info-row">
            <span class="label">Date du don:</span>
            <span class="value">{{ $donation->donationDate->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    <div class="info-box">
        <div class="info-row">
            <span class="label">Projet:</span>
            <span class="value">{{ $donation->project->title }}</span>
        </div>
        <div class="info-row">
            <span class="label">Association:</span>
            <span class="value">{{ $donation->project->association->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Ville:</span>
            <span class="value">{{ $donation->project->association->ville }}</span>
        </div>
    </div>

    <div class="info-box" style="text-align: center;">
        <p class="label">Montant du don</p>
        <p class="amount">{{ number_format($donation->amount, 2, ',', ' ') }} DH</p>
        <p style="font-size: 12px; color: #6b7280;">Statut: {{ $donation->status }}</p>
    </div>

    @if($donation->message)
    <div class="info-box">
        <p class="label">Message:</p>
        <p class="value">{{ $donation->message }}</p>
    </div>
    @endif

    <div class="footer">
        <p>Ce reçu a été généré automatiquement le {{ $generatedAt }}</p>
        <p>AL-KHAIR - Plateforme 100% gratuite et transparente</p>
        <p>www.alkhair.ma | contact@alkhair.ma</p>
    </div>
</body>
</html>
