<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold">Mi Perfil</h1>

        <div class="relative">
            <button id="menuButton" class="focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div id="menuDropdown" class="hidden absolute right-0 mt-2 bg-white text-gray-800 w-40 rounded shadow-lg overflow-hidden">
                <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-100 transition">Dashboard</a>

                <button onclick="document.getElementById('logoutForm').submit()"
                        class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600 font-semibold transition">
                    Cerrar sesión
                </button>
            </div>
        </div>

        <form id="logoutForm" action="/logout" method="POST" class="hidden">
            @csrf
        </form>
    </nav>

    <div class="max-w-2xl mx-auto bg-white p-6 mt-8 rounded-lg shadow">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Información del Usuario</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="space-y-5">
            <div>
                <label class="text-gray-700 font-semibold">Nombre</label>
                <input type="text" value="{{ $user->name }}"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700" disabled>
            </div>

            <div>
                <label class="text-gray-700 font-semibold">Email</label>
                <input type="text" value="{{ $user->email }}"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700" disabled>
            </div>

            <div>
                <label class="text-gray-700 font-semibold">Cuenta creada el</label>
                <input type="text" value="{{ $user->created_at }}"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700" disabled>
            </div>

            <div>
                <label class="text-gray-700 font-semibold">Última actualización</label>
                <input type="text" value="{{ $user->updated_at }}"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700" disabled>
            </div>

        </div>

    </div>

    <script>
        const menuButton = document.getElementById("menuButton");
        const menuDropdown = document.getElementById("menuDropdown");

        menuButton.addEventListener("click", () => {
            menuDropdown.classList.toggle("hidden");
        });

        window.addEventListener("click", function(e) {
            if (!menuButton.contains(e.target)) {
                if (!menuDropdown.classList.contains("hidden")) {
                    menuDropdown.classList.add("hidden");
                }
            }
        });
    </script>

</body>
</html>
