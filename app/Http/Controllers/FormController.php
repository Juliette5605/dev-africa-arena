<?php

namespace App\Http\Controllers;

use App\Mail\CandidatureConfirmation;
use App\Models\Candidature;
use App\Models\ContactMessage;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    /**
     * Enregistrement candidature + email de confirmation automatique
     */
    public function storeCandidature(Request $request)
    {
        $validated = $request->validate([
            'nom'        => 'required|string|max:100',
            'prenom'     => 'required|string|max:100',
            'email'      => 'required|email|max:200',
            'age'        => 'required|integer|min:16|max:70',
            'niveau'     => 'required|in:Junior,Intermédiaire,Senior',
            'pays'       => 'required|string|max:100',
            'expertise'  => 'required|string|max:200',
            'diplome'    => 'required|string|max:200',
            'motivation' => 'required|string|min:50|max:2000',
            'vision'     => 'required|string|min:30|max:2000',
        ], [
            'nom.required'        => 'Le nom est obligatoire.',
            'prenom.required'     => 'Le prénom est obligatoire.',
            'email.required'      => 'L\'email est obligatoire.',
            'email.email'         => 'Format d\'email invalide.',
            'age.min'             => 'L\'âge minimum requis est 16 ans.',
            'niveau.required'     => 'Veuillez sélectionner votre niveau.',
            'niveau.in'           => 'Niveau invalide.',
            'pays.required'       => 'Le pays est obligatoire.',
            'expertise.required'  => 'L\'expertise est obligatoire.',
            'diplome.required'    => 'Le diplôme est obligatoire.',
            'motivation.required' => 'La motivation est obligatoire.',
            'motivation.min'      => 'La motivation doit faire au moins 50 caractères.',
            'vision.required'     => 'La vision tech est obligatoire.',
            'vision.min'          => 'La vision doit faire au moins 30 caractères.',
        ]);

        $candidature = Candidature::create($validated);

        // Email de confirmation automatique (silencieux si non configuré)
        try {
            Mail::to($candidature->email)->send(new CandidatureConfirmation($candidature));
        } catch (\Exception $e) {
            // Mail non configuré en local — pas de blocage
        }

        return redirect()->route('criteres')
            ->with('success', '🎉 Candidature soumise avec succès ! Un email de confirmation vous a été envoyé à ' . $candidature->email);
    }

    /**
     * Partenariat Financier
     */
    public function storeFinancier(Request $request)
    {
        $validated = $request->validate([
            'responsable' => 'required|string|max:200',
            'entreprise'  => 'required|string|max:200',
            'telephone'   => 'required|string|max:30',
            'pack'        => 'required|in:DIAMOND,GOLD,SILVER',
        ], [
            'responsable.required' => 'Le nom du responsable est obligatoire.',
            'entreprise.required'  => 'Le nom de l\'entreprise est obligatoire.',
            'telephone.required'   => 'Le téléphone est obligatoire.',
            'pack.required'        => 'Veuillez choisir un pack.',
        ]);

        Partenaire::create(array_merge($validated, ['type' => 'financier']));

        return redirect()->route('partenaires.financier')
            ->with('success', '✅ Dossier de partenariat financier bien reçu ! Notre équipe vous contactera sous 48h.');
    }

    /**
     * Partenariat Technique
     */
    public function storeTechnique(Request $request)
    {
        $validated = $request->validate([
            'responsable'  => 'required|string|max:200',
            'entreprise'   => 'required|string|max:200',
            'email'        => 'required|email|max:200',
            'telephone'    => 'required|string|max:30',
            'type_apport'  => 'required|string|max:200',
            'message'      => 'nullable|string|max:2000',
        ], [
            'responsable.required' => 'Le nom du responsable est obligatoire.',
            'entreprise.required'  => 'Le nom de l\'entreprise est obligatoire.',
            'email.required'       => 'L\'email est obligatoire.',
            'email.email'          => 'L\'email n\'est pas valide.',
            'telephone.required'   => 'Le téléphone est obligatoire.',
            'type_apport.required' => 'Veuillez préciser votre type d\'apport.',
        ]);

        Partenaire::create(array_merge($validated, ['type' => 'technique']));

        return redirect()->route('partenaires.techniques')
            ->with('success', '✅ Proposition de partenariat technique bien transmise. Merci !');
    }

    /**
     * Sponsor
     */
    public function storeSponsor(Request $request)
    {
        $validated = $request->validate([
            'responsable'    => 'required|string|max:200',
            'entreprise'     => 'required|string|max:200',
            'email'          => 'required|email|max:200',
            'telephone'      => 'required|string|max:30',
            'niveau_sponsor' => 'required|in:Sponsor OR,Sponsor ARGENT,Sponsor BRONZE,Sur mesure',
            'message'        => 'nullable|string|max:2000',
        ], [
            'responsable.required'    => 'Le nom du responsable est obligatoire.',
            'entreprise.required'     => 'Le nom de l\'entreprise est obligatoire.',
            'email.required'          => 'L\'email est obligatoire.',
            'email.email'             => 'L\'email n\'est pas valide.',
            'telephone.required'      => 'Le téléphone est obligatoire.',
            'niveau_sponsor.required' => 'Veuillez choisir un niveau de sponsoring.',
        ]);

        Partenaire::create(array_merge($validated, ['type' => 'sponsor']));

        return redirect()->route('partenaires.sponsors')
            ->with('success', '✅ Demande de sponsoring reçue ! Nous vous enverrons notre dossier complet.');
    }

    /**
     * Contact
     */
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'nom'     => 'required|string|max:200',
            'email'   => 'required|email|max:200',
            'sujet'   => 'required|string|max:300',
            'message' => 'required|string|min:20|max:5000',
        ], [
            'message.min' => 'Le message doit faire au moins 20 caractères.',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact')
            ->with('success', '✅ Message envoyé ! Nous vous répondrons dans les plus brefs délais.');
    }
}
