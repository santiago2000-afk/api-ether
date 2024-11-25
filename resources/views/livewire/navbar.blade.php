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
                   class="text-sm font-medium px-3 py-2 rounded-md transition-all 
                   {{ $active === 'home' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                    Home
                </a>
                <a href="#"
                   wire:click.prevent="setActive('about')"
                   class="text-sm font-medium px-3 py-2 rounded-md transition-all 
                   {{ $active === 'about' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                    About
                </a>
                <a href="#"
                   wire:click.prevent="setActive('services')"
                   class="text-sm font-medium px-3 py-2 rounded-md transition-all 
                   {{ $active === 'services' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                    Services
                </a>
                <a href="#"
                   wire:click.prevent="setActive('contact')"
                   class="text-sm font-medium px-3 py-2 rounded-md transition-all 
                   {{ $active === 'contact' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                    Contact
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex md:hidden">
                <button id="menu-btn" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
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
        <a href="#"
           wire:click.prevent="setActive('contact')"
           class="block text-sm font-medium px-3 py-2 rounded-md transition-all 
           {{ $active === 'contact' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
            Contact
        </a>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>
