<div>
    <div x-data="{ currentPage: @entangle('currentPage') }">
        @livewire('navbar');
        <br><br><br>
        <div class="container my-4">
            <div x-show="currentPage === 'home'">
                @livewire('transaction-search');
            </div>

            <div x-show="currentPage === 'myWalles'">
                @livewire('my-walles');
            </div>
        </div>
    </div>
</div>
Ñ