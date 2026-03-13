@once
    <style>
        .fi-map-picker .leaflet-container {
            font-family: inherit;
            border-radius: 12px;
            background: #e5e7eb;
        }
        .fi-map-picker .leaflet-control-attribution {
            font-size: 10px;
        }
    </style>
@endonce

<div
    class="fi-map-picker col-span-full"
    x-data="{
        map: null,
        marker: null,
        lat: null,
        lng: null,
        loading: false,

        init() {
            // Poll until Leaflet is ready (injected via panel renderHook, but may still be loading)
            const tryInit = () => {
                if (typeof window.L !== 'undefined') {
                    this.initMap();
                } else {
                    setTimeout(tryInit, 100);
                }
            };
            tryInit();
        },

        initMap() {
            const rawLat = $wire.get('data.lat');
            const rawLng = $wire.get('data.lng');
            const initialLat = rawLat ? parseFloat(rawLat) : null;
            const initialLng = rawLng ? parseFloat(rawLng) : null;

            const defaultCenter = [initialLat ?? 12.3647, initialLng ?? -1.5339];
            const defaultZoom   = (initialLat && initialLng) ? 13 : 7;

            this.lat = initialLat;
            this.lng = initialLng;

            this.map = L.map(this.$refs.mapCanvas, { zoomControl: true }).setView(defaultCenter, defaultZoom);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href=&quot;https://www.openstreetmap.org/copyright&quot;>OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(this.map);

            if (initialLat && initialLng) {
                this.addMarker(initialLat, initialLng);
            }

            this.map.on('click', (e) => {
                this.setPosition(e.latlng.lat, e.latlng.lng);
            });
        },

        addMarker(lat, lng) {
            if (this.marker) {
                this.marker.setLatLng([lat, lng]);
            } else {
                this.marker = L.marker([lat, lng], { draggable: true }).addTo(this.map);
                this.marker.on('dragend', (e) => {
                    const pos = e.target.getLatLng();
                    this.syncToForm(pos.lat, pos.lng);
                });
            }
        },

        setPosition(lat, lng) {
            this.addMarker(lat, lng);
            this.map.panTo([lat, lng]);
            this.syncToForm(lat, lng);
        },

        syncToForm(lat, lng) {
            const rLat = parseFloat(lat.toFixed(7));
            const rLng = parseFloat(lng.toFixed(7));
            this.lat = rLat;
            this.lng = rLng;
            $wire.set('data.lat', rLat);
            $wire.set('data.lng', rLng);
        },

        useMyLocation() {
            if (!navigator.geolocation) {
                alert('La géolocalisation n\'est pas supportée par votre navigateur.');
                return;
            }
            this.loading = true;
            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    this.loading = false;
                    this.setPosition(pos.coords.latitude, pos.coords.longitude);
                    this.map.setZoom(15);
                },
                (err) => {
                    this.loading = false;
                    const msgs = {
                        1: 'Accès à la position refusé. Veuillez autoriser la géolocalisation dans votre navigateur.',
                        2: 'Position introuvable. Merci de cliquer directement sur la carte.',
                        3: 'La demande a expiré. Veuillez réessayer.'
                    };
                    alert(msgs[err.code] ?? 'Erreur de géolocalisation: ' + err.message);
                },
                { enableHighAccuracy: true, timeout: 10000 }
            );
        }
    }"
    wire:ignore
>
    {{-- Map canvas --}}
    <div
        x-ref="mapCanvas"
        class="w-full rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm"
        style="height: 420px; position: relative;"
    ></div>

    {{-- Controls row --}}
    <div class="flex flex-wrap items-center justify-between gap-3 mt-3">

        {{-- Geolocation button --}}
        <button
            type="button"
            @click="useMyLocation()"
            :disabled="loading"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white shadow-sm
                   bg-primary-600 hover:bg-primary-700 active:bg-primary-800
                   disabled:opacity-60 disabled:cursor-not-allowed
                   transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
        >
            {{-- Spinner --}}
            <svg x-show="loading" class="animate-spin h-4 w-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{-- Location pin icon --}}
            <svg x-show="!loading" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
            </svg>
            <span x-text="loading ? 'Détection en cours…' : 'Utiliser ma position actuelle'"></span>
        </button>

        {{-- Live coordinates display --}}
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-1.5 text-sm">
                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Lat :</span>
                <code
                    x-text="lat !== null ? lat.toFixed(5) : '—'"
                    :class="lat !== null ? 'text-success-600 dark:text-success-400' : 'text-gray-400'"
                    class="font-mono text-sm"
                ></code>
            </div>
            <div class="flex items-center gap-1.5 text-sm">
                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Lng :</span>
                <code
                    x-text="lng !== null ? lng.toFixed(5) : '—'"
                    :class="lng !== null ? 'text-success-600 dark:text-success-400' : 'text-gray-400'"
                    class="font-mono text-sm"
                ></code>
            </div>
        </div>
    </div>

    {{-- Hint --}}
    <p class="mt-2 flex items-start gap-1.5 text-xs text-gray-500 dark:text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
        </svg>
        Cliquez sur la carte pour placer la gare. Faites glisser le marqueur pour affiner la position.
    </p>
</div>
