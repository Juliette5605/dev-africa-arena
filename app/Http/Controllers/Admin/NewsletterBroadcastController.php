<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterBroadcastController extends Controller
{
    public function show()
    {
        $count = Newsletter::count();
        return view('admin.newsletter-broadcast', compact('count'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:20',
        ], [
            'subject.required' => 'L\'objet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
            'message.min'      => 'Le message doit faire au moins 20 caractères.',
        ]);

        $subscribers = Newsletter::all();
        $sent = 0; $failed = 0;

        foreach ($subscribers as $sub) {
            try {
                Mail::send([], [], function ($mail) use ($sub, $request) {
                    $mail->to($sub->email)
                         ->subject($request->subject)
                         ->html($this->buildHtml($request->subject, $request->message, $sub->email));
                });
                $sent++;
            } catch (\Exception $e) {
                $failed++;
            }
        }

        ActivityLog::log('envoyé', 'Newsletter', "Sujet: {$request->subject} — {$sent} envois");
        $msg = "✅ Newsletter envoyée à {$sent} abonné(s).";
        if ($failed > 0) $msg .= " ⚠️ {$failed} échec(s).";
        return back()->with('success', $msg);
    }

    private function buildHtml(string $subject, string $message, string $email): string
    {
        $msg = nl2br(e($message));
        return <<<HTML
<!DOCTYPE html>
<html><head><meta charset="UTF-8">
<style>
  body{font-family:'Segoe UI',Arial,sans-serif;background:#f8f9fa;margin:0;padding:0;}
  .wrap{max-width:580px;margin:40px auto;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);}
  .header{background:linear-gradient(135deg,#f39c12,#e67e22);padding:32px;text-align:center;}
  .header h1{color:#fff;margin:0;font-size:1.4rem;font-weight:800;}
  .body{padding:32px;}
  .body p{color:#444;line-height:1.7;font-size:0.95rem;}
  .footer{background:#f8f9fa;padding:20px;text-align:center;font-size:0.75rem;color:#999;}
  .footer a{color:#f39c12;}
</style>
</head>
<body>
<div class="wrap">
  <div class="header"><h1>🏟️ DevAfricaArena</h1><p style="color:rgba(255,255,255,0.8);margin:6px 0 0;font-size:0.9rem;">{$subject}</p></div>
  <div class="body"><p>{$msg}</p></div>
  <div class="footer">
    © 2026 DevAfricaArena · Lomé, Togo<br>
    <a href="#">Se désabonner</a>
  </div>
</div>
</body></html>
HTML;
    }
}
