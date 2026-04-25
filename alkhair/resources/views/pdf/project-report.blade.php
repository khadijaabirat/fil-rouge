<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #191c1e; margin: 0; padding: 0; }
        .header { background-color: #021c36; color: white; padding: 30px 40px; }
        .header h1 { margin: 0 0 4px; font-size: 22px; }
        .header p { margin: 0; font-size: 11px; color: #feb700; letter-spacing: 1px; text-transform: uppercase; }
        .badge { display: inline-block; background: #feb700; color: #021c36; font-size: 9px; font-weight: bold; padding: 3px 10px; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px; margin-top: 10px; }
        .content { padding: 30px 40px; }
        .section-title { font-size: 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; color: #7c5800; border-bottom: 2px solid #feb700; padding-bottom: 6px; margin-bottom: 14px; margin-top: 24px; }
        .stats-grid { display: table; width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .stat-box { display: table-cell; width: 33%; border: 1px solid #e0e3e5; padding: 14px; text-align: center; }
        .stat-value { font-size: 24px; font-weight: bold; color: #021c36; }
        .stat-label { font-size: 9px; text-transform: uppercase; letter-spacing: 1px; color: #43474d; margin-top: 4px; }
        .description { background: #f2f4f6; border-left: 4px solid #feb700; padding: 14px 18px; border-radius: 4px; line-height: 1.7; color: #43474d; }
        .meta-row { display: table; width: 100%; margin-bottom: 8px; }
        .meta-label { display: table-cell; width: 40%; font-weight: bold; color: #021c36; }
        .meta-value { display: table-cell; color: #43474d; }
        .footer { margin-top: 40px; padding: 16px 40px; background: #f2f4f6; border-top: 2px solid #e0e3e5; font-size: 9px; color: #43474d; text-align: center; }
        .progress-bar-bg { background: #e0e3e5; border-radius: 4px; height: 8px; width: 100%; margin-top: 6px; }
        .progress-bar-fill { background: #feb700; height: 8px; border-radius: 4px; }
    </style>
</head>
<body>

<div class="header">
    <p>Rapport d'Impact Officiel</p>
    <h1>{{ $project->title }}</h1>
    <div class="badge">✓ Rapport Validé</div>
</div>

<div class="content">

    <div class="section-title">Informations Générales</div>
    <div class="meta-row"><span class="meta-label">Association :</span><span class="meta-value">{{ $project->association->name ?? 'N/A' }}</span></div>
    <div class="meta-row"><span class="meta-label">Localisation :</span><span class="meta-value">{{ $project->ville ?? 'Maroc' }}</span></div>
    <div class="meta-row"><span class="meta-label">Date de Clôture :</span><span class="meta-value">{{ \Carbon\Carbon::parse($project->impactReport->completionDate)->format('d/m/Y') }}</span></div>
    <div class="meta-row"><span class="meta-label">Rapport généré le :</span><span class="meta-value">{{ $generatedAt }}</span></div>

    <div class="section-title">Statistiques Clés</div>
    <table class="stats-grid">
        <tr>
            <td class="stat-box">
                <div class="stat-value">{{ number_format($totalDonations, 0, ',', ' ') }} DH</div>
                <div class="stat-label">Fonds Collectés</div>
            </td>
            <td class="stat-box">
                <div class="stat-value">{{ $donorsCount }}</div>
                <div class="stat-label">Donateurs Uniques</div>
            </td>
            <td class="stat-box">
                @php $pct = $project->goalAmount > 0 ? min(($totalDonations / $project->goalAmount) * 100, 100) : 100; @endphp
                <div class="stat-value">{{ number_format($pct, 0) }}%</div>
                <div class="stat-label">Objectif Atteint</div>
            </td>
        </tr>
    </table>
    <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: {{ $pct }}%"></div></div>
    <p style="font-size:9px; color:#43474d; margin-top:4px;">Objectif initial : {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</p>

    <div class="section-title">Description de l'Impact</div>
    <div class="description">{{ $project->impactReport->description }}</div>

</div>

<div class="footer">
    AL-KHAIR — Plateforme Solidaire de Collecte de Dons &nbsp;|&nbsp; alkhair.ma &nbsp;|&nbsp; Document officiel généré automatiquement
</div>

</body>
</html>
