<div>
        <!-- Visualización de dirección seleccionada -->
        @if ($address)
    <div class="mt-6 text-sm text-gray-600">
        <label class="font-medium text-lg text-gray-800">Wallet Selected</label>
        <div class="flex items-center space-x-2">
            <span class="font-semibold text-blue-600 break-words" id="wallet-address">{{ $address }}</span>
            <button 
                type="button" 
                class="text-blue-500 hover:text-blue-700 transition duration-200"
                onclick="copyToClipboard()"
                aria-label="Copy to clipboard"
            >
                <i class="material-icons" id="copy-icon" title="Copy address">content_copy</i>
            </button>
            <span id="copy-confirmation" class="text-green-500 text-sm ml-2 opacity-0 transform translate-x-4 transition-all duration-300">
                
            </span>
        </div>
    </div>
    @endif
</div>