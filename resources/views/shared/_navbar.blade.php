<style>
    #menu-toggle:checked + #menu {
      display: block;
    }
  </style>

<nav class=" z-50 top-0 fixed w-full lg:px-16 px-6 bg-white shadow-md flex flex-wrap items-center lg:py-0 py-2 border-b-4 xl:py-0  border-blue-800">

    <div class="flex-1 flex justify-between items-center">
        <a href="/" class="flex text-lg font-semibold capitalize no-underline cente" style="vertical-align: center">
        <img
          src="{{ asset('images/favicon.png') }}"
          width="50"
          height="50"
          class="p-2"
         alt=''/>
        <div class="mt-3 text-red-600">Travel</div>
      </a>
    </div>
    <label for="menu-toggle" class="cursor-pointer lg:hidden block">
      <svg
        class="fill-current text-gray-900"
        xmlns="http://www.w3.org/2000/svg"
        width="20"
        height="20"
        viewBox="0 0 20 20"
      >
        <title>menu</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
      </svg>
    </label>


    <!-- Profile dropdown -->
    <div class="relative ml-3 flex">
        <div class="mx-2">
            <button type="button" class="relative rounded-full  p-1 text-gray-600 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">View notifications</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
              </button>
        </div>

        <a href="{{ route('profile.show') }}">
          <button type="button" class="relative flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">Open user menu</span>
            <img class="h-8 w-8 rounded-full" src="{{ asset(Auth::user()->profileUrl ?Auth::user()->profileUrl: 'icon/user1.png') }}" alt="">
          </button>
        </a>

    </div>





    <input class="hidden" type="checkbox" id="menu-toggle" />
    <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
      <nav>
        <ul class="text-xl text-center items-center gap-x-5 pt-4 md:gap-x-4 lg:text-lg lg:flex  lg:py-4 lg:px-4">
          <li class="py-2 lg:py-0 ">
            <a
              class="text-blue-600 font-bold no-underline hover:pb-2 hover:border-b-4 hover:border-blue-400"
              href="/"
            >
              Acceuil
            </a>
          </li>
          <li class="py-2 lg:py-0 ">
            <a
              class="text-blue-600 font-bold no-underline hover:pb-2 hover:border-b-4 hover:border-blue-400"
              href="{{ route("voyage.index") }}"
            >
              Voyage
            </a>
          </li>
          <li class="py-2 lg:py-0 ">
            <a
              class="text-blue-600 font-bold no-underline hover:pb-2 hover:border-b-4 hover:border-blue-400"
              href="{{ route('ticket.myTickets') }}"
            >
              Mes Tickets
            </a>
          </li>
          <li class="py-2 lg:py-0 ">
            <a
              class="text-blue-600 font-bold no-underline hover:pb-2 hover:border-b-4 hover:border-blue-400"
              href="#{{-- {{ route('chat.index') }} --}}"
            >
              Messagerie
            </a>
          </li>
          <li class="py-2 lg:py-0 ">
            <a
              class="text-blue-600 font-bold no-underline hover:pb-2 hover:border-b-4 hover:border-blue-400"
              href="#"
            >
              My Journey
            </a>
          </li>
          <li class="py-2 lg:py-0 ">
            <a
              class="text-blue-600 font-bold no-underline hover:pb-2 hover:border-b-4 hover:border-blue-400"
              href="#"
            >
              About
            </a>
          </li>
          <li class="py-2 lg:py-0 ">
            <form action="{{ route('logout') }} " method="post">
              @csrf
              <button
                type="submit"
                class="text-blue-600 font-bold no-underline hover:pb-2 hover:border-b-4 hover:border-blue-400"
              >
                Deconnecter
              </button>
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </nav>
