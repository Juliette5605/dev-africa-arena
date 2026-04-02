<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class QrCodeController extends Controller
{
    public function show()
    {
        $url = route('criteres');
        return view('admin.qrcode', compact('url'));
    }
}
