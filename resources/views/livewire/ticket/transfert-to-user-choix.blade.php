
<div>
    <div class="card m-auto my-4">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white flex m-auto justify-center">Choisir l'Utilisateur Correspondant </h5>
        <form wire:submit="handleChange">
            @csrf
            <div class="grid grid-cols-6  justify-between items-center gap-2">
                <div class="col-span-4">
                    <x-input id="name" placeholder="Nom ou Prenom" class="block mt-1 w-full" type="text" wire:model.live="name" :value="old('name')" required autofocus />
                </div>
                <button type="submit" class="col-span-2 btn-primary ">
                    Rechercher
                </button>
            </div>


        </form>
    </div>

    <div class="card m-auto">
        <form action="{{ route('ticket.tranferer-ticket-to-other-user-traitement',$ticket) }}" method="post">
            @csrf
            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($users as $user)
                    <li class="pb-3 sm:pb-4">
                        <button value="{{ $user->id  }}" name="user_selected">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="{{ asset($user->profileUrl ?? 'icon/user1.png') }}" alt="photo de profile">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $user->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </div>
                        </button>
                    </li
                        @empty
                        <div class="text-gray-300 text-3xl flex justify-center items-center align-middle">Aucune informations</div>
                @endforelse
            </ul>
        </form>
    </div>


</div>

