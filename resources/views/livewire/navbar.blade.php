<div>
    <!-- Navbar -->
    <nav id="navbar" class="bg-white shadow-md border-b-2 border-gray-200 fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-all duration-300 ease-in-out"><?= env('APP_NAME'); ?></a>
                </div>

                <!-- Menú de navegación - Mobile -->
                <div class="md:hidden flex items-center justify-end flex-1">
                    <button id="menu-toggle" class="text-gray-600 hover:text-gray-800 focus:outline-none z-50">
                        <span class="material-icons text-2xl">menu</span>
                    </button>
                </div>

                <!-- Menú de navegación - Desktop -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">Home</a>
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">About</a>
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">Services</a>
                </div>

                <!-- Iconos de conectar cartera y seleccionar red -->
                <div class="flex items-center space-x-4 hidden sm:flex">
                    <a href="#" id="connect-wallet" class="text-blue-500 hover:text-blue-700 transition-all duration-300 ease-in-out">
                        <span class="material-icons text-2xl">account_balance_wallet</span>
                    </a>
                    <a href="#" id="network-selection" class="text-green-500 hover:text-green-700 transition-all duration-300 ease-in-out">
                        <span class="material-icons text-2xl">network_wifi</span>
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
                <span class="material-icons text-2xl">close</span>
            </button>
        </div>
        <div class="flex flex-col items-center space-y-4 mt-8">
            <a href="#" class="text-xl text-gray-600 hover:text-blue-500">Home</a>
            <a href="#" class="text-xl text-gray-600 hover:text-blue-500">About</a>
            <a href="#" class="text-xl text-gray-600 hover:text-blue-500">Services</a>
        </div>
    </div>

    <!-- Modal de MetaMask -->
    <div id="metamask-modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden z-50 transition-opacity duration-300 ease-in-out opacity-0">
        <div class="bg-white p-8 rounded-xl shadow-xl w-96 max-w-sm transform transition-all duration-300 ease-in-out scale-95 relative">
            <!-- Botón de cerrar en la esquina superior derecha -->
            <button id="close-modal" class="absolute top-4 right-4 text-red-500 hover:text-red-700 focus:outline-none text-xl transition-all duration-300 ease-in-out">
                <span class="material-icons">close</span>
            </button>

            <div class="text-center">
                <h2 class="text-3xl font-semibold text-blue-600 mb-6">Conectar con MetaMask</h2>
                <p class="text-gray-700 mb-8">Haz clic en el siguiente botón para conectar tu billetera MetaMask.</p>
                <button id="metamask-connect" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-6 rounded-full shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 ease-in-out transform hover:scale-105">
                    Conectar MetaMask
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script para controlar la apertura y cierre del menú en móviles -->
<script>
    // Abre o cierra el menú móvil
    document.getElementById("menu-toggle").addEventListener("click", function() {
        let menu = document.getElementById("mobile-menu");
        menu.classList.toggle("translate-x-full");  // Cambia la clase para abrir o cerrar el menú
        menu.classList.toggle("translate-x-0");    // Muestra el menú (cuando se cambia a translate-x-0)
    });

    // Cierra el menú al hacer clic en el botón de cerrar
    document.getElementById("close-menu").addEventListener("click", function() {
        let menu = document.getElementById("mobile-menu");
        menu.classList.add("translate-x-full");  // Vuelve a ocultar el menú
    });

    // Abre el modal cuando se hace clic en el ícono de la billetera
    document.getElementById("connect-wallet").addEventListener("click", function() {
        let modal = document.getElementById("metamask-modal");
        modal.classList.remove("hidden");
        modal.classList.remove("opacity-0");
        modal.classList.add("opacity-100");
        modal.querySelector(".scale-95").classList.remove("scale-95");
    });

    // Cierra el modal cuando se hace clic en el botón de cerrar
    document.getElementById("close-modal").addEventListener("click", function() {
        let modal = document.getElementById("metamask-modal");
        modal.classList.add("hidden");
        modal.classList.add("opacity-0");
        modal.classList.remove("opacity-100");
        modal.querySelector(".scale-95").classList.add("scale-95");
    });

    // Cerrar el modal cuando se hace clic fuera del modal (área gris)
    document.getElementById("metamask-modal").addEventListener("click", function(event) {
        if (event.target === document.getElementById("metamask-modal")) {
            document.getElementById("metamask-modal").classList.add("hidden");
            document.getElementById("metamask-modal").classList.add("opacity-0");
            document.getElementById("metamask-modal").classList.remove("opacity-100");
            document.getElementById("metamask-modal").querySelector(".scale-95").classList.add("scale-95");
        }
    });

    // Acción del botón de conectar MetaMask (puedes agregar tu lógica de conexión aquí)
    document.getElementById("metamask-connect").addEventListener("click", function() {
        alert("Conectando con MetaMask...");
        // Aquí iría tu lógica para conectar con MetaMask
    });
</script>
