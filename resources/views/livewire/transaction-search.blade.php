<div class="container mx-auto px-6 py-8">
    <div class="bg-white p-6 rounded-xl shadow-lg max-w-lg mx-auto">
        <form id="searchForm" class="space-y-6">
            <div class="space-y-4">
                <label for="address" class="text-lg font-semibold text-gray-800">Ethereum Address</label>
                <input 
                    type="text" 
                    id="address" 
                    name="address"
                    placeholder="Enter address"
                    oninput="toggleTableVisibility()"
                    class="w-full p-4 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 transition duration-300 shadow-md"
                    aria-describedby="address-error"
                />
                <span id="address-error" class="text-red-600 text-sm hidden">Ethereum address is required!</span>
                
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-md hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    Search
                </button>
            </div>
        </form>
    </div>

    <div id="wallet-info" class="mt-6 hidden">
        <label class="font-medium text-lg text-gray-800">Wallet Selected</label>
        <div class="flex items-center space-x-2">
            <span class="font-semibold text-blue-600 break-words" id="wallet-address"></span>
            <button 
                type="button" 
                class="text-blue-500 hover:text-blue-700 transition duration-200"
                id="copyButton"
                aria-label="Copy address to clipboard"
            >
                <i class="material-icons" id="copy-icon">content_copy</i>
            </button>
            <span id="copy-confirmation" class="text-green-500 text-sm ml-2 opacity-0 transform translate-x-4 transition-all duration-300"></span>
        </div>
    </div>

    <div id="transactions-container" class="mt-8 hidden">
        <table id="transactions-table" class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
            <thead class="bg-gray-100">
                <tr class="text-left text-sm font-semibold text-gray-700">
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Swap</th>
                    <th class="px-4 py-2">Protocol</th>
                    <th class="px-4 py-2">Transaction</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700" id="transactions-body">
                
            </tbody>
        </table>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('searchForm');
    const addressInput = document.getElementById('address');
    const addressError = document.getElementById('address-error');
    const transactionsContainer = document.getElementById('transactions-container');
    const walletInfo = document.getElementById('wallet-info');
    const copyButton = document.getElementById('copyButton');
    const copyIcon = document.getElementById('copy-icon');
    const copyConfirmation = document.getElementById('copy-confirmation');
    const transactionsBody = document.getElementById('transactions-body');

    alertify.set('notifier', 'delay', 3);

    transactionsContainer.classList.add('hidden');
    walletInfo.classList.add('hidden');

    addressInput.addEventListener('input', function() {
        
    });

   
    const ETHERSCAN_API_KEY = 'QJNVDV9SB1VFNEA7VHTVMHX3SX25XRWR5U';
    const ETHERSCAN_API_URL = 'https://api.etherscan.io/api';

    async function fetchTransactions(address) {
        try {
            const url = `${ETHERSCAN_API_URL}?module=account&action=txlist&address=${address}&startblock=0&endblock=99999999&page=1&offset=10&sort=desc&apikey=${ETHERSCAN_API_KEY}`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.status === "0") {
                throw new Error(data.message);
            }

            displayTransactions(data.result);
        } catch (error) {
            console.error('Error:', error);
            alertify.error('Error fetching transactions: ' + error.message);
        }
    }

    function displayTransactions(transactions) {
        transactionsBody.innerHTML = '';
    
        if (transactions.length === 0) {
            const noDataRow = document.createElement('tr');
            noDataRow.innerHTML = `<td colspan="4" class="text-center text-gray-500">No transactions found</td>`;
            transactionsBody.appendChild(noDataRow);
        } else {
            transactions.forEach(transaction => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-4 py-2">${new Date(transaction.timeStamp * 1000).toLocaleString()}</td>
                    <td class="px-4 py-2">${transaction.value / 1e18} ETH</td>
                    <td class="px-4 py-2">${transaction.to}</td>
                    <td class="px-4 py-2">
                        <a href="https://etherscan.io/tx/${transaction.hash}" target="_blank" class="text-blue-500 hover:text-blue-700">View</a>
                    </td>
                `;
                transactionsBody.appendChild(row);
            });
        }
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const addressValue = addressInput.value.trim();
        if (!addressValue) {
            addressError.classList.remove('hidden');
            alertify.error('Ethereum address is required!');
        } else {
            addressError.classList.add('hidden');
            document.getElementById('wallet-address').textContent = addressValue;
            
            transactionsContainer.classList.remove('hidden');
            walletInfo.classList.remove('hidden');
            
            fetchTransactions(addressValue);
            alertify.success('Fetching transactions...');
        }
    });

    copyButton.addEventListener('click', () => {
        const address = addressInput.value.trim();
        if (address) {
            const textarea = document.createElement('textarea');
            textarea.value = address;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            copyIcon.textContent = 'check';
            copyConfirmation.classList.remove('opacity-0');
            copyConfirmation.classList.add('opacity-100');
            copyConfirmation.textContent = 'Copied!';
            
            setTimeout(() => {
                copyIcon.textContent = 'content_copy';
                copyConfirmation.classList.remove('opacity-100');
                copyConfirmation.classList.add('opacity-0');
            }, 2000);
        }
    });
});

</script>
