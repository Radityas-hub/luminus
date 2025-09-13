<?php


class CertificateController extends Controller
{
    public function verify($id)
    {
        $certificate = Certificate::with(['user', 'course'])
            ->findOrFail($id);

        return view('certificates.verify', compact('certificate'));
    }
}