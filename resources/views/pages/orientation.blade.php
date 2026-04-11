@extends('layouts.app')

@push('styles')
<style>
    
    
</style>
@endpush

@section('content')
<div class="back" style="min-height: 100vh;padding: 50px 20px; font-family: sans-serif;
display: flex; align-items: center; position: relative;
    background: none">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="text-align: center; margin-bottom: 60px;">
            <h1 style="font-size: 3rem; font-weight: 800; color: #1e1b4b; margin-bottom: 10px;">
                Centre d'Orientation <span style="color: #b45309;">DevAfrica Arena</span>
            </h1>
            <p style="font-size: 1.25rem; color: #4b5563;">
                Propulsez votre carrière à 25 ans grâce à la puissance de l'intelligence artificielle.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            
            <div style="background-color: white; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border-top: 8px solid #1d4ed8; padding: 30px; transition: transform 0.3s ease;">
                <div style="color: #1d4ed8; margin-bottom: 20px;">
                    <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin-bottom: 15px;">Optimiser mon CV</h2>
                <p style="color: #4b5563; margin-bottom: 25px; line-height: 1.6;">L'IA analyse votre parcours et génère un CV sur-mesure pour les recruteurs du secteur Tech.</p>
                <a href="#" style="display: inline-block; background-color: #1d4ed8; color: white; font-weight: 600; padding: 12px 25px; border-radius: 50px; text-decoration: none;">
                    Générer mon CV
                </a>
            </div>

            <div style="background-color: #1e1b4b; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border-top: 8px solid #f59e0b; padding: 30px; color: white;">
                <div style="color: #f59e0b; margin-bottom: 20px;">
                    <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 15px;">Match de Carrière</h2>
                <p style="color: #e0e7ff; margin-bottom: 25px; line-height: 1.6;">Découvrez les entreprises à Lomé ou en Europe qui correspondent à votre profil de développeur.</p>
                <a href="#" style="display: inline-block; background-color: #f59e0b; color: #1e1b4b; font-weight: 700; padding: 12px 25px; border-radius: 50px; text-decoration: none;">
                    Voir mes matchs
                </a>
            </div>

            <div style="background-color: white; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border-top: 8px solid #e5e7eb; padding: 30px;">
                <div style="color: #9ca3af; margin-bottom: 20px;">
                    <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin-bottom: 15px;">Réorientation</h2>
                <p style="color: #4b5563; margin-bottom: 25px; line-height: 1.6;">Ancien juriste ? Nous vous aidons à transformer vos compétences en atouts numériques.</p>
                <a href="#" style="display: inline-block; border: 2px solid #1d4ed8; color: #1d4ed8; font-weight: 600; padding: 10px 25px; border-radius: 50px; text-decoration: none;">
                    Demander conseil
                </a>
            </div>

        </div>

        <div style="margin-top: 60px; background-color: white; padding: 40px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); text-align: center;">
            <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827;">Besoin d'une aide personnalisée ?</h3>
            <p style="color: #6b7280; margin-top: 10px;">Nos tuteurs D-CLIC sont disponibles pour vous accompagner dans chaque étape.</p>
        </div>
    </div>
</div>
@endsection