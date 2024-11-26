<div>
    <!-- Navbar -->
    <nav id="navbar" class="bg-white shadow-md border-b-2 border-gray-200 fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-all duration-300 ease-in-out">MyApp</a>
                </div>

                <!-- Menú de navegación - Mobile -->
                <div class="md:hidden flex items-center justify-end flex-1">
                    <!-- Botón Toggler para abrir el menú en dispositivos móviles -->
                    <button id="menu-toggle" class="text-gray-600 hover:text-gray-800 focus:outline-none z-50">
                        <span class="material-icons text-2xl">menu</span> <!-- Icono de hamburguesa -->
                    </button>
                </div>

                <!-- Menú de navegación - Desktop -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">Home</a>
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">About</a>
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">Services</a>
                </div>

                <!-- Iconos de conectar cartera y seleccionar red -->
                <div class="flex items-center space-x-4">
                    <!-- Icono de conectar cartera -->
                    <a href="#" id="connect-wallet" title="Connect Wallet" class="text-blue-500 hover:text-blue-700 transition-all duration-300 ease-in-out">
                        <span class="material-icons text-2xl">account_balance_wallet</span> <!-- Icono de Ethereum -->
                    </a>

                    <!-- Icono de seleccionar red -->
                    <a href="#" id="network-selection" title="Choose Network" class="text-green-500 hover:text-green-700 transition-all duration-300 ease-in-out">
                        <span class="material-icons text-2xl">network_wifi</span> <!-- Icono de red -->
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Menú desplegable móvil -->
    <div id="mobile-menu" class="md:hidden fixed top-0 left-0 w-full h-full bg-white z-40 transform translate-x-full transition-all duration-300 ease-in-out">
        <div class="flex justify-between items-center p-4 bg-blue-600">
            <a href="#" class="text-xl font-semibold text-white">MyApp</a>
            <button id="close-menu" class="text-white">
                <span class="material-icons text-2xl">close</span> <!-- Icono de cerrar -->
            </button>
        </div>
        <div class="flex flex-col items-center space-y-4 mt-8">
            <a href="#" class="text-xl text-gray-600 hover:text-blue-500">Home</a>
            <a href="#" class="text-xl text-gray-600 hover:text-blue-500">About</a>
            <a href="#" class="text-xl text-gray-600 hover:text-blue-500">Services</a>
        </div>
    </div>
</div>

<!-- Script para controlar la apertura y cierre del menú en móviles -->
<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        let menu = document.getElementById("mobile-menu");
        menu.classList.toggle("translate-x-full");  // Abre o cierra el menú
        menu.classList.toggle("hidden"); // Asegura que el menú sea visible
    });

    document.getElementById("close-menu").addEventListener("click", function() {
        let menu = document.getElementById("mobile-menu");
        menu.classList.add("translate-x-full");  // Cierra el menú
        menu.classList.add("hidden");  // Lo oculta después de cerrarlo
    });
</script>
