<!DOCTYPE html>

<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>{{ $project->title }} | Al-Khair Foundation</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;600;800&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-container": "#370e00",
                        "error": "#ba1a1a",
                        "surface-dim": "#d8dadc",
                        "primary-container": "#021c36",
                        "on-tertiary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#eceef0",
                        "secondary-container": "#feb700",
                        "tertiary": "#000000",
                        "primary-fixed-dim": "#b1c8e9",
                        "on-tertiary-fixed": "#370e00",
                        "on-error-container": "#93000a",
                        "inverse-on-surface": "#eff1f3",
                        "surface": "#f8f9fb",
                        "on-background": "#191c1e",
                        "on-surface": "#191c1e",
                        "on-secondary-fixed-variant": "#5e4200",
                        "surface-variant": "#e0e3e5",
                        "surface-bright": "#f8f9fb",
                        "error-container": "#ffdad6",
                        "on-tertiary-fixed-variant": "#7f2b00",
                        "surface-tint": "#4a607c",
                        "secondary-fixed-dim": "#ffba20",
                        "surface-container-high": "#e6e8ea",
                        "primary": "#000000",
                        "surface-container-low": "#f2f4f6",
                        "on-surface-variant": "#43474d",
                        "on-secondary-fixed": "#271900",
                        "background": "#f8f9fb",
                        "on-error": "#ffffff",
                        "on-primary-fixed-variant": "#324863",
                        "secondary-fixed": "#ffdea8",
                        "on-primary-container": "#6f85a3",
                        "inverse-surface": "#2d3133",
                        "primary-fixed": "#d2e4ff",
                        "inverse-primary": "#b1c8e9",
                        "outline": "#74777e",
                        "tertiary-fixed": "#ffdbce",
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary-container": "#e05814",
                        "on-secondary": "#ffffff",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#ffb599",
                        "secondary": "#7c5800",
                        "outline-variant": "#c4c6ce",
                        "on-primary-fixed": "#021c36",
                        "on-secondary-container": "#6b4b00"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }
        #map {
            height: 400px;
            width: 100%;
            border-radius: 1rem;
            z-index: 1;
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body selection:bg-secondary-container selection:text-on-secondary-container">
<!-- TopNavBar -->
<nav class="fixed top-0 left-0 right-0 z-50 glass-header shadow-sm border-none">
<div class="flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto">
<div class="text-2xl font-black tracking-tighter text-slate-900 font-headline">Al-Khair</div>
<div class="hidden md:flex items-center gap-8">
<a class="text-amber-600 font-bold border-b-2 border-amber-500 pb-1 font-headline text-sm tracking-tight" href="#">Projects</a>
<a class="text-slate-600 hover:text-slate-900 transition-colors font-headline text-sm tracking-tight" href="#">Impact</a>
<a class="text-slate-600 hover:text-slate-900 transition-colors font-headline text-sm tracking-tight" href="#">Transparency</a>
<a class="text-slate-600 hover:text-slate-900 transition-colors font-headline text-sm tracking-tight" href="#">About</a>
</div>
<div class="flex items-center gap-4">
<span class="text-slate-600 font-headline text-sm font-semibold cursor-pointer">EN/FR</span>
<button class="bg-primary-container text-on-primary px-6 py-2.5 rounded-full font-headline font-semibold text-sm hover:scale-[1.02] transition-transform duration-200 active:scale-95">
                    Donate Now
                </button>
</div>
</div>
<div class="bg-slate-100 h-px w-full opacity-50"></div>
</nav>
<main class="pt-20">
<!-- Hero Section -->
<section class="relative h-[614px] min-h-[500px] w-full overflow-hidden">
<img alt="{{ $project->title }}" class="absolute inset-0 w-full h-full object-cover" src="{{ $project->image ? asset('storage/' . $project->image) : 'https://via.placeholder.com/1920x614' }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
<div class="absolute bottom-0 left-0 right-0 p-12 max-w-7xl mx-auto flex flex-col md:flex-row md:items-end justify-between gap-8">
<div class="max-w-3xl">
<div class="flex items-center gap-3 mb-4">
<span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest font-label">{{ ucfirst(strtolower($project->status)) }}</span>
<span class="text-white/80 font-label text-sm">{{ $project->ville ?? 'Morocco' }}</span>
</div>
<h1 class="text-5xl md:text-7xl font-extrabold text-white font-headline leading-tight tracking-tighter">
                        {{ $project->title }}
                    </h1>
</div>
<div class="flex items-center gap-4 bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
<div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-2 shadow-lg">
<img alt="{{ $project->association->name }}" class="object-contain" src="{{ $project->association->logo ? asset('storage/' . $project->association->logo) : 'https://via.placeholder.com/48' }}"/>
</div>
<div>
<p class="text-white font-bold text-sm leading-none">{{ $project->association->name }}</p>
<p class="text-white/60 text-xs mt-1">Certified Partner</p>
</div>
</div>
</div>
</section>
<!-- Content Grid -->
<div class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-12 gap-16">
<!-- Left Column: Details -->
<div class="lg:col-span-8 space-y-20">
<!-- Description -->
<section>
<h2 class="text-3xl font-black font-headline mb-8 text-primary">Project Mission</h2>
<div class="prose prose-lg max-w-none text-on-surface-variant leading-relaxed">
{!! nl2br(e($project->description)) !!}
</div>
</section>
<!-- Impact Goals -->
<section class="bg-surface-container-low p-10 rounded-2xl">
<h3 class="text-xl font-bold font-headline mb-8 flex items-center gap-2">
<span class="material-symbols-outlined text-secondary">target</span>
                        Impact Goals
                    </h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="space-y-2">
<span class="text-4xl font-black font-headline text-primary">650+</span>
<p class="text-sm font-semibold text-on-surface-variant">Villagers Served</p>
<p class="text-xs text-on-surface-variant/70 leading-snug">Direct access to clean potable water for the entire community.</p>
</div>
<div class="space-y-2">
<span class="text-4xl font-black font-headline text-primary">0%</span>
<p class="text-sm font-semibold text-on-surface-variant">Carbon Footprint</p>
<p class="text-xs text-on-surface-variant/70 leading-snug">Fully powered by sustainable solar energy arrays.</p>
</div>
<div class="space-y-2">
<span class="text-4xl font-black font-headline text-primary">4hrs</span>
<p class="text-sm font-semibold text-on-surface-variant">Time Saved Daily</p>
<p class="text-xs text-on-surface-variant/70 leading-snug">Allowing children to attend school instead of fetching water.</p>
</div>
</div>
</section>
<!-- Previous Impacts -->
<section>
<h2 class="text-2xl font-black font-headline mb-8">Previous Milestones</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="group overflow-hidden rounded-xl bg-surface-container-lowest">
<div class="h-48 overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Children in a classroom learning with new books" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAauCquhx35UpKM4ZHa01vfYKvt5QOrTTJKORoxJg05YM5Q18Dkxy2-Y0JLGvLBI494mycNCaTl9Kudl_-6OyQAmLBVCVvHdwzKWd2hSHzokQb6X7BVbyysGoPEJCwaM2rMfTHVLqJn1NxPCPVgLtul3HswdQB2wvg9U8OXj9CPkL2UffPR5fWGfHUd24U3l2M7kDQRwT7riV-tMX6GkHm-K2YcasQFq9dkjRZ3AWP3AjiMHAB4Ew_gfpURQzQwqI1x3SASnMC-_A"/>
</div>
<div class="p-6">
<span class="text-[10px] font-bold text-on-tertiary-container bg-tertiary-container/10 px-2 py-0.5 rounded uppercase font-label">April 2023</span>
<h4 class="font-bold font-headline mt-2 text-primary">School Supply Drive</h4>
<p class="text-sm text-on-surface-variant mt-2">Provided 200 kits for the local primary school.</p>
</div>
</div>
<div class="group overflow-hidden rounded-xl bg-surface-container-lowest">
<div class="h-48 overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Medical professional treating an elderly patient" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCfP7BQRbh54ZwlfCt9SUBrjHtP_IDf-agpJa23NMfAlhbUhgvuXGUiPJjV5v377jWjv6k0nM5j2BuuR2eS5LfJhrpJP8PIy0PwT230HUautwvqaQgTA1J3yNXGOPZr8lr3pOJFHngnRV8RrALzRGZ-iXh17yrBoFvTpJjhTxKYyHPxNFNxDe9CoVaOa6IoWUMqU5XWH3xuKEL-jorad6th_YxeL80MnP9XzYUJXv9qhXPmjxRLrA5LKZypzkOBa3eyS7qI9TN7AY"/>
</div>
<div class="p-6">
<span class="text-[10px] font-bold text-on-tertiary-container bg-tertiary-container/10 px-2 py-0.5 rounded uppercase font-label">Oct 2023</span>
<h4 class="font-bold font-headline mt-2 text-primary">Mobile Clinic Visit</h4>
<p class="text-sm text-on-surface-variant mt-2">Free medical consultations for 150 elderly residents.</p>
</div>
</div>
</div>
</section>
<!-- Recent Donors Section -->
<section>
<h2 class="text-2xl font-black font-headline mb-8 flex items-center gap-2">
<span class="material-symbols-outlined text-secondary">volunteer_activism</span>
Recent Donors
</h2>
@if($project->donations->count() > 0)
<div class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border border-outline-variant/10">
<div class="space-y-4">
@foreach($project->donations as $donation)
<div class="flex items-center gap-4 p-4 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors">
<div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">favorite</span>
</div>
<div class="flex-1 min-w-0">
<p class="font-bold text-primary text-sm">
{{ $donation->isAnonymous ? 'Anonymous Donor' : ($donation->donator->name ?? 'Anonymous') }}
</p>
<p class="text-xs text-on-surface-variant mt-1">
{{ $donation->created_at->diffForHumans() }}
</p>
@if($donation->message)
<p class="text-xs text-on-surface-variant/80 mt-2 italic line-clamp-2">
"{{ $donation->message }}"
</p>
@endif
</div>
<div class="text-right flex-shrink-0">
<p class="font-black text-secondary text-lg">{{ number_format($donation->amount, 0, ',', ' ') }} DH</p>
<span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant/60">{{ ucfirst(strtolower($donation->status)) }}</span>
</div>
</div>
@endforeach
</div>
@if($project->donations->count() >= 5)
<div class="mt-6 text-center">
<p class="text-xs text-on-surface-variant">Showing recent 5 donations</p>
</div>
@endif
</div>
@else
<div class="bg-surface-container-low rounded-2xl p-12 text-center">
<span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">volunteer_activism</span>
<p class="text-on-surface-variant font-medium">No donations yet</p>
<p class="text-sm text-on-surface-variant/70 mt-2">Be the first to support this project!</p>
</div>
@endif
</section>

<!-- Interactive Map -->
<section>
<div class="flex justify-between items-center mb-6">
<h2 class="text-2xl font-black font-headline">Location Transparency</h2>
<div class="flex items-center gap-2 text-on-surface-variant">
<span class="material-symbols-outlined text-sm">location_on</span>
<span class="text-xs font-semibold uppercase tracking-wider font-label">{{ $project->ville ?? 'Morocco' }}</span>
</div>
</div>
<div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10">
<div id="map"></div>
<div class="mt-4 p-4 bg-primary-container/5 rounded-xl border border-primary-container/20">
<p class="text-xs font-medium text-primary">📍 Precise coordinates and real-time installation updates are shared with verified donors.</p>
</div>
</div>
</section>
</div>
<!-- Right Column: Sticky Sidebar -->
<div class="lg:col-span-4">
<div class="sticky top-32 space-y-8">
<!-- Donation Card -->
<div class="bg-surface-container-lowest p-8 rounded-3xl shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] border border-outline-variant/10">
<div class="mb-8">
<div class="flex justify-between items-end mb-4">
<span class="text-sm font-bold text-primary font-headline">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
<span class="text-xs font-semibold text-on-surface-variant font-label uppercase">Goal: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
</div>
<!-- Progress Bar -->
@php
    $percentage = $project->goalAmount > 0 ? min(($project->currentAmount / $project->goalAmount) * 100, 100) : 0;
@endphp
<div class="h-3 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container rounded-full" style="width: {{ $percentage }}%"></div>
</div>
<p class="text-xs font-medium text-on-surface-variant mt-4 text-center">{{ number_format($percentage, 0) }}% Funded by {{ $project->donations->count() }} generous donors</p>
</div>
<div class="space-y-4 mb-8">
<div class="flex justify-between p-4 rounded-xl border border-outline-variant/20 hover:border-secondary transition-colors cursor-pointer group">
<span class="font-bold text-primary">500 DH</span>
<span class="material-symbols-outlined text-outline-variant group-hover:text-secondary">arrow_forward_ios</span>
</div>
<div class="flex justify-between p-4 rounded-xl border border-secondary bg-secondary/5 cursor-pointer">
<span class="font-bold text-secondary">1,000 DH</span>
<span class="material-symbols-outlined text-secondary">check_circle</span>
</div>
<div class="flex justify-between p-4 rounded-xl border border-outline-variant/20 hover:border-secondary transition-colors cursor-pointer group">
<span class="font-bold text-primary">2,500 DH</span>
<span class="material-symbols-outlined text-outline-variant group-hover:text-secondary">arrow_forward_ios</span>
</div>
<input class="w-full p-4 rounded-xl border-outline-variant/20 bg-surface focus:ring-secondary focus:border-secondary text-sm font-bold" placeholder="Custom Amount (DH)" type="text"/>
</div>
@if($project->status === 'OPEN')
<a href="{{ route('donations.create', $project->id) }}" class="block w-full bg-secondary text-white py-5 rounded-xl font-headline font-black text-lg hover:bg-secondary-container hover:text-on-secondary-container transition-all duration-300 shadow-lg shadow-secondary/20 active:scale-95 text-center">
                            Donate Now
                        </a>
@else
<button disabled class="w-full bg-gray-400 text-white py-5 rounded-xl font-headline font-black text-lg cursor-not-allowed">
                            Project {{ ucfirst(strtolower($project->status)) }}
                        </button>
@endif
<div class="mt-6 flex items-center justify-center gap-2 text-on-surface-variant/60">
<span class="material-symbols-outlined text-sm">lock</span>
<span class="text-[10px] font-bold uppercase tracking-widest font-label">Secured by Al-Khair Trust</span>
</div>
</div>
<!-- Allocation Breakdown -->
<div class="bg-primary-container p-8 rounded-3xl text-white">
<h4 class="text-sm font-bold uppercase tracking-widest font-label text-secondary-container mb-6">Fund Allocation</h4>
<ul class="space-y-4">
<li class="flex items-center gap-4">
<div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
<span class="text-xs font-bold">55%</span>
</div>
<div class="flex-1">
<p class="text-xs font-bold">Materials &amp; Hardware</p>
<div class="h-1 w-full bg-white/10 mt-1"><div class="h-full bg-secondary-container w-[55%]"></div></div>
</div>
</li>
<li class="flex items-center gap-4">
<div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
<span class="text-xs font-bold">30%</span>
</div>
<div class="flex-1">
<p class="text-xs font-bold">Specialized Labor</p>
<div class="h-1 w-full bg-white/10 mt-1"><div class="h-full bg-secondary-container w-[30%]"></div></div>
</div>
</li>
<li class="flex items-center gap-4">
<div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
<span class="text-xs font-bold">15%</span>
</div>
<div class="flex-1">
<p class="text-xs font-bold">Logistics &amp; Maintenance</p>
<div class="h-1 w-full bg-white/10 mt-1"><div class="h-full bg-secondary-container w-[15%]"></div></div>
</div>
</li>
</ul>
<div class="mt-8 pt-6 border-t border-white/10">
<p class="text-[10px] text-white/50 leading-relaxed italic">Al-Khair guarantees that 100% of your donation (minus payment processing fees) reaches this specific project.</p>
</div>
</div>
</div>
</div>
</div>
</main>
<!-- Footer -->
<footer class="bg-slate-50 border-t-0">
<div class="grid grid-cols-1 md:grid-cols-4 gap-12 px-8 py-16 max-w-7xl mx-auto">
<div class="col-span-1 md:col-span-1">
<div class="text-xl font-bold text-slate-900 font-headline mb-4">Al-Khair</div>
<p class="text-sm text-slate-500 leading-relaxed mb-6 font-body">Empowering rural communities through sustainable infrastructure and education in the heart of Morocco.</p>
<div class="flex gap-4">
<span class="material-symbols-outlined text-slate-400 cursor-pointer hover:text-amber-500">public</span>
<span class="material-symbols-outlined text-slate-400 cursor-pointer hover:text-amber-500">mail</span>
</div>
</div>
<div>
<h5 class="font-bold text-slate-900 text-sm mb-6 uppercase tracking-widest font-label">Links</h5>
<ul class="space-y-4">
<li><a class="text-slate-500 text-sm hover:text-amber-500 transition-colors" href="#">Privacy Policy</a></li>
<li><a class="text-slate-500 text-sm hover:text-amber-500 transition-colors" href="#">Terms of Service</a></li>
<li><a class="text-slate-500 text-sm hover:text-amber-500 transition-colors" href="#">Annual Reports</a></li>
</ul>
</div>
<div>
<h5 class="font-bold text-slate-900 text-sm mb-6 uppercase tracking-widest font-label">Get Involved</h5>
<ul class="space-y-4">
<li><a class="text-slate-500 text-sm hover:text-amber-500 transition-colors" href="#">Contact Us</a></li>
<li><a class="text-slate-500 text-sm hover:text-amber-500 transition-colors" href="#">Volunteer</a></li>
<li><a class="text-slate-500 text-sm hover:text-amber-500 transition-colors" href="#">Partner With Us</a></li>
</ul>
</div>
<div>
<h5 class="font-bold text-slate-900 text-sm mb-6 uppercase tracking-widest font-label">Newsletter</h5>
<p class="text-xs text-slate-500 mb-4">Subscribe for monthly impact stories.</p>
<div class="flex gap-2">
<input class="bg-white border-slate-200 text-xs rounded-lg flex-1" placeholder="Email" type="email"/>
<button class="bg-primary-container text-white px-4 py-2 rounded-lg text-xs font-bold">Join</button>
</div>
</div>
</div>
<div class="max-w-7xl mx-auto px-8 pb-12">
<div class="bg-slate-200/50 h-px w-full mb-8"></div>
<p class="text-[10px] text-slate-500 font-label">© 2024 Al-Khair Foundation. All rights reserved. Registered Moroccan Charity.</p>
</div>
</footer>
<!-- BottomNavBar (Hidden on Desktop) -->
<nav class="fixed bottom-0 left-0 w-full flex justify-around items-center h-16 md:hidden px-4 pb-safe bg-white shadow-[0_-4px_20px_0_rgba(0,0,0,0.05)] rounded-t-2xl z-50">
<div class="flex flex-col items-center justify-center text-slate-400">
<span class="material-symbols-outlined">explore</span>
<span class="font-['Inter'] text-[10px] font-medium uppercase tracking-widest">Explore</span>
</div>
<div class="flex flex-col items-center justify-center text-amber-600">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">favorite</span>
<span class="font-['Inter'] text-[10px] font-medium uppercase tracking-widest">My Gifts</span>
</div>
<div class="flex flex-col items-center justify-center text-slate-400">
<span class="material-symbols-outlined">equalizer</span>
<span class="font-['Inter'] text-[10px] font-medium uppercase tracking-widest">Impact</span>
</div>
<div class="flex flex-col items-center justify-center text-slate-400">
<span class="material-symbols-outlined">person</span>
<span class="font-['Inter'] text-[10px] font-medium uppercase tracking-widest">Profile</span>
</div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const latitude = {{ $project->latitude ?? 31.7917 }};
        const longitude = {{ $project->longitude ?? -7.0926 }};
        
        const map = L.map('map').setView([latitude, longitude], {{ $project->latitude && $project->longitude ? 13 : 6 }});
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
        }).addTo(map);
        
        const customIcon = L.divIcon({
            className: 'custom-marker',
            html: '<div style="background-color: #7c5800; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.3); border: 3px solid white;"><span style="color: white; font-size: 24px;">📍</span></div>',
            iconSize: [40, 40],
            iconAnchor: [20, 40],
        });
        
        const marker = L.marker([latitude, longitude], { icon: customIcon }).addTo(map);
        
        marker.bindPopup(`
            <div style="text-align: center; padding: 8px;">
                <strong style="font-size: 14px; color: #000;">{{ $project->title }}</strong><br>
                <span style="font-size: 12px; color: #666;">{{ $project->ville ?? 'Morocco' }}</span><br>
                <span style="font-size: 11px; color: #7c5800; font-weight: bold;">{{ ucfirst(strtolower($project->status)) }}</span>
            </div>
        `).openPopup();
        
        window.addEventListener('resize', function() {
            map.invalidateSize();
        });
    });
</script>

</body></html>