
@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <form action="{{ route("dashboard") }}" method="GET" class="space-y-4 mb-5">
        @csrf
        <div class="grid gap-4 mb-4 grid-cols-2 md:grid-cols-2">
            <div class="col-span-1 sm:col-span-1">
                <input type="month" name="dashboard_month" id="dashboard_month" value="{{ $date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>
            <div class="col-span-1 sm:col-span-1">
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Filter
                </button>
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-4">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ url("/dashboard/residents") }}" > <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Residents</h5></a>
            <p class="font-normal text-gray-700 dark:text-gray-400"> <strong>Active</strong> - {{ $resident_actives }} </p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"> <strong>Vacant</strong> - {{ $resident_vacants }} </p>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ url("/dashboard/payments") }}" ><h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Collections</h5></a>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>Paid</strong> - PKR {{ $payments_paid }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><strong>Pending</strong> - PKR {{ $payments_pending }}</p>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ url("/dashboard/expenses") }}" ><h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Expenses</h5></a>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>Paid</strong> - PKR {{ $expenses_paid }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><strong>Pending</strong> - PKR {{ $expenses_pending }}</p>
        </div>

    </div>
    <div class="rounded bg-gray-50 p-8 mt-5">
        <div class="flex items-center justify-between mb-6">
            <div>
            <a href="{{ url("/dashboard/payments") }}" ><h3 class="font-bold text-3xl mb-2">Collections</h3></a>
                <p class="">This is a list of Current Month Collections</p>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">#</th>
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
            <a href="{{ url("/dashboard/expenses") }}" ><h3 class="font-bold text-3xl mb-2">Expenses</h3></a>
                <p class="">This is a list of Current Month Expenses</p>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
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
