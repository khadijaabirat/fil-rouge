<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AL-KHAIR') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary-container": "#021c36",
              "secondary-container": "#feb700",
              "surface": "#f8f9fb",
              "on-surface": "#191c1e",
              "surface-container-lowest": "#ffffff",
              "outline-variant": "#c4c6ce",
            },
            fontFamily: {
              "headline": ["Manrope", "sans-serif"],
              "body": ["Inter", "sans-serif"],
            }
          }
        }
      }
    </script>
</head>
<body class="font-body text-on-surface antialiased bg-surface selection:bg-secondary-container/30">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
        
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-container/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-secondary-container/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 mb-4 mt-10 sm:mt-0">
            <a href="/" class="flex flex-col items-center gap-3 group">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-container to-slate-800 text-secondary-container flex items-center justify-center font-headline font-black text-2xl shadow-lg group-hover:scale-105 transition-transform duration-300 border border-outline-variant/20">
                    AK
                </div>
                <span class="font-headline font-extrabold text-2xl tracking-tight text-primary-container">AL-KHAIR</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-surface-container-lowest shadow-xl shadow-primary-container/5 border border-outline-variant/20 overflow-hidden sm:rounded-[2rem] relative z-10">
            {{ $slot }}
        </div>
        
    </div>
</body>
</html>