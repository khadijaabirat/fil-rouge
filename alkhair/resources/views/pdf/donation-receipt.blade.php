<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Don - AL-KHAIR</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Styles compatibles PDF (DomPDF / Snappy) */
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            padding: 40px; 
            color: #191c1e;
            background-color: #ffffff;
        }
        h1, h2, h3 { 
            font-family: 'Manrope', sans-serif; 
            margin: 0;
        }
        .header { 
            width: 100%;
            border-bottom: 3px solid #021c36; 
            padding-bottom: 20px; 
            margin-bottom: 40px;
        }
        .header-table {
            width: 100%;
        }
        .logo-text {
            font-size: 32px;
            font-weight: 800;
            color: #021c36;
            letter-spacing: -1px;
        }
        .logo-dot { color: #feb700; }
        .tagline {
            font-size: 12px;
            color: #74777e;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 4px;
        }
        .receipt-details {
            text-align: right;
        }
        .receipt-title {
            font-size: 24px;
            font-weight: 700;
            color: #021c36;
            text-transform: uppercase;
        }
        .receipt-number {
            font-size: 14px;
            font-weight: 600;
            color: #ba1a1a; /* Rouge pour le numéro */
            margin-top: 4px;
        }
        
        /* Grid des informations */
        .info-table {
            width: 100%;
            margin-bottom: 40px;
            border-collapse: separate;
            border-spacing: 20px 0;
        }
        .info-box { 
            background: #f8f9fb; 
            padding: 24px; 
            border-radius: 12px; 
            border: 1px solid #e0e3e5;
            vertical-align: top;
            width: 48%;
        }
        .info-box h3 {
            font-size: 14px;
            text-transform: uppercase;
            color: #021c36;
            border-bottom: 1px solid #c4c6ce;
            padding-bottom: 10px;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        .info-row { 
            margin-bottom: 12px; 
            font-size: 14px;
        }
        .label { 
            font-weight: 600; 
            color: #74777e; 
            display: inline-block;
            width: 100px;
        }
        .value { 
            font-weight: 600;
            color: #191c1e; 
        }

        /* Section Montant */
        .amount-section {
            background-color: #021c36;
            color: #ffffff;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 6px solid #feb700;
        }
        .amount-label {
            font-family: 'Manrope', sans-serif;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #b1c8e9;
            margin-bottom: 10px;
        }
        .amount-value { 
            font-size: 48px; 
            font-weight: 800; 
            color: #ffffff;
            margin: 0;
            font-family: 'Manrope', sans-serif;
        }
        .amount-currency {
            color: #feb700;
            font-size: 24px;
            vertical-align: super;
        }
        .amount-status {
            display: inline-block;
            margin-top: 15px;
            background-color: #feb700;
            color: #021c36;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Message */
        .message-box {
            background: #fff8e1; /* Jaune très clair */
            border-left: 4px solid #feb700;
            padding: 20px;
            margin-bottom: 40px;
            border-radius: 0 8px 8px 0;
        }
        .message-label {
            font-weight: 700;
            font-size: 12px;
            color: #7c5800;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
        }
        .message-content {
            font-size: 14px;
            font-style: italic;
            color: #370e00;
            margin: 0;
        }

        /* Footer */
        .footer { 
            margin-top: 60px; 
            padding-top: 20px;
            border-top: 1px solid #e0e3e5;
            text-align: center; 
        }
        .footer-text {
            font-size: 11px; 
            color: #74777e; 
            line-height: 1.6;
            margin: 4px 0;
        }
        .footer-bold {
            font-weight: 600;
            color: #021c36;
        }
        
        /* Filigrane (Watermark) */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(254, 183, 0, 0.05); /* Doré très transparent */
            font-weight: 800;
            font-family: 'Manrope', sans-serif;
            z-index: -1;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    
    <div class="watermark">AL-KHAIR ARCHIVE</div>

    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 50%;">
                    <div class="logo-text">AL-KHAIR<span class="logo-dot">.</span></div>
                    <div class="tagline">Plateforme d'Impact Humanitaire</div>
                </td>
                <td class="receipt-details">
                    <div class="receipt-title">Reçu de Don</div>
                    <div class="receipt-number">N° {{ $receiptNumber }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="amount-section">
        <div class="amount-label">Contribution Solidaire</div>
        <div class="amount-value">
            {{ number_format($donation->amount, 2, ',', ' ') }} <span class="amount-currency">DH</span>
        </div>
        <div class="amount-status">
            ✓ {{ $donation->status === 'VALIDATED' ? 'Paiement Validé' : ($donation->status === 'IMPACT' ? 'Fonds Déployés' : $donation->status) }}
        </div>
    </div>

    <table class="info-table">
        <tr>
            <td class="info-box">
                <h3>Détails du Donateur</h3>
                <div class="info-row">
                    <span class="label">Nom :</span>
                    <span class="value">{{ $donation->isAnonymous ? 'Donateur Anonyme' : $donation->donator->name }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Email :</span>
                    <span class="value">{{ $donation->isAnonymous ? '***@***.***' : $donation->donator->email }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Date :</span>
                    <span class="value">{{ $donation->donationDate->format('d/m/Y à H:i') }}</span>
                </div>
            </td>
            
            <td class="info-box">
                <h3>Destination des Fonds</h3>
                <div class="info-row">
                    <span class="label">Projet :</span>
                    <span class="value">{{ $donation->project->title }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Association :</span>
                    <span class="value">{{ $donation->project->association->name }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Lieu :</span>
                    <span class="value">{{ $donation->project->association->ville ?? 'Maroc' }}</span>
                </div>
            </td>
        </tr>
    </table>

    @if($donation->message)
    <div class="message-box">
        <span class="message-label">Votre message de soutien :</span>
        <p class="message-content">"{{ $donation->message }}"</p>
    </div>
    @endif

    <div class="footer">
        <p class="footer-text"><span class="footer-bold">AL-KHAIR</span> - L'archive éthique de la solidarité au Maroc.</p>
        <p class="footer-text">Ce reçu a été généré électroniquement le {{ $generatedAt }} et sert de preuve de votre contribution.</p>
        <p class="footer-text" style="margin-top: 15px; color: #b1c8e9; font-weight: 600;">www.alkhair.ma | contact@alkhair.ma</p>
    </div>

</body>
</html>