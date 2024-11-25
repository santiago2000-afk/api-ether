<div>
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-xl font-bold text-blue-500">MyApp</a>
                </div>

                <!-- Menu Items -->
                <div class="hidden md:flex space-x-8">
                    <a href="#"
                        wire:click.prevent="setActive('home')"
                        class="relative text-sm font-medium px-3 py-2 transition-all 
                        {{ $active === 'home' ? 'text-blue-500' : 'text-gray-600 hover:text-blue-500' }}">
                        Home
                        @if ($active === 'home')
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transition-all"></span>
                        @endif
                    </a>
                    <a href="#"
                        wire:click.prevent="setActive('about')"
                        class="relative text-sm font-medium px-3 py-2 transition-all 
                        {{ $active === 'about' ? 'text-blue-500' : 'text-gray-600 hover:text-blue-500' }}">
                        About
                        @if ($active === 'about')
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transition-all"></span>
                        @endif
                    </a>
                    <a href="#"
                        wire:click.prevent="setActive('services')"
                        class="relative text-sm font-medium px-3 py-2 transition-all 
                        {{ $active === 'services' ? 'text-blue-500' : 'text-gray-600 hover:text-blue-500' }}">
                        Services
                        @if ($active === 'services')
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transition-all"></span>
                        @endif
                    </a>
                </div>

                <!-- Connect Wallet Button -->
                <div class="hidden md:flex items-center">
                    <button id="connect-wallet" class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition-all">
                        Connect Wallet
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex md:hidden">
                    <button id="menu-btn" aria-expanded="false"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden px-4 pt-2 pb-3 space-y-1 bg-white shadow-lg">
            <a href="#"
                wire:click.prevent="setActive('home')"
                class="block text-sm font-medium px-3 py-2 rounded-md transition-all 
                {{ $active === 'home' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                Home
            </a>
            <a href="#"
                wire:click.prevent="setActive('about')"
                class="block text-sm font-medium px-3 py-2 rounded-md transition-all 
                {{ $active === 'about' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                About
            </a>
            <a href="#"
                wire:click.prevent="setActive('services')"
                class="block text-sm font-medium px-3 py-2 rounded-md transition-all 
                {{ $active === 'services' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                Services
            </a>
            <!-- Connect Wallet Button for Mobile -->
            <a href="#"
                class="block text-sm font-medium px-4 py-2 mt-4 rounded-lg bg-blue-500 text-white text-center hover:bg-blue-600">
                Connect Wallet
            </a>
        </div>
    </nav>

    <!-- Modal for Connect Wallet -->
    <div id="wallet-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg w-96 p-6">
            <h2 class="text-xl font-semibold text-center mb-4">Connect Your Wallet</h2>
            <div class="flex justify-center">
                <button id="metamask-button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Connect with MetaMask
                </button>
            </div>
            <button id="close-modal" class="mt-4 text-center w-full text-sm text-gray-600 hover:text-blue-500">
                Close
            </button>
        </div>
    </div>

    <!-- Script para Menú Móvil y Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const connectWalletBtn = document.getElementById('connect-wallet');
            const walletModal = document.getElementById('wallet-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const metamaskBtn = document.getElementById('metamask-button');

            // Abrir el modal de wallet
            connectWalletBtn.addEventListener('click', () => {
                walletModal.classList.remove('hidden');
            });

            // Cerrar el modal
            closeModalBtn.addEventListener('click', () => {
                walletModal.classList.add('hidden');
            });

            // Lógica de MetaMask (placeholder para conectar con MetaMask)
            metamaskBtn.addEventListener('click', () => {
                if (typeof window.ethereum !== 'undefined') {
                    // Conexión con MetaMask (solo ejemplo)
                    window.ethereum.request({ method: 'eth_requestAccounts' })
                        .then(accounts => {
                            alert('Conectado con MetaMask: ' + accounts[0]);
                            walletModal.classList.add('hidden');
                        })
                        .catch(error => {
                            alert('Error al conectar con MetaMask: ' + error.message);
                        });
                } else {
                    alert('MetaMask no está instalado.');
                }
            });

            // Funcionalidad del menú móvil
            menuBtn.addEventListener('click', () => {
                const isOpen = menuBtn.getAttribute('aria-expanded') === 'true';
                menuBtn.setAttribute('aria-expanded', !isOpen);
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</div>
