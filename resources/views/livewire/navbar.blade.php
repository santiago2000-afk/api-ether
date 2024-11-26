<div>
    <!-- Navbar -->
    <nav id="navbar" class="bg-white shadow-md border-b-2 border-gray-200 fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-all duration-300 ease-in-out"><?= env('APP_NAME'); ?></a>
                </div>

                <!-- Mobile Navigation Menu -->
                <div class="md:hidden flex items-center justify-end flex-1">
                    <button id="menu-toggle" class="text-gray-600 hover:text-gray-800 focus:outline-none z-50">
                        <span class="material-icons text-2xl">menu</span>
                    </button>
                </div>

                <!-- Desktop Navigation Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">Home</a>
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">About</a>
                    <a href="#" class="text-sm font-medium px-3 py-2 transition-all hover:text-blue-500 hover:scale-105 transform duration-200 ease-in-out">Services</a>
                </div>

                <!-- Wallet Connect, Network Selection and Dark/Light Mode Icons -->
                <div class="flex items-center space-x-4 hidden sm:flex">
                    <a href="#" id="connect-wallet" class="text-blue-500 hover:text-blue-700 transition-all duration-300 ease-in-out">
                        <span class="material-icons text-2xl">account_balance_wallet</span>
                    </a>
                    <a href="#" id="network-selection" class="text-green-500 hover:text-green-700 transition-all duration-300 ease-in-out">
                        <span class="material-icons text-2xl">network_wifi</span>
                    </a>
                    <!-- Dark/Light Mode Icon -->
                    <button id="dark-light-toggle" class="text-gray-600 hover:text-gray-800 transition-all duration-300 ease-in-out">
                        <span id="dark-icon" class="material-icons text-2xl">dark_mode</span>
                        <span id="light-icon" class="material-icons text-2xl hidden">light_mode</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Dropdown Menu -->
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

    <!-- MetaMask Modal -->
    <div id="metamask-modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden z-50 transition-opacity duration-300 ease-in-out opacity-0">
        <div class="bg-white p-8 rounded-xl shadow-xl w-96 max-w-sm transform transition-all duration-300 ease-in-out scale-95 relative">
            <!-- Close button in top right corner -->
            <button id="close-modal" class="absolute top-4 right-4 text-red-500 hover:text-red-700 focus:outline-none text-xl transition-all duration-300 ease-in-out">
                <span class="material-icons">close</span>
            </button>

            <div class="text-center">
                <h2 class="text-3xl font-semibold text-blue-600 mb-6">Connect to MetaMask</h2>
                <p class="text-gray-700 mb-8">Click the button below to connect your MetaMask wallet.</p>
                <button id="metamask-connect" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-6 rounded-full shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 ease-in-out transform hover:scale-105">
                    Connect MetaMask
                </button>
            </div>
        </div>
    </div>

    <!-- Network Selection Modal -->
    <div id="network-modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden z-50 transition-opacity duration-300 ease-in-out opacity-0">
        <div class="bg-white p-8 rounded-xl shadow-xl w-96 max-w-sm transform transition-all duration-300 ease-in-out scale-95 relative">
            <!-- Close button in top right corner -->
            <button id="close-network-modal" class="absolute top-4 right-4 text-red-500 hover:text-red-700 focus:outline-none text-xl transition-all duration-300 ease-in-out">
                <span class="material-icons">close</span>
            </button>

            <div class="text-center">
                <h2 class="text-3xl font-semibold text-blue-600 mb-6">Select Network</h2>
                <p class="text-gray-700 mb-8">Choose one of the available networks to connect to:</p>

                <!-- Network options -->
                <div class="space-y-4">
                    <button class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white py-3 px-6 rounded-full shadow-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-300 ease-in-out transform hover:scale-105 w-full">
                        Ethereum Network
                    </button>
                    <button class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white py-3 px-6 rounded-full shadow-lg hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 ease-in-out transform hover:scale-105 w-full">
                        BNB Smart Chain Network
                    </button>
                    <button class="bg-gradient-to-r from-green-500 to-green-600 text-white py-3 px-6 rounded-full shadow-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 ease-in-out transform hover:scale-105 w-full">
                        Base Network
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script for controlling mobile menu open and close, dark/light mode toggle -->
<script>
    // Open or close mobile menu
    document.getElementById("menu-toggle").addEventListener("click", function() {
        let menu = document.getElementById("mobile-menu");
        menu.classList.toggle("translate-x-full");  // Toggle menu visibility
        menu.classList.toggle("translate-x-0");    // Show menu (by switching to translate-x-0)
    });

    // Close menu when clicking on close button
    document.getElementById("close-menu").addEventListener("click", function() {
        let menu = document.getElementById("mobile-menu");
        menu.classList.add("translate-x-full");  // Hide menu again
    });

    // Open MetaMask modal when clicking on the wallet icon
    document.getElementById("connect-wallet").addEventListener("click", function() {
        let modal = document.getElementById("metamask-modal");
        modal.classList.remove("hidden");
        modal.classList.remove("opacity-0");
        modal.classList.add("opacity-100");
        modal.querySelector(".scale-95").classList.remove("scale-95");
    });

    // Close MetaMask modal when clicking on close button
    document.getElementById("close-modal").addEventListener("click", function() {
        let modal = document.getElementById("metamask-modal");
        modal.classList.add("hidden");
        modal.classList.add("opacity-0");
        modal.classList.remove("opacity-100");
        modal.querySelector(".scale-95").classList.add("scale-95");
    });

    // Open network selection modal when clicking on the network icon
    document.getElementById("network-selection").addEventListener("click", function() {
        let modal = document.getElementById("network-modal");
        modal.classList.remove("hidden");
        modal.classList.remove("opacity-0");
        modal.classList.add("opacity-100");
        modal.querySelector(".scale-95").classList.remove("scale-95");
    });

    // Close network selection modal when clicking on close button
    document.getElementById("close-network-modal").addEventListener("click", function() {
        let modal = document.getElementById("network-modal");
        modal.classList.add("hidden");
        modal.classList.add("opacity-0");
        modal.classList.remove("opacity-100");
        modal.querySelector(".scale-95").classList.add("scale-95");
    });

    // Dark/Light Mode Toggle functionality
    document.getElementById("dark-light-toggle").addEventListener("click", function() {
        let body = document.body;
        body.classList.toggle("dark");
        let darkIcon = document.getElementById("dark-icon");
        let lightIcon = document.getElementById("light-icon");
        
        // Toggle icons
        darkIcon.classList.toggle("hidden");
        lightIcon.classList.toggle("hidden");
    });
</script>
