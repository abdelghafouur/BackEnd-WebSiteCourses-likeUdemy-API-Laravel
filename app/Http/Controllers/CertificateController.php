<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use App\Models\Result;

class CertificateController extends Controller
{
    public function generateCertificate(Request $request)
{
    $firstname = $request->input('firstname');
    $lastname = $request->input('lastname');
    $course = $request->input('course');
    $note = $request->input('note');
    $date = Carbon::today()->format('Y-m-d');

    // Read the certificate template file
    $template = file_get_contents(public_path('certificate-template.html'));

    // Replace the placeholders with the provided data
    $certificate = str_replace(['{{ firstname }}', '{{ lastname }}', '{{ course }}', '{{ note }}', '{{ date }}'], [$firstname, $lastname, $course, $note, $date], $template);

    // Use Dompdf to generate the PDF
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($certificate);
    $dompdf->setPaper('A3');
    $dompdf->render();

    // Return the PDF as a response with appropriate headers
    return Response::make($dompdf->output(), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename=certificate.pdf',
    ]);
}

public function updateNewCertificate(Request $request, $courseId,$compteId)
{
    try {
        $result = Result::where('course_id', $courseId)
            ->where('compte_id',$compteId)
            ->firstOrFail(); // Use firstOrFail() to throw an exception if the record is not found

        // Assuming the certificate data is passed in the request body as 'certificate'
        $certificateData = $request->input('certificate');
        $result->certificate = $certificateData;
        $result->save();

        return response()->json(['message' => 'Certificate updated successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to update certificate'], 500);
    }
}
public function certificategetDownoald($courseId,$compteId)
{

    $certificateData = Result::where('course_id', $courseId)
            ->where('compte_id',$compteId)
            ->firstOrFail(); // Use firstOrFail() to throw an exception if the record is not found

    if (!$certificateData) {
        // Certificate not found
        return response()->json(['error' => 'Certificate not found'], 404);
    }

    // Convert the base64 string to a PDF file
    $pdfData = base64_decode($certificateData->certificate);

    // Set the appropriate headers for the response
    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename=certificate.pdf',
    ];

    // Return the PDF file as a response
    return response($pdfData, 200, $headers);
}


}

