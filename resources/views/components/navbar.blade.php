<nav class="bg-white h-20 px-8 flex items-center justify-between shadow-sm">

    <div>

        <h2 class="text-2xl font-bold">

            Dashboard

        </h2>

        <p class="text-gray-500 text-sm">

            Selamat datang kembali 👋

        </p>

    </div>

    <div class="flex items-center gap-6">

        <button class="relative">

            🔔

            <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>

        </button>

        <div class="flex items-center gap-3">

            <img
                src="https://ui-avatars.com/api/?name={{ session('name') }}"
                class="w-12 h-12 rounded-full">

            <div>

                <h3 class="font-semibold">

                    {{ session('name') }}

                </h3>

                <p class="text-xs text-gray-500">

                    Administrator

                </p>

            </div>

        </div>

    </div>

</nav>
