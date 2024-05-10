
@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-4">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Flats</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $flats }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Total number of flats</p>
            <!-- <a href="{{ url("/dashboard/flats") }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                View more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a> -->
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Payments</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">PKR {{ $payments }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Total current month payments</p>
            <!-- <a href="{{ url("/dashboard/payments") }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                View more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a> -->
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Expenses</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">PKR {{ $expenses }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Total current month expenses</p>
            <!-- <a href="{{ url("/dashboard/expenses") }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                View more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a> -->
        </div>

    </div>
    <div class="rounded bg-gray-50 p-8 mt-5">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-3xl mb-2">Payments</h3>
                <p class="">This is a list of Current Moth Payments</p>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Id</th>
                                <th scope="col" class="px-4 py-3">Flat</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Type</th>
                                <th scope="col" class="px-4 py-3">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($payments_data->isEmpty())

                            <tr class="border-b dark:border-gray-700">
                                <td colspan="5" scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">No Data</th>
                            </tr>

                            @else

                            @foreach ($payments_data as $index => $payment)

                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index + 1 }}</th>
                                <td class="px-4 py-3">{{ $payment->flat->flat_number }} ({{ $payment->flat->phase_number }})</td>
                                <td class="px-4 py-3">{{ $payment->status }}</td>
                                <td class="px-4 py-3">{{ $payment->type }}</td>
                                <td class="px-4 py-3">{{ $payment->amount }}</td>
                            </tr>

                            @endforeach

                            @endif
                        </tbody>
                    </table>


        </div>
    </div>

    <div class="rounded bg-gray-50 p-8 mt-5">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-3xl mb-2">Expenses</h3>
                <p class="">This is a list of Current Moth Expenses</p>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Id</th>
                            <th scope="col" class="px-4 py-3">Payment Id</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($expenses_data->isEmpty())

                        <tr class="border-b dark:border-gray-700">
                            <td colspan="5" scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">No Data</th>
                        </tr>

                        @else

                        @foreach ($expenses_data as $index => $expense)

                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index + 1 }}</th>
                            <td class="px-4 py-3">{{ $expense->payment_id }}</td>
                            <td class="px-4 py-3">{{ $expense->status }}</td>
                            <td class="px-4 py-3">{{ $expense->amount }}</td>
                        </tr>

                        @endforeach

                        @endif
                    </tbody>
                </table>
    </div>


</main>

@endsection
