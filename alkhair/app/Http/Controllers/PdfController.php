<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\ImpactReport;
use App\Services\PdfService;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function downloadImpactReport($id)
    {
        $impactReport = ImpactReport::with(['project.association', 'project.donations'])->findOrFail($id);
        return $this->pdfService->generateProjectReport($impactReport->project);
    }

    public function downloadDonationReceipt($id)
    {
        $donation = Donation::with(['donator', 'project.association'])->findOrFail($id);

        if ($donation->donator_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        if (!in_array($donation->status, ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])) {
            return back()->with('error', 'Le reçu n\'est disponible que pour les dons validés.');
        }

        return $this->pdfService->generateDonationReceipt($donation);
    }
}
