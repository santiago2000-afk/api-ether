<div>
<div x-data="{ currentPage: @entangle('currentPage') }">
    @livewire('navbar');
    <br><br><br>
    <div class="container my-4">
        <div x-show="currentPage === 'wallets'">
            @livewire('transaction-search');
        </div>

        <div x-show="currentPage === 'myWalles'">
            @livewire('my-walles');
        </div>

        <div x-show="currentPage === 'services'">
            <h1 class="text-2xl">Our Services</h1>
        </div>

        <div x-show="currentPage === 'contact'">
            <h1 class="text-2xl">Contact Us</h1>
        </div>
    </div>
</div>

</div>
