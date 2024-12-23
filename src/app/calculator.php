<?php
// Include the header
include 'header.php';

// Helper function to generate SVG icons (if needed)
function svg_icon($name) {
    $icons = [
        'brain-circuit' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4.5a2.5 2.5 0 0 0-4.96-.46 2.5 2.5 0 0 0-1.98 3 2.5 2.5 0 0 0-1.32 4.24 3 3 0 0 0 .34 5.58 2.5 2.5 0 0 0 2.96 3.08 2.5 2.5 0 0 0 4.91.05L12 20V4.5Z"/><path d="M16 8V5c0-1.1.9-2 2-2"/><path d="M12 13h4"/><path d="M12 18h6a2 2 0 0 1 2 2v1"/><path d="M12 8h8"/><path d="M20.5 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/><path d="M16.5 13a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/><path d="M20.5 21a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/><path d="M18.5 3a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/></svg>',
    ];
    return $icons[$name] ?? '';
}

// Calculation functions
function calculate_tam($total_customers, $average_revenue) {
    return $total_customers * $average_revenue;
}

function calculate_cpa($marketing_spend, $new_customers) {
    return $marketing_spend / $new_customers;
}

function calculate_ltv_cac($average_order_value, $purchase_frequency, $customer_lifespan, $acquisition_cost) {
    $ltv = $average_order_value * $purchase_frequency * $customer_lifespan;
    return $ltv / $acquisition_cost;
}

function calculate_payback_period($cac, $arpa) {
    return $cac / $arpa;
}

function calculate_burn_rate($starting_capital, $monthly_expenses, $monthly_revenue) {
    $monthly_burn = $monthly_expenses - $monthly_revenue;
    return $starting_capital / $monthly_burn;
}
?>

<main class="flex-grow">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8 text-center text-startup-iq-green">Go-to-Market Calculators</h1>

        <div class="mb-8 flex justify-center space-x-4">
            <button class="category-button bg-startup-iq-green text-white px-4 py-2 rounded" data-category="all">All</button>
            <button class="category-button bg-gray-200 text-gray-700 px-4 py-2 rounded" data-category="financial">Financial</button>
            <button class="category-button bg-gray-200 text-gray-700 px-4 py-2 rounded" data-category="marketing">Marketing</button>
            <button class="category-button bg-gray-200 text-gray-700 px-4 py-2 rounded" data-category="growth">Growth</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- TAM Calculator -->
            <div class="calculator bg-white p-6 rounded-lg shadow-md" data-category="financial">
                <h2 class="text-2xl font-semibold mb-4 text-startup-iq-green">Total Addressable Market (TAM) Calculator</h2>
                <form id="tamForm" class="space-y-4">
                    <div>
                        <label for="totalCustomers" class="block text-sm font-medium text-gray-700">
                            Total Number of Potential Customers
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The total number of customers that could potentially use your product or service.</span>
                            </span>
                        </label>
                        <input type="number" id="totalCustomers" name="totalCustomers" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="averageRevenue" class="block text-sm font-medium text-gray-700">
                            Average Revenue per Customer ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The average amount of revenue generated from each customer.</span>
                            </span>
                        </label>
                        <input type="number" id="averageRevenue" name="averageRevenue" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <button type="submit" class="w-full bg-startup-iq-green text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-startup-iq-green focus:ring-opacity-50">Calculate TAM</button>
                </form>
                <div id="tamResult" class="mt-4"></div>
            </div>

            <!-- CPA Calculator -->
            <div class="calculator bg-white p-6 rounded-lg shadow-md" data-category="marketing">
                <h2 class="text-2xl font-semibold mb-4 text-startup-iq-green">Cost Per Acquisition (CPA) Calculator</h2>
                <form id="cpaForm" class="space-y-4">
                    <div>
                        <label for="marketingSpend" class="block text-sm font-medium text-gray-700">
                            Total Marketing Spend ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The total amount spent on marketing efforts.</span>
                            </span>
                        </label>
                        <input type="number" id="marketingSpend" name="marketingSpend" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="newCustomers" class="block text-sm font-medium text-gray-700">
                            Number of New Customers Acquired
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The total number of new customers acquired from your marketing efforts.</span>
                            </span>
                        </label>
                        <input type="number" id="newCustomers" name="newCustomers" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <button type="submit" class="w-full bg-startup-iq-green text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-startup-iq-green focus:ring-opacity-50">Calculate CPA</button>
                </form>
                <div id="cpaResult" class="mt-4"></div>
            </div>

            <!-- LTV:CAC Calculator -->
            <div class="calculator bg-white p-6 rounded-lg shadow-md" data-category="financial">
                <h2 class="text-2xl font-semibold mb-4 text-startup-iq-green">LTV:CAC Ratio Calculator</h2>
                <form id="ltvCacForm" class="space-y-4">
                    <div>
                        <label for="averageOrderValue" class="block text-sm font-medium text-gray-700">
                            Average Order Value ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The average amount a customer spends on a single order.</span>
                            </span>
                        </label>
                        <input type="number" id="averageOrderValue" name="averageOrderValue" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="purchaseFrequency" class="block text-sm font-medium text-gray-700">
                            Purchase Frequency (per year)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">How many times a customer makes a purchase in a year.</span>
                            </span>
                        </label>
                        <input type="number" id="purchaseFrequency" name="purchaseFrequency" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="customerLifespan" class="block text-sm font-medium text-gray-700">
                            Customer Lifespan (in years)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The average number of years a customer continues to purchase from you.</span>
                            </span>
                        </label>
                        <input type="number" id="customerLifespan" name="customerLifespan" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="acquisitionCost" class="block text-sm font-medium text-gray-700">
                            Customer Acquisition Cost (CAC) ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The cost of acquiring a single customer.</span>
                            </span>
                        </label>
                        <input type="number" id="acquisitionCost" name="acquisitionCost" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <button type="submit" class="w-full bg-startup-iq-green text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-startup-iq-green focus:ring-opacity-50">Calculate LTV:CAC Ratio</button>
                </form>
                <div id="ltvCacResult" class="mt-4"></div>
            </div>

            <!-- Payback Period Calculator -->
            <div class="calculator bg-white p-6 rounded-lg shadow-md" data-category="financial">
                <h2 class="text-2xl font-semibold mb-4 text-startup-iq-green">Payback Period Calculator</h2>
                <form id="paybackPeriodForm" class="space-y-4">
                    <div>
                        <label for="cac" class="block text-sm font-medium text-gray-700">
                            Customer Acquisition Cost (CAC) ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The cost of acquiring a single customer.</span>
                            </span>
                        </label>
                        <input type="number" id="cac" name="cac" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="arpa" class="block text-sm font-medium text-gray-700">
                            Average Revenue per Account (ARPA) per month ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The average monthly revenue generated from each customer account.</span>
                            </span>
                        </label>
                        <input type="number" id="arpa" name="arpa" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <button type="submit" class="w-full bg-startup-iq-green text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-startup-iq-green focus:ring-opacity-50">Calculate Payback Period</button>
                </form>
                <div id="paybackPeriodResult" class="mt-4"></div>
            </div>

            <!-- Burn Rate Calculator -->
            <div class="calculator bg-white p-6 rounded-lg shadow-md" data-category="financial">
                <h2 class="text-2xl font-semibold mb-4 text-startup-iq-green">Burn Rate Calculator</h2>
                <form id="burnRateForm" class="space-y-4">
                    <div>
                        <label for="startingCapital" class="block text-sm font-medium text-gray-700">
                            Starting Capital ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The total amount of money available to the company.</span>
                            </span>
                        </label>
                        <input type="number" id="startingCapital" name="startingCapital" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="monthlyExpenses" class="block text-sm font-medium text-gray-700">
                            Monthly Expenses ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The total amount of money spent by the company each month.</span>
                            </span>
                        </label>
                        <input type="number" id="monthlyExpenses" name="monthlyExpenses" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="monthlyRevenue" class="block text-sm font-medium text-gray-700">
                            Monthly Revenue ($)
                            <span class="tooltip ml-1">ⓘ
                                <span class="tooltiptext">The total amount of money earned by the company each month.</span>
                            </span>
                        </label>
                        <input type="number" id="monthlyRevenue" name="monthlyRevenue" min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green focus:ring-opacity-50" required>
                    </div>
                    <button type="submit" class="w-full bg-startup-iq-green text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-startup-iq-green focus:ring-opacity-50">Calculate Burn Rate</button>
                </form>
                <div id="burnRateResult" class="mt-4"></div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calculators = document.querySelectorAll('.calculator');
    const categoryButtons = document.querySelectorAll('.category-button');

    function setupCalculator(formId, calculatorType, resultElementId) {
        const form = document.getElementById(formId);
        const resultElement = document.getElementById(resultElementId);

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            calculateAndDisplay(form, calculatorType, resultElement);
        });

        // Quick Results feature
        form.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function() {
                this.value = Math.floor(this.value);
                calculateAndDisplay(form, calculatorType, resultElement);
            });
        });
    }

    function calculateAndDisplay(form, calculatorType, resultElement) {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        // Input validation
        let isValid = true;
        form.querySelectorAll('input').forEach(input => {
            if (input.value.trim() === '' || isNaN(input.value) || Number(input.value) < 0 || !Number.isInteger(Number(input.value))) {
                isValid = false;
                input.classList.add('border-red-500');
                let errorMessage = input.nextElementSibling;
                if (!errorMessage || !errorMessage.classList.contains('error-message')) {
                    errorMessage = document.createElement('div');
                    errorMessage.classList.add('error-message', 'text-red-500', 'text-sm', 'mt-1');
                    input.parentNode.insertBefore(errorMessage, input.nextSibling);
                }
                errorMessage.textContent = 'Please enter a valid non-negative whole number';
            } else {
                input.classList.remove('border-red-500');
                let errorMessage = input.nextElementSibling;
                if (errorMessage && errorMessage.classList.contains('error-message')) {
                    errorMessage.remove();
                }
            }
        });

        if (!isValid) {
            resultElement.innerHTML = '<p class="text-red-500">Please correct the errors in the form.</p>';
            return;
        }

        // Perform calculation
        let result;
        switch (calculatorType) {
            case 'tam':
                result = Number(data.totalCustomers) * Number(data.averageRevenue);
                resultElement.innerHTML = `
                    <p>Your Total Addressable Market (TAM) is: <strong>$${result.toLocaleString()}</strong></p>
                    <p class="mt-2"><strong>Industry Benchmark:</strong> TAM should be large enough to support your growth goals. <strong>A typical benchmark is at least $1 billion for venture-backed startups.</strong></p>
                `;
                break;
            case 'cpa':
                result = Number(data.marketingSpend) / Number(data.newCustomers);
                resultElement.innerHTML = `
                    <p>Your Cost Per Acquisition (CPA) is: <strong>$${result.toFixed(2)}</strong></p>
                    <p class="mt-2"><strong>Industry Benchmark:</strong> A good CPA varies by industry, but <strong>it should be significantly lower than your customer lifetime value (LTV).</strong></p>
                `;
                break;
            case 'ltvcac':
                const ltv = Number(data.averageOrderValue) * Number(data.purchaseFrequency) * Number(data.customerLifespan);
                result = ltv / Number(data.acquisitionCost);
                resultElement.innerHTML = `
                    <p>Your LTV:CAC Ratio is: <strong>${result.toFixed(2)}:1</strong></p>
                    <p class="mt-2"><strong>Industry Benchmark:</strong> A healthy LTV:CAC ratio is typically <strong>3:1 or higher</strong>. If it's lower, consider ways to increase customer value or reduce acquisition costs.</p>
                `;
                break;
            case 'paybackPeriod':
                result = Number(data.cac) / Number(data.arpa);
                resultElement.innerHTML = `
                    <p>Your Payback Period is: <strong>${result.toFixed(1)} months</strong></p>
                    <p class="mt-2"><strong>Industry Benchmark:</strong> A good payback period is typically <strong>12 months or less</strong> for SaaS companies. Shorter is better, as it means you recover your customer acquisition cost more quickly.</p>
                `;
                break;
            case 'burnRate':
                const monthlyBurn = Number(data.monthlyExpenses) - Number(data.monthlyRevenue);
                result = Number(data.startingCapital) / monthlyBurn;
                resultElement.innerHTML = `
                    <p>Your Runway is: <strong>${result.toFixed(1)} months</strong></p>
                    <p class="mt-2"><strong>Industry Benchmark:</strong> Startups typically aim for <strong>12-18 months of runway</strong> to provide enough time to reach key milestones and secure additional funding if needed.</p>
                `;
                break;
        }
    }

    setupCalculator('tamForm', 'tam', 'tamResult');
    setupCalculator('cpaForm', 'cpa', 'cpaResult');
    setupCalculator('ltvCacForm', 'ltvcac', 'ltvCacResult');
    setupCalculator('paybackPeriodForm', 'paybackPeriod', 'paybackPeriodResult');
    setupCalculator('burnRateForm', 'burnRate', 'burnRateResult');

    // Category filtering
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            calculators.forEach(calculator => {
                if (category === 'all' || calculator.dataset.category === category) {
                    calculator.style.display = 'block';
                } else {
                    calculator.style.display = 'none';
                }
            });
            categoryButtons.forEach(btn => btn.classList.remove('bg-startup-iq-green', 'text-white'));
            this.classList.add('bg-startup-iq-green', 'text-white');
        });
    });
});
</script>

<?php
// Include the footer
include 'footer.php';
?>