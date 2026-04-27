<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Aref+Ruqaa:wght@700&family=Manrope:wght@800&display=swap');
            
            .arabic-text { 
                font-family: 'Aref Ruqaa', serif; 
                font-size: 60px; 
                font-weight: 700; 
                fill: url(#gold-grad); 
                text-anchor: middle; 
            }
            .latin-text { 
                font-family: 'Manrope', sans-serif; 
                font-size: 13px; 
                font-weight: 800; 
                fill: currentColor; 
                text-anchor: middle; 
                letter-spacing: 2px; 
            }
        </style>
        
        <linearGradient id="gold-grad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#FFD085" />
            <stop offset="100%" stop-color="#F5A623" />
        </linearGradient>
    </defs>

    <circle cx="50" cy="42" r="20" fill="#F5A623" opacity="0.15" filter="blur(6px)" />

    <text x="50" y="52" class="arabic-text">الخير</text>

    <text x="51" y="70" class="latin-text">AL-KHAIR</text>

    <line x1="38" y1="78" x2="62" y2="78" stroke="url(#gold-grad)" stroke-width="1.5" stroke-linecap="round"/>
</svg>