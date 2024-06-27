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

        .logo-container{
            display: block;
        }

        .printable_summary_date{
            display: block;
        }

        .printable_summary_date span{
            -webkit-print-color-adjust: exact; 
        }

        #flat{
            margin-bottom: 20px;
        }

        #flat th,
        #flat td{
            padding: 8px 10px;
            font-size: 16px;
        }

        #dates-amount-calculation{
            margin-top: 0px !important;
        }

        #payment{
            -webkit-print-color-adjust: exact; 
        }

         #dates-amount-calculation th,
         #dates-amount-calculation td{
            padding: 5px 10px;
         }
    }
</style>

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20" id="main">
    <h1 class="font-bold text-3xl mb-8">Defaulters</h1>

     <form action="{{ route("defaulters") }}" method="GET" class="space-y-4 mb-5">
        @csrf
        <div class="grid gap-4 mb-4 grid-cols-2 md:grid-cols-5">
            <div class="col-span-1 sm:col-span-1">
                <label for="defaulter_from_month" class="block mb-2 text-sm font-medium text-gray-900">From</label>
                <input type="month" name="defaulter_from_month" id="defaulter_from_month" value="{{ $from_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>
            <div class="col-span-1 sm:col-span-1">
                <label for="defaulter_to_month" class="block mb-2 text-sm font-medium text-gray-900">To</label>
                <input type="month" name="defaulter_to_month" id="defaulter_to_month" value="{{ $to_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>
            <div class="col-span-1 sm:col-span-1">
                <label for="defaulter_to_month" class="block mb-2 text-sm font-medium text-gray-900">Type</label>
                <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    <option value="">Select Type</option>
                    <option value="Maintenance" {{ $type == "Maintenance"  ? "selected" : ""}} selected>Maintenance</option>
                    <option value="Welfare" {{ $type == "Welfare"  ? "selected" : ""}}>Welfare</option>
                    <option value="Misc" {{ $type == "Misc"  ? "selected" : ""}}>Misc</option>
                    <option value="Eid-ul-Adha Provision" {{ $type == "Eid-ul-Adha Provision"  ? "selected" : ""}}>Eid-ul-Adha Provision</option>
                    <option value="Paint Renovation" {{ $type == "Paint Renovation" ? "selected" : "" }}>Paint Renovation</option>
                
                </select>
            </div>

            <div class="col-span-1 sm:col-span-1 flex items-end">
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Filter
                </button>
            </div>
            <div class="col-span-1 sm:col-span-1 flex items-end xl:justify-end">
                <button type="button" onclick="printSection()" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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

    <div class="printable_summary_date hidden mt-8 mb-2">
        <h2 class="font-bold text-xl text-center flex items-center justify-center">{{ date("F , Y" , strtotime($from_date)) }} <span class="w-8 h-1 bg-black inline-block mx-3 mt-1"></span> to <span class="w-8 h-1 bg-black inline-block mx-3 mt-1"></span> {{ date("F , Y" , strtotime($to_date)) }} ({{ $type }})</h2>
    </div>

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">

            @if($flats->isEmpty())
                <p class="text-center">Flats is not available!</p>
            @endif

            @foreach ($flats as $index => $flat)
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden mb-10 border border-gray-400" id="flat">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <tr>
                                <th scope="col" class="px-4 py-3">#</th>
                                <td scope="col" class="px-4 py-3">{{ $index + 1 }}</th>
                            </tr>
                            <tr>
                                <th scope="col" class="px-4 py-3 text-lg">Flat</th>
                                <td scope="col" class="px-4 py-3 text-lg">{{ $flat->flat_number }} {{ " " }} ({{ $flat->phase_number }})</th>
                            </tr>
                            <tr>
                                <th scope="col" class="px-4 py-3 text-lg">Resident</th>
                                <td scope="col" class="px-4 py-3 text-lg">{{ !empty($flat->residents[0])?$flat->residents[0]->full_name:"" }} </th>
                            </tr>
                                <tr class="bg-gray-100" id="payment">
                                    <th scope="col" class="px-4 py-3 text-base border border-gray-400">Period</th>
                                    <th scope="col" class="px-4 py-3 text-base border border-gray-400">Amount</th>
                                    @foreach ($flat->payments as $payment)
                                    <tr class="bg-gray-100" id="payment">
                                        <th scope="col" class="px-4 py-3 text-base">{{ date('M Y' , strtotime($payment->payment_month)) }}</th>
                                        <th scope="col" class="px-4 py-3 text-base">{{ number_format($payment->amount) }} PKR</th>
                                    </tr>
                                    @endforeach
                                    <tr class="bg-gray-100" id="payment">
                                        <th scope="col" class="px-4 py-3 text-lg border border-gray-300">Total</th>
                                        <th scope="col" class="px-4 py-3 text-lg border border-gray-300">{{ number_format($flat->totalAmount) }} PKR</th>
                                    </tr>
                                </tr>
                            </tr>
                        </thead>
                </table>
            </div>
        </div>
        @endforeach

    </section>
    @if($flats->isNotEmpty())
            <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md mt-8" id="dates-amount-calculation">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">{{ $type }}</th>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collectionTypesTotal as $collectionType)
                            @if($collectionType['amount'] != 0)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $collectionType['month'] }}</td>
                                    <td class="px-4 py-3">{{ $collectionType['number_of_rows'] }}</td>
                                    <td class="px-4 py-3">{{ number_format($collectionType['amount']) }} PKR</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @endif

</main>


<script>

function printSection(){
    window.print();
}

</script>

@endsection