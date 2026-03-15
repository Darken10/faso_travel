<div>
    @if ($success)
        <div class="card border-success-200 dark:border-success-800 bg-success-50 dark:bg-success-900/20 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-success-100 dark:bg-success-900/30 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <p class="text-success-700 dark:text-success-300 font-medium">Merci pour votre message ! Nous vous répondrons rapidement.</p>
            </div>
        </div>
    @endif

    <div class="card mb-6">
        <form wire:submit.prevent="submit" class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="nom" class="input-label">Nom</label>
                    <input type="text" id="nom" wire:model.defer="nom" class="input w-full" placeholder="Votre nom">
                    @error('nom') <span class="text-danger-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="input-label">Email</label>
                    <input type="email" id="email" wire:model.defer="email" class="input w-full" placeholder="votre@email.com">
                    @error('email') <span class="text-danger-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="sujet" class="input-label">Sujet</label>
                <input type="text" id="sujet" wire:model.defer="sujet" class="input w-full" placeholder="L'objet de votre message">
                @error('sujet') <span class="text-danger-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="message" class="input-label">Message</label>
                <textarea id="message" rows="5" wire:model.defer="message" class="input w-full" placeholder="Décrivez votre demande…"></textarea>
                @error('message') <span class="text-danger-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- reCAPTCHA --}}
            <div wire:ignore>
                <div id="recaptcha" class="g-recaptcha"
                     data-sitekey="{{ getenv('RECAPTCHA_SITE_KEY') }}"
                     data-callback="recaptchaCallback"
                     data-expired-callback="recaptchaExpired">
                </div>
                @error('recaptcha') <span class="text-danger-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                Envoyer le message
            </button>
        </form>
    </div>

    {{-- WhatsApp --}}
    <div class="card text-center">
        <p class="text-surface-500 dark:text-surface-400 mb-3">Vous préférez discuter en direct ?</p>
        <a href="https://wa.me/+22612345678?text=Bonjour,%20j'ai%20une%20question%20concernant%20ma%20réservation" target="_blank"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-500 hover:bg-green-600 text-white font-medium rounded-xl transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Contacter via WhatsApp
        </a>
    </div>
</div>

<script>
    function recaptchaCallback(token) {
        @this.set('recaptcha', token);
    }
    function recaptchaExpired() {
        @this.set('recaptcha', '');
    }
</script>

