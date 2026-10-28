<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\AuditLog;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoicePdfController extends Controller
{
    private function generatePdf(Invoice $invoice): string
    {
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf($options);
        $html = view('pdf.invoice-statement', ['invoice' => $invoice])->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }

    public function download(Invoice $invoice): Response
    {
        $pdfOutput = $this->generatePdf($invoice);

        AuditLog::logAction('Invoice PDF Downloaded', "Downloaded PDF statement {$invoice->invoice_number}", 'Invoice', $invoice->id);

        return response($pdfOutput, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"Statement_{$invoice->invoice_number}.pdf\"",
            'Cache-Control' => 'no-cache, private',
        ]);
    }

    public function preview(Invoice $invoice): Response
    {
        $pdfOutput = $this->generatePdf($invoice);

        return response($pdfOutput, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"Statement_{$invoice->invoice_number}.pdf\"",
        ]);
    }

    public function print(Invoice $invoice)
    {
        return view('pdf.invoice-print', ['invoice' => $invoice]);
    }
}
