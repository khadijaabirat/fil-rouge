<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #0A1128; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .info-row { margin: 15px 0; padding: 10px; background: white; border-radius: 6px; }
        .label { font-weight: bold; color: #0A1128; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Nouveau Message de Contact</h1>
        </div>
        
        <div class="content">
            <div class="info-row">
                <span class="label">Nom:</span> {{ $data['name'] }}
            </div>
            
            <div class="info-row">
                <span class="label">Email:</span> {{ $data['email'] }}
            </div>
            
            <div class="info-row">
                <span class="label">Sujet:</span> {{ $data['subject'] }}
            </div>
            
            <div class="info-row">
                <span class="label">Message:</span>
                <p style="margin-top: 10px; white-space: pre-wrap;">{{ $data['message'] }}</p>
            </div>
        </div>
        
        <div class="footer">
            <p>Ce message a été envoyé depuis le formulaire de contact de AL-KHAIR</p>
            <p>&copy; {{ date('Y') }} AL-KHAIR - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
