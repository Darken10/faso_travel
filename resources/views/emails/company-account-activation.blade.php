<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            line-height: 1.6;
            color: #2c3e50;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 16px;
            opacity: 0.95;
        }
        .content {
            padding: 40px;
        }
        .welcome-box {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-left: 4px solid #0ea5e9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .welcome-box h2 {
            color: #0369a1;
            font-size: 18px;
            margin-bottom: 8px;
        }
        .welcome-box p {
            color: #0c4a6e;
            font-size: 15px;
        }
        .user-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
            flex-shrink: 0;
        }
        .user-info h3 {
            color: #1e293b;
            font-size: 16px;
            margin-bottom: 4px;
        }
        .user-info p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .roles {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 8px;
        }
        .role-badge {
            display: inline-block;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #0369a1;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .section-title {
            color: #1e293b;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 30px 0 20px 0;
            border-bottom: 2px solid #f59e0b;
            padding-bottom: 10px;
        }
        .info-item {
            margin-bottom: 16px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 6px;
        }
        .info-item strong {
            color: #1e293b;
            display: block;
            font-size: 14px;
            margin-bottom: 4px;
        }
        .info-item span {
            color: #64748b;
            font-size: 13px;
        }
        .cta-section {
            text-align: center;
            margin: 40px 0;
            padding: 30px;
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 10px;
            border: 1px solid #fbbf24;
        }
        .cta-section p {
            color: #78350f;
            font-size: 14px;
            margin-bottom: 16px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white !important;
            padding: 14px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }
        .footer {
            background: #f8fafc;
            padding: 24px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 10px;
        }
        .footer a {
            color: #0ea5e9;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .security-notice {
            background: #f5f3ff;
            border-left: 4px solid #a78bfa;
            color: #6b21a8;
            padding: 12px;
            border-radius: 6px;
            font-size: 12px;
            margin-top: 20px;
        }
        .security-notice strong {
            display: block;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenue ! 🎉</h1>
            <p>Votre compte a été créé</p>
        </div>

        <div class="content">
            <div class="welcome-box">
                <h2>Bonjour {{ $userName }},</h2>
                <p>Un compte a été créé pour vous au sein de <strong>{{ $companyName }}</strong> sur la plateforme <strong>{{ config('app.name') }}</strong>.</p>
            </div>

            <div class="user-card">
                <div class="user-avatar">{{ strtoupper(substr(explode(' ', trim($userName))[0], 0, 1)) }}</div>
                <div class="user-info">
                    <h3>{{ $userName }}</h3>
                    <p>{{ request()->root() }}</p>
                    @if($roles)
                        <div class="roles">
                            @php
                                $roleArray = is_array($roles) ? $roles : explode(', ', $roles);
                            @endphp
                            @foreach($roleArray as $role)
                                <span class="role-badge">{{ trim($role) }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="cta-section">
                <p><strong>Étape suivante :</strong></p>
                <p>Activez votre compte en cliquant sur le bouton ci-dessous pour définir votre mot de passe</p>
                <a href="{{ $activationUrl }}" class="cta-button">Activer mon compte</a>
            </div>

            <div class="section-title">📋 Informations importantes</div>

            <div class="info-item">
                <strong>Lien d'activation</strong>
                <span>Ce lien expire le <strong>{{ $expiresAt }}</strong> (24 heures). Activez votre compte au plus tôt.</span>
            </div>

            <div class="info-item">
                <strong>Définir votre mot de passe</strong>
                <span>Une fois le lien activé, vous pourrez définir votre mot de passe personnel et accéder à votre espace.</span>
            </div>

            <div class="info-item">
                <strong>Besoin d'aide ?</strong>
                <span>Si vous avez des questions, contactez l'administrateur de votre compagnie.</span>
            </div>

            <div class="security-notice">
                <strong>🔒 Sécurité</strong>
                Si vous n'avez pas demandé la création de ce compte, veuillez ignorer cet email. Ne partagez jamais votre lien d'activation.
            </div>
        </div>

        <div class="footer">
            <p><strong>{{ config('app.name') }}</strong></p>
            <p>
                © {{ date('Y') }} Faso Travel. Tous droits réservés.<br>
                <a href="#">Politique de confidentialité</a> | <a href="#">Conditions d'utilisation</a>
            </p>
        </div>
    </div>
</body>
</html>
