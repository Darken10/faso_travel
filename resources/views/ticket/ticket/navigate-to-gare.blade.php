@extends("layout")

@section('title', 'Navigation vers la gare')

@section('content')

<div x-data="navigationMap()" x-init="init()" class="max-w-2xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="card">
        <div class="flex items-center gap-3">
            <a href="{{ route('ticket.show-ticket', $ticket) }}" class="w-10 h-10 rounded-xl bg-surface-100 dark:bg-surface-700 flex items-center justify-center hover:bg-surface-200 dark:hover:bg-surface-600 transition-colors">
                <svg class="w-5 h-5 text-surface-600 dark:text-surface-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
            </a>
            <div class="flex-1">
                <h1 class="text-lg font-bold text-surface-900 dark:text-white">Navigation vers la gare</h1>
                <p class="text-sm text-surface-500 dark:text-surface-400">{{ $gareName ?? 'Gare de départ' }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center shadow-lg shadow-primary-500/25">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Info cards --}}
    <div class="grid grid-cols-2 gap-3">
        <div class="card text-center" x-show="distance !== null">
            <p class="text-[10px] uppercase tracking-wider text-surface-400 dark:text-surface-500 font-medium">Distance</p>
            <p class="text-lg font-bold text-primary-600 dark:text-primary-400 mt-0.5" x-text="distance"></p>
        </div>
        <div class="card text-center" x-show="duration !== null">
            <p class="text-[10px] uppercase tracking-wider text-surface-400 dark:text-surface-500 font-medium">Durée estimée</p>
            <p class="text-lg font-bold text-accent-600 dark:text-accent-400 mt-0.5" x-text="duration"></p>
        </div>
    </div>

    {{-- Map container --}}
    <div class="card !p-0 overflow-hidden">
        {{-- Status bar --}}
        <div class="px-4 py-2.5 bg-surface-50 dark:bg-surface-900 border-b border-surface-200 dark:border-surface-700 flex items-center gap-2">
            <template x-if="status === 'loading'">
                <div class="flex items-center gap-2 text-surface-500">
                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    <span class="text-xs font-medium">Localisation en cours...</span>
                </div>
            </template>
            <template x-if="status === 'tracking'">
                <div class="flex items-center gap-2 text-success-600 dark:text-success-400">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-success-500"></span>
                    </span>
                    <span class="text-xs font-medium">Suivi en temps réel actif</span>
                </div>
            </template>
            <template x-if="status === 'error'">
                <div class="flex items-center gap-2 text-danger-600 dark:text-danger-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                    <span class="text-xs font-medium" x-text="errorMsg"></span>
                </div>
            </template>
        </div>

        {{-- Map --}}
        <div id="navigation-map" class="w-full" style="height: 400px; z-index: 1;"></div>
    </div>

    {{-- Action buttons --}}
    <div class="space-y-2">
        {{-- Google Maps button --}}
        <a :href="googleMapsUrl" target="_blank" rel="noopener noreferrer"
           class="card group flex items-center gap-4 hover:shadow-elevated hover:border-success-300 dark:hover:border-success-500 transition-all duration-300 cursor-pointer">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-success-500 to-success-600 flex items-center justify-center shadow-lg shadow-success-500/25 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-semibold text-surface-900 dark:text-white group-hover:text-success-600 dark:group-hover:text-success-400 transition-colors">Ouvrir dans Google Maps</p>
                <p class="text-sm text-surface-500 dark:text-surface-400">Guidage vocal et navigation détaillée</p>
            </div>
            <svg class="w-5 h-5 text-surface-300 dark:text-surface-600 group-hover:text-success-500 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
        </a>

        {{-- Recenter button --}}
        <button @click="recenter()"
                class="card group flex items-center gap-4 hover:shadow-soft transition-all duration-200 cursor-pointer w-full text-left">
            <div class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center group-hover:bg-primary-200 dark:group-hover:bg-primary-900/50 transition-colors">
                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M12 9v6m3-3H9" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-surface-900 dark:text-white">Recentrer la carte</p>
            </div>
        </button>
    </div>

    {{-- Gare info footer --}}
    <div class="card bg-surface-50 dark:bg-surface-900 border-surface-200 dark:border-surface-700">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-lg bg-accent-100 dark:bg-accent-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-accent-600 dark:text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-surface-900 dark:text-white">{{ $gareName ?? 'Gare de départ' }}</p>
                <p class="text-xs text-surface-500 dark:text-surface-400 mt-0.5">
                    {{ $ticket?->voyageInstance?->villeDepart()?->name ?? 'Ville' }}
                    @if($ticket?->voyageInstance?->date)
                        &bull; {{ $ticket->voyageInstance->date->format('d/m/Y') }}
                        @if($ticket?->voyageInstance?->heure)
                            à {{ $ticket->voyageInstance->heure->format('H\hi') }}
                        @endif
                    @endif
                </p>
                @if($gareLat && $gareLng)
                    <p class="text-[10px] text-surface-400 dark:text-surface-500 mt-1 font-mono">{{ $gareLat }}, {{ $gareLng }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

{{-- Leaflet Routing Machine --}}
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>

<script>
function navigationMap() {
    return {
        map: null,
        userMarker: null,
        gareMarker: null,
        routingControl: null,
        fallbackLine: null,
        watchId: null,
        userLat: null,
        userLng: null,
        gareLat: @json($gareLat ?? null),
        gareLng: @json($gareLng ?? null),
        status: 'loading',
        errorMsg: '',
        distance: null,
        duration: null,

        get googleMapsUrl() {
            const dest = `${this.gareLat},${this.gareLng}`;
            if (this.userLat && this.userLng) {
                return `https://www.google.com/maps/dir/?api=1&origin=${this.userLat},${this.userLng}&destination=${dest}&travelmode=driving`;
            }
            return `https://www.google.com/maps/dir/?api=1&destination=${dest}&travelmode=driving`;
        },

        init() {
            if (!this.gareLat || !this.gareLng) {
                this.status = 'error';
                this.errorMsg = 'Coordonnées de la gare non disponibles';
                this.initMapFallback();
                return;
            }

            this.map = L.map('navigation-map').setView([this.gareLat, this.gareLng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19,
            }).addTo(this.map);

            // Gare marker
            const gareIcon = L.divIcon({
                html: `<div style="background: linear-gradient(135deg, #f97316, #ea580c); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 4px 12px rgba(249,115,22,0.4);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75"/></svg>
                </div>`,
                className: '',
                iconSize: [36, 36],
                iconAnchor: [18, 18],
            });
            this.gareMarker = L.marker([this.gareLat, this.gareLng], { icon: gareIcon }).addTo(this.map);
            this.gareMarker.bindPopup(`<strong>{{ $gareName ?? 'Gare de départ' }}</strong>`).openPopup();

            this.startTracking();
        },

        initMapFallback() {
            this.map = L.map('navigation-map').setView([12.3714, -1.5197], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19,
            }).addTo(this.map);
        },

        startTracking() {
            if (!navigator.geolocation) {
                this.status = 'error';
                this.errorMsg = 'La géolocalisation n\'est pas supportée par votre navigateur';
                return;
            }

            this.watchId = navigator.geolocation.watchPosition(
                (position) => {
                    this.userLat = position.coords.latitude;
                    this.userLng = position.coords.longitude;
                    this.status = 'tracking';
                    this.updateUserMarker();
                    this.updateRoute();
                },
                (error) => {
                    this.status = 'error';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            this.errorMsg = 'Veuillez autoriser l\'accès à votre position';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            this.errorMsg = 'Position indisponible';
                            break;
                        case error.TIMEOUT:
                            this.errorMsg = 'Délai de localisation dépassé';
                            break;
                        default:
                            this.errorMsg = 'Erreur de localisation';
                    }
                },
                {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 5000,
                }
            );
        },

        updateUserMarker() {
            const userIcon = L.divIcon({
                html: `<div style="position: relative;">
                    <div style="background: #3b82f6; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(59,130,246,0.5);"></div>
                    <div style="position: absolute; top: -4px; left: -4px; width: 28px; height: 28px; border-radius: 50%; border: 2px solid rgba(59,130,246,0.3); animation: ping 1.5s cubic-bezier(0,0,0.2,1) infinite;"></div>
                </div>`,
                className: '',
                iconSize: [20, 20],
                iconAnchor: [10, 10],
            });

            if (this.userMarker) {
                this.userMarker.setLatLng([this.userLat, this.userLng]);
            } else {
                this.userMarker = L.marker([this.userLat, this.userLng], { icon: userIcon }).addTo(this.map);
                this.userMarker.bindPopup('<strong>Votre position</strong>');

                // Fit bounds to show both markers
                const bounds = L.latLngBounds(
                    [this.userLat, this.userLng],
                    [this.gareLat, this.gareLng]
                );
                this.map.fitBounds(bounds, { padding: [50, 50] });
            }
        },

        haversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                      Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        },

        drawFallbackLine() {
            if (this.fallbackLine) {
                this.map.removeLayer(this.fallbackLine);
            }
            this.fallbackLine = L.polyline(
                [[this.userLat, this.userLng], [this.gareLat, this.gareLng]],
                { color: '#3b82f6', weight: 4, opacity: 0.7, dashArray: '10, 10' }
            ).addTo(this.map);

            const distKm = this.haversineDistance(this.userLat, this.userLng, this.gareLat, this.gareLng);
            this.distance = distKm >= 1 ? `~${distKm.toFixed(1)} km` : `~${Math.round(distKm * 1000)} m`;
            const avgSpeedKmh = 40;
            const durMin = Math.round((distKm / avgSpeedKmh) * 60);
            this.duration = durMin >= 60
                ? `~${Math.floor(durMin / 60)}h ${durMin % 60}min`
                : `~${durMin} min`;
        },

        updateRoute() {
            // If routing already active, just update waypoints
            if (this.routingControl) {
                this.routingControl.setWaypoints([
                    L.latLng(this.userLat, this.userLng),
                    L.latLng(this.gareLat, this.gareLng)
                ]);
                return;
            }

            // If we already fell back to straight line, update it
            if (this.fallbackLine) {
                this.drawFallbackLine();
                return;
            }

            try {
                this.routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(this.userLat, this.userLng),
                        L.latLng(this.gareLat, this.gareLng)
                    ],
                    router: L.Routing.osrmv1({
                        serviceUrl: 'https://routing.openstreetmap.de/routed-car/route/v1'
                    }),
                    routeWhileDragging: false,
                    addWaypoints: false,
                    draggableWaypoints: false,
                    show: false,
                    createMarker: () => null,
                    lineOptions: {
                        styles: [
                            { color: '#3b82f6', opacity: 0.8, weight: 6 },
                            { color: '#60a5fa', opacity: 0.5, weight: 10 }
                        ]
                    },
                }).addTo(this.map);

                this.routingControl.on('routesfound', (e) => {
                    // Remove fallback line if route found
                    if (this.fallbackLine) {
                        this.map.removeLayer(this.fallbackLine);
                        this.fallbackLine = null;
                    }
                    const route = e.routes[0];
                    const distKm = (route.summary.totalDistance / 1000).toFixed(1);
                    const durMin = Math.round(route.summary.totalTime / 60);

                    this.distance = distKm >= 1 ? `${distKm} km` : `${Math.round(route.summary.totalDistance)} m`;
                    this.duration = durMin >= 60
                        ? `${Math.floor(durMin / 60)}h ${durMin % 60}min`
                        : `${durMin} min`;
                });

                this.routingControl.on('routingerror', () => {
                    // OSRM failed — fall back to straight line
                    if (this.routingControl) {
                        this.map.removeControl(this.routingControl);
                        this.routingControl = null;
                    }
                    this.drawFallbackLine();
                });
            } catch (err) {
                // Routing library error — fall back to straight line
                this.routingControl = null;
                this.drawFallbackLine();
            }
        },

        recenter() {
            if (this.userLat && this.userLng && this.gareLat && this.gareLng) {
                const bounds = L.latLngBounds(
                    [this.userLat, this.userLng],
                    [this.gareLat, this.gareLng]
                );
                this.map.fitBounds(bounds, { padding: [50, 50] });
            } else if (this.userLat && this.userLng) {
                this.map.setView([this.userLat, this.userLng], 15);
            } else if (this.gareLat && this.gareLng) {
                this.map.setView([this.gareLat, this.gareLng], 15);
            }
        },

        destroy() {
            if (this.watchId) {
                navigator.geolocation.clearWatch(this.watchId);
            }
        }
    };
}
</script>

<style>
    @keyframes ping {
        75%, 100% { transform: scale(2); opacity: 0; }
    }
    .leaflet-routing-container { display: none !important; }
</style>
@endsection

@push('styles')
{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
@endpush
