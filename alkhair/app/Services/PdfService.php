<?php

namespace App\Services;

use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Project;
class PdfService
{
    public function generateDonationReceipt(Donation $donation)
    {
        $data = [
            'donation' => $donation->load(['donator', 'project.association']),
            'receiptNumber' => 'REC-' . str_pad($donation->id, 8, '0', STR_PAD_LEFT),
            'generatedAt' => now()->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('pdf.donation-receipt', $data);
        
        return $pdf->download('recu-don-' . $donation->id . '.pdf');
    }

    public function generateProjectReport(Project $project)
    {
        $data = [
            'project' => $project->load(['association', 'donations', 'impactReport']),
            'totalDonations' => $project->donations()->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->sum('amount'),
            'donorsCount' => $project->donations()->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->distinct('donator_id')->count(),
            'generatedAt' => now()->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('pdf.project-report', $data);
        
        return $pdf->download('rapport-projet-' . $project->id . '.pdf');
    }
}
