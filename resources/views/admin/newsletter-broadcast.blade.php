@extends('admin.layout')
@section('title', 'Envoyer Newsletter')
@section('page-title', ' Envoyer une Newsletter')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        @if(session('success'))
        <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(220,38,38,0.1);color:#dc2626;">{{ session('error') }}</div>
        @endif

        <div class="admin-card p-4 mb-4">
            <div class="d-flex align-items-center gap-3 p-3 rounded-3 mb-4" style="background:#fff8eb;border:1px solid rgba(243,156,18,0.2);">
                <div style="font-size:2rem;"></div>
                <div>
                    <p class="fw-bold mb-0">{{ $count }} abonné(s) recevront cet email</p>
                    <p class="text-muted mb-0 small">L'envoi sera effectué immédiatement à toute la liste.</p>
                </div>
            </div>

            <form action="{{ route('admin.newsletter.broadcast.send') }}" method="POST"
                  onsubmit="return confirm('Envoyer à {{ $count }} abonné(s) ? Cette action est irréversible.')">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold small">Objet de l'email *</label>
                    <input type="text" name="subject" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Ex: Ouverture des candidatures — Édition #2 2026"
                           value="{{ old('subject', \App\Models\Setting::get('newsletter_subject')) }}" required>
                    @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Contenu du message *</label>
                    <textarea name="message" class="form-control rounded-3 border-0 bg-light py-3" rows="10"
                              placeholder="Rédigez votre message ici..." required>{{ old('message') }}</textarea>
                    @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    <p class="text-muted small mt-1">Le message sera mis en forme automatiquement dans un template HTML DevAfricaArena.</p>
                </div>

                {{-- Aperçu --}}
                <div class="mb-4 p-3 rounded-3" style="background:#f8f9fa;border:1px solid #eee;">
                    <p class="fw-bold small mb-2"> Aperçu expéditeur</p>
                    <p class="small mb-0 text-muted">
                        <strong>De :</strong> {{ \App\Models\Setting::get('site_name','DevAfricaArena') }} &lt;{{ env('MAIL_FROM_ADDRESS','arena@devafrica.tg') }}&gt;<br>
                        <strong>À :</strong> {{ $count }} abonné(s)
                    </p>
                </div>

                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;font-size:1rem;">
                     Envoyer la newsletter maintenant
                </button>
            </form>
        </div>

        <div class="admin-card p-4">
            <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Bonnes pratiques</h6>
            <ul class="small text-muted mb-0 ps-3">
                <li class="mb-2">Testez d'abord avec votre propre email via <a href="{{ route('admin.smtp') }}" style="color:#f39c12;">Config Email → Test d'envoi</a></li>
                <li class="mb-2">L'envoi en masse nécessite un SMTP configuré — le mode Log ne fonctionne pas ici</li>
                <li>Évitez les mots comme "GRATUIT", "URGENT" dans l'objet pour ne pas tomber dans les spams</li>
            </ul>
        </div>
    </div>
</div>
@endsection
