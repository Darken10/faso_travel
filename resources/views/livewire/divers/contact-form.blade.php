<div class="max-w-3xl mx-auto py-12">
    @if ($success)
        <div class="mb-6 p-4 text-green-800 bg-green-100 rounded-xl">
            ✅ Merci pour votre message ! Nous vous répondrons rapidement.
        </div>
    @endif

    <form wire:submit.prevent="submit" class="grid grid-cols-1 gap-6">
        <div>
            <label for="nom" class="block font-medium">Nom</label>
            <input type="text" id="nom" wire:model.defer="nom"
                   class="w-full rounded-xl border-gray-300 p-2" />
            @error('nom') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input type="email" id="email" wire:model.defer="email"
                   class="w-full rounded-xl border-gray-300 p-2" />
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="sujet" class="block font-medium">Sujet</label>
            <input type="text" id="sujet" wire:model.defer="sujet"
                   class="w-full rounded-xl border-gray-300 p-2" />
            @error('sujet') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="message" class="block font-medium">Message</label>
            <textarea id="message" rows="6" wire:model.defer="message"
                      class="w-full rounded-xl border-gray-300 p-2"></textarea>
            @error('message') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- reCAPTCHA -->
        <div wire:ignore>
            <div id="recaptcha" class="g-recaptcha"
                 data-sitekey="{{ getenv('RECAPTCHA_SITE_KEY') }}"
                 data-callback="recaptchaCallback"
                 data-expired-callback="recaptchaExpired">
            </div>
            @error('recaptcha') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
                class="bg-blue-600 text-white py-2 px-6 rounded-xl hover:bg-blue-700">
            Envoyer
        </button>
        <!-- Envoi WhatsApp via URL pré-remplie -->
        <a href="https://wa.me/+22612345678?text=Bonjour,%20j'ai%20une%20question%20concernant%20ma%20réservation" target="_blank" class="py-2 px-6 w-full mt-4">
            <button class="bg-green-500 text-white px-4 py-2 rounded-xl">Contacter via WhatsApp</button>
        </a>
    </form>

</div>

<script>
    function recaptchaCallback(token) {
        @this.set('recaptcha', token);
    }
    function recaptchaExpired() {
        @this.set('recaptcha', '');
    }
</script>

