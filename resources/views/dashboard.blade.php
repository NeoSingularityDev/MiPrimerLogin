<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center shadow-md">
        
        <h1 class="text-xl font-bold">Mi Dashboard</h1>
        <div class="relative">
            <button id="menuButton" class="focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div id="menuDropdown" class="hidden absolute right-0 mt-2 bg-white text-gray-800 w-40 rounded shadow-lg overflow-hidden">
                <a href="/profile"
                   class="block px-4 py-2 hover:bg-gray-100 transition">
                    Mi Perfil
                </a>
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


    <div class="p-6">
        @if (session('errors'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('errors') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-4">Bienvenido al Dashboard</h2>

        <p class="text-gray-700">
            Has iniciado sesión correctamente.  
            Aquí puedes colocar contenido privado.
        </p>

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
