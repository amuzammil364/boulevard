@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<style>
    @page{
        margin: 20px;
    }
        @media print {
            nav{
                display: none;
            }

            #default-sidebar {
                display: none;
            }

            #main{
                padding: 0 !important;
                margin: 0 !important;
            }

            form{
                display: none
            }

            h1{
                display: none;
            }

            .md\:w-1\/2{
                width: 50%;
                padding: 0.75rem;
            }

            .md\:flex-row{
                flex-direction: row;
            }

            .logo-container{
                display: block;
            }

            h3{
                padding-bottom: 0 !important;
                margin-bottom: 0 !important;
            }

            .total-calculation-table th,
            .total-calculation-table td{
                padding: 6px 10px;
                margin: 0;
            }
        }
    </style>

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20" id="main">
    <h1 class="font-bold text-3xl mb-8">Summary</h1>
    <form action="{{ route("summary") }}" method="GET" class="space-y-4 mb-5">
        @csrf
        <div class="grid gap-4 mb-4 grid-cols-2 md:grid-cols-4">
            <div class="col-span-1 sm:col-span-1">
                <input type="month" name="summary_month" id="summary_month" value="{{ $date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>
            <div class="col-span-1 sm:col-span-1">
                <input type="number" name="opening_balance" id="opening_balance" value="{{ $opening_balance }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>

            <div class="col-span-1 sm:col-span-1">
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Filter
                </button>
            </div>
            <div class="col-span-1 sm:col-span-1 text-right">
                <button onclick="printSection()" type="button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Print
                </button>
            </div>
        </div>
    </form>

    <div class="logo-container hidden mb-3">
        <div class="top-container border-b-2 text-center">
            <div class="login-logo-container mb-3">
                <img class="h-auto mx-auto" width="150" src="{{URL::asset('/images/logo-vertical.png')}}" alt="image description">
                <p class="font-bold text-xl mt-2 uppercase">Residents Welfare Association</p>
                <p class="text-sm">(Reg.No. Karachi-700/1999)</p>
                <p class="text-sm">Scheme No.36 Fl-11/12, Block 15, Gulistan-e-jauhar</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between flex-wrap space-y-3 md:space-y-0 py-4" id="printable-section">

      <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md w-full md:w-1/2">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
            <h3 class="font-medium text-2xl mb-6 p-2">Expenses</h3>

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">Type</th>
                            <th scope="col" class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($expenses_types) === 0)

                        <tr class="border-b dark:border-gray-700">
                            <td colspan="5" scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">No Data</th>
                        </tr>

                        @else

                        @foreach ($expenses_types as $index => $expense_type )

                            @if($expense_type["amount"] != 0)

                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index+1 }}</th>
                                <td class="px-4 py-3">{{ $expense_type["type"] }}</td>
                                <td class="px-4 py-3">{{ $expense_type["amount"] }}</td>
                            </tr>

                            @endif

                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
            <p class="mt-6 mb-6 px-5 text-md text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400"><b>Total : {{ $expenses_types_total_amount }}</b></p>
        </div>
    </section>
     <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md w-full md:w-1/2">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
            <h3 class="font-medium text-2xl mb-6 p-2">Collections <span class="text-base text-blue-600"> (Paid)</span></h3>

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">Type</th>
                            <th scope="col" class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($collection_types) === 0)

                        <tr class="border-b dark:border-gray-700">
                            <td colspan="5" scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">No Data</th>
                        </tr>

                        @else

                        @foreach ($collection_types as $index => $collection_type )

                            @if($collection_type["amount_paid"] != 0)

                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index+1 }}</th>
                                <td class="px-4 py-3">{{ $collection_type["type"] }}</td>
                                <td class="px-4 py-3">{{ $collection_type["amount_paid"] }}</td>
                            </tr>

                            @endif

                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
            <p class="mt-6 mb-6 px-5 text-md text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400"><b>Total : {{ $paid_collection_types_total_amount }}</b></p>
        </div>

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden mt-5">
            <h3 class="font-medium text-2xl mb-6 p-2">Arrears</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">Type</th>
                            <th scope="col" class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($collection_types_arrears) === 0)

                        <tr class="border-b dark:border-gray-700">
                            <td colspan="5" scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">No Data</th>
                        </tr>

                        @else

                        @foreach ($collection_types_arrears as $index => $collection_type )

                            @if($collection_type["amount"] != 0)

                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index+1 }}</th>
                                <td class="px-4 py-3">{{ $collection_type["type"] }}</td>
                                <td class="px-4 py-3">{{ $collection_type["amount"] }}</td>
                            </tr>

                            @endif

                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
            <p class="mt-6 mb-6 px-5 text-md text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400"><b>Total : {{ $collection_types_total_amount_arrears }}</b></p>
        </div>

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden mt-5">
            <h3 class="font-medium text-2xl mb-6 p-2">Advance</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">Type</th>
                            <th scope="col" class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($collection_types_advance) === 0)

                        <tr class="border-b dark:border-gray-700">
                            <td colspan="5" scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">No Data</th>
                        </tr>

                        @else

                        @foreach ($collection_types_advance as $index => $collection_type )

                            @if($collection_type["amount"] != 0)

                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index+1 }}</th>
                                <td class="px-4 py-3">{{ $collection_type["type"] }}</td>
                                <td class="px-4 py-3">{{ $collection_type["amount"] }}</td>
                            </tr>

                            @endif

                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
            <p class="mt-6 mb-6 px-5 text-md text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400"><b>Total : {{ $collection_types_total_amount_advance }}</b></p>
        </div>
                        <div class="bg-white dark:bg-gray-800 relative shadow-md mt-5 sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
            <h3 class="font-medium text-2xl mb-6 p-2">Collections <span class="text-base text-blue-600"> (Pending)</span></h3>

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">Type</th>
                            <th scope="col" class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($collection_types) === 0)

                        <tr class="border-b dark:border-gray-700">
                            <td colspan="5" scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">No Data</th>
                        </tr>

                        @else

                        @foreach ($collection_types as $index => $collection_type )

                            @if($collection_type["amount_pending"] != 0)

                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index+1 }}</th>
                                <td class="px-4 py-3">{{ $collection_type["type"] }}</td>
                                <td class="px-4 py-3">{{ $collection_type["amount_pending"] }}</td>
                            </tr>

                            @endif

                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
            <p class="mt-6 mb-6 px-5 text-md text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400"><b>Total : {{ $pending_collection_types_total_amount }}</b></p>
        </div>


    </section>
        <table class="border border-black total-calculation-table" style="margin-top: 24px;">
        <thead>
            <tr>
                <th class="border border-black py-2 px-3">Total Income</th>
                <td class="border border-black py-2 px-3">{{ $opening_balance + $collection_types_total_amount_advance + $paid_collection_types_total_amount +  $collection_types_total_amount_arrears}}</td>
            </tr>
             <tr>
                <th class="border border-black py-2 px-3">Total Expense</th>
                <td class="border border-black py-2 px-3">{{$expenses_types_total_amount }}</td>
            </tr>
            <tr>
                <th class="border border-black py-2 px-3">Opening Balance</th>
                <td class="border border-black py-2 px-3">{{ $opening_balance }}</td>
            </tr>
            <tr>
                <th class="border border-black py-2 px-3">Closing Balance</th>
                <td class="border border-black py-2 px-3">{{ $opening_balance + $collection_types_total_amount_advance + $paid_collection_types_total_amount +  $collection_types_total_amount_arrears - $expenses_types_total_amount }}</td>
            </tr>
        </thead>
    </table>
    </div>

</main>

<script>

function printSection(){
    window.print();
}

</script>

@endsection
