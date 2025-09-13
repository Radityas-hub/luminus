<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Transaction;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function showPaymentForm($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('payment.form', compact('course'));
    }


    // PaymentController.php
    public function processPayment(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'payment_method' => 'required|string',
        ]);
    
        $user = Auth::user();
        $course = Course::find($request->course_id);
    
        // Check if the user has already purchased the course
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->route('siswa.courses.show', $course->id)->with('message', 'Anda sudah terdaftar di kursus ini.');
        }
    
        // Simulate payment processing
        $paymentSuccess = $this->fakePaymentProcessing($request->payment_method);
    
        if ($paymentSuccess) {
            // Save transaction
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->course_id = $course->id;
            $transaction->description = "Pembelian kursus: " . $course->title;
            $transaction->amount = $course->discounted_price ?? $course->original_price;
            $transaction->date = now();
            $transaction->save();
    
            // Add course to user's enrolled courses
            $user->enrolledCourses()->attach($course->id);
    
            // Send invoice email
            Mail::to($user->email)->send(new InvoiceMail($transaction));
    
            // Pass success message to session
            return redirect()->route('siswa.dashboard')->with('success', 'Pembayaran berhasil dan kursus telah ditambahkan ke akun Anda.');
        } else {
            return redirect()->route('payment.form', $course->id)->with('error', 'Pembayaran gagal. Silakan coba lagi.');
        }
    }
    
    private function fakePaymentProcessing($paymentMethod)
    {
        // Simulate a delay for payment processing
        sleep(2);
    
        // Simulate payment success
        return true;
    }
    
   
public function cancelPayment()
{
    return redirect()->route('siswa.courses')->with('info', 'Pembayaran dibatalkan.'); 
}
}