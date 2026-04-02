@extends('admin.layout')
@section('title', 'QR Code')
@section('page-title', ' QR Code Candidature')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="admin-card p-5 text-center">
            <h5 class="fw-bold mb-2">Lien de candidature</h5>
            <p class="text-muted small mb-4">Partagez ce QR code lors des événements pour que les candidats s'inscrivent directement.</p>

            <div class="d-flex justify-content-center mb-4">
                <div id="qrcode" style="background:#fff;padding:20px;border-radius:16px;border:2px solid #f39c12;display:inline-block;"></div>
            </div>

            <div class="p-3 rounded-3 mb-4" style="background:#f8f9fa;word-break:break-all;">
                <code style="font-size:0.85rem;color:#f39c12;">{{ $url }}</code>
            </div>

            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <button onclick="downloadQR()" class="btn fw-bold rounded-3 px-4 py-2"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    <i class="bi bi-download me-2"></i>Télécharger PNG
                </button>
                <button onclick="navigator.clipboard.writeText('{{ $url }}').then(()=>alert('Lien copié !'))"
                        class="btn fw-bold rounded-3 px-4 py-2"
                        style="background:#f8f9fa;color:#555;">
                    <i class="bi bi-clipboard me-2"></i>Copier le lien
                </button>
            </div>

            <hr class="my-4">
            <p class="text-muted small mb-2">Imprimez ce QR code pour l'afficher lors des événements.</p>
            <button onclick="window.print()" class="btn fw-bold rounded-3 px-4 py-2"
                    style="background:#222;color:white;">
                <i class="bi bi-printer me-2"></i>Imprimer
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
const url = "{{ $url }}";
QRCode.toCanvas(document.createElement('canvas'), url, {
    width: 220, margin: 2,
    color: { dark: '#222222', light: '#ffffff' }
}, function(err, canvas) {
    if (!err) {
        canvas.id = 'qr-canvas';
        canvas.style.borderRadius = '8px';
        document.getElementById('qrcode').appendChild(canvas);
    }
});

function downloadQR() {
    const canvas = document.getElementById('qr-canvas');
    if (!canvas) return;
    const link = document.createElement('a');
    link.download = 'devafrica-arena-qrcode.png';
    link.href = canvas.toDataURL();
    link.click();
}
</script>
<style>
@media print {
    .sidebar, .topbar, .page-body > *:not(.row) { display:none!important; }
    .admin-card { border:none!important; box-shadow:none!important; }
}
</style>
@endpush
