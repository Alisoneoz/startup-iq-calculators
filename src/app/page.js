"use client"

import { useState } from 'react';

const calculators = [
  {
    id: 'tam',
    title: 'Total Addressable Market (TAM) Calculator',
    category: 'financial',
    fields: [
      {
        id: 'totalCustomers',
        label: 'Total Number of Potential Customers',
        tooltip: 'The total number of customers that could potentially use your product or service.'
      },
      {
        id: 'averageRevenue',
        label: 'Average Revenue per Customer ($)',
        tooltip: 'The average amount of revenue generated from each customer.'
      }
    ],
    calculate: (data) => ({
      result: `$${(data.totalCustomers * data.averageRevenue).toLocaleString()}`,
      benchmark: 'TAM should be large enough to support your growth goals. A typical benchmark is at least $1 billion for venture-backed startups.'
    })
  },
  {
    id: 'cpa',
    title: 'Cost Per Acquisition (CPA) Calculator',
    category: 'marketing',
    fields: [
      {
        id: 'marketingSpend',
        label: 'Total Marketing Spend ($)',
        tooltip: 'The total amount spent on marketing efforts.'
      },
      {
        id: 'newCustomers',
        label: 'Number of New Customers Acquired',
        tooltip: 'The total number of new customers acquired from your marketing efforts.'
      }
    ],
    calculate: (data) => ({
      result: `$${(data.marketingSpend / data.newCustomers).toFixed(2)}`,
      benchmark: 'A good CPA varies by industry, but it should be significantly lower than your customer lifetime value (LTV).'
    })
  },
  {
    id: 'ltvcac',
    title: 'LTV:CAC Ratio Calculator',
    category: 'financial',
    fields: [
      {
        id: 'averageOrderValue',
        label: 'Average Order Value ($)',
        tooltip: 'The average amount a customer spends on a single order.'
      },
      {
        id: 'purchaseFrequency',
        label: 'Purchase Frequency (per year)',
        tooltip: 'How many times a customer makes a purchase in a year.'
      },
      {
        id: 'customerLifespan',
        label: 'Customer Lifespan (in years)',
        tooltip: 'The average number of years a customer continues to purchase from you.'
      },
      {
        id: 'acquisitionCost',
        label: 'Customer Acquisition Cost (CAC) ($)',
        tooltip: 'The cost of acquiring a single customer.'
      }
    ],
    calculate: (data) => {
      const ltv = data.averageOrderValue * data.purchaseFrequency * data.customerLifespan;
      const ratio = ltv / data.acquisitionCost;
      return {
        result: `${ratio.toFixed(2)}:1`,
        benchmark: 'A healthy LTV:CAC ratio is typically 3:1 or higher. If it\'s lower, consider ways to increase customer value or reduce acquisition costs.'
      };
    }
  },
  {
    id: 'paybackPeriod',
    title: 'Payback Period Calculator',
    category: 'financial',
    fields: [
      {
        id: 'cac',
        label: 'Customer Acquisition Cost (CAC) ($)',
        tooltip: 'The cost of acquiring a single customer.'
      },
      {
        id: 'arpa',
        label: 'Average Revenue per Account (ARPA) per month ($)',
        tooltip: 'The average monthly revenue generated from each customer account.'
      }
    ],
    calculate: (data) => ({
      result: `${(data.cac / data.arpa).toFixed(1)} months`,
      benchmark: 'A good payback period is typically 12 months or less for SaaS companies. Shorter is better.'
    })
  },
  {
    id: 'burnRate',
    title: 'Burn Rate Calculator',
    category: 'financial',
    fields: [
      {
        id: 'startingCapital',
        label: 'Starting Capital ($)',
        tooltip: 'The total amount of money available to the company.'
      },
      {
        id: 'monthlyExpenses',
        label: 'Monthly Expenses ($)',
        tooltip: 'The total amount of money spent by the company each month.'
      },
      {
        id: 'monthlyRevenue',
        label: 'Monthly Revenue ($)',
        tooltip: 'The total amount of money earned by the company each month.'
      }
    ],
    calculate: (data) => {
      const monthlyBurn = data.monthlyExpenses - data.monthlyRevenue;
      return {
        result: `${(data.startingCapital / monthlyBurn).toFixed(1)} months`,
        benchmark: 'Startups typically aim for 12-18 months of runway to provide enough time to reach key milestones.'
      };
    }
  }
];

export default function Calculators() {
  const [activeCategory, setActiveCategory] = useState('all');
  const [calculatorResults, setCalculatorResults] = useState({});

  const categories = [
    { id: 'all', label: 'All' },
    { id: 'financial', label: 'Financial' },
    { id: 'marketing', label: 'Marketing' },
    { id: 'growth', label: 'Growth' }
  ];

  const handleSubmit = (e, calculator) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = {};
    formData.forEach((value, key) => {
      data[key] = Number(value);
    });

    const result = calculator.calculate(data);
    setCalculatorResults(prev => ({
      ...prev,
      [calculator.id]: result
    }));
  };

  return (
    <main className="flex-grow">
      <div className="container mx-auto px-4 py-8 max-w-6xl">
        <h1 className="text-4xl font-bold mb-8 text-center text-startup-iq-green">
          Go-to-Market Calculators
        </h1>

        <div className="mb-8 flex justify-center space-x-4">
          {categories.map(category => (
            <button
              key={category.id}
              className={`px-4 py-2 rounded transition-colors ${
                activeCategory === category.id 
                  ? 'bg-startup-iq-green text-white' 
                  : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
              }`}
              onClick={() => setActiveCategory(category.id)}
            >
              {category.label}
            </button>
          ))}
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {calculators.map(calculator => (
            <div
              key={calculator.id}
              className={`calculator bg-white p-6 rounded-lg shadow-md h-full flex flex-col justify-between ${
                activeCategory !== 'all' && activeCategory !== calculator.category 
                  ? 'hidden' 
                  : ''
              }`}
            >
              <div>
                <h2 className="text-2xl font-semibold mb-4 text-startup-iq-green">
                  {calculator.title}
                </h2>
                
                <form
                  onSubmit={(e) => handleSubmit(e, calculator)}
                  className="space-y-4"
                >
                  <div className="space-y-4">
                    {calculator.fields.map(field => (
                      <div key={field.id}>
                        <label className="block text-sm font-medium text-gray-700">
                          {field.label}
                          <span className="tooltip ml-1 cursor-help relative group">
                            ⓘ
                            <span className="tooltiptext invisible group-hover:visible absolute z-10 w-48 bg-black text-white text-xs rounded py-1 px-2 -right-1 bottom-full mb-2">
                              {field.tooltip}
                            </span>
                          </span>
                        </label>
                        <input
                          type="number"
                          name={field.id}
                          min="0"
                          step="1"
                          className="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                   focus:border-startup-iq-green focus:ring focus:ring-startup-iq-green 
                                   focus:ring-opacity-50"
                          required
                        />
                      </div>
                    ))}
                  </div>

                  {calculatorResults[calculator.id] && (
                    <div className="mt-4 p-4 bg-gray-50 rounded-lg">
                      <p className="font-bold text-startup-iq-green">
                        Result: {calculatorResults[calculator.id].result}
                      </p>
                      <p className="mt-2 text-sm text-gray-600">
                        <strong>Industry Benchmark:</strong>{' '}
                        {calculatorResults[calculator.id].benchmark}
                      </p>
                    </div>
                  )}
                </form>
              </div>

              <button
                type="submit"
                form={`calculator-${calculator.id}`}
                className="w-full bg-startup-iq-green text-white px-4 py-2 rounded 
                         hover:bg-startup-iq-green/90 focus:outline-none focus:ring-2 
                         focus:ring-startup-iq-green focus:ring-opacity-50 
                         transition-colors mt-6"
              >
                Calculate
              </button>
            </div>
          ))}
        </div>
      </div>
    </main>
  );
}
