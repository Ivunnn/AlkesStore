<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Halaman form feedback
    public function index()
    {
        return view('user.feedback.index');
    }

    // Simpan feedback ke database
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Feedback berhasil dikirim! Terima kasih atas masukan Anda.');
    }

    // Untuk admin melihat semua feedback
    public function adminIndex()
    {
        $feedbacks = Feedback::with('user')->latest()->get();
        return view('admin.feedback.index', compact('feedbacks'));
    }
}
