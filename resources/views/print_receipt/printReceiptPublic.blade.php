<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safari Boulevard - Data Management System</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>

<div class="print-receipt w-full h-screen flex justify-center pt-10 px-4">
    <div class="receipt" style="max-width: 600px; width: 100%;">
        <div class="top-container border-b-2 text-center">
            <div class="login-logo-container mb-3">
                <img class="h-auto mx-auto" width="150" src="{{URL::asset('/images/logo-vertical.png')}}" alt="image description">
                <p class="font-bold text-xl mt-2 uppercase">Residents Welfare Association</p>
                <p class="text-sm">(Reg.No. Karachi-700/1999)</p>
                <p class="text-sm">Scheme No.36 Fl-11/12, Block 15, Gulistan-e-jauhar</p>
            </div>
        </div>
        <div class="bottom-container pt-9 px-12">
            <div class="table1">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-black uppercase ">
                            <tr>
                                <th scope="col" class="">
                                    <strong style="color: rgba(25, 182, 175, 1)">Month: </strong> {{ $data['month'] }}
                                </th> 
                                <th scope="col" class="">
                                    <strong style="color: rgba(25, 182, 175, 1)">Date: </strong> {{ $data['date'] }}
                                </th>
                            </tr>
                            <tr class="">
                                <th scope="col" class="">
                                    <strong style="color: rgba(25, 182, 175, 1)">Flat: </strong> {{ $data['flat'] }}
                                </th>
                                <th scope="col" class="">
                                    <strong style="color: rgba(25, 182, 175, 1)">Receipt ID: </strong> {{ $data['receipt_id'] }}
                                </th>
                            </tr>
                            <tr class="">
                                <th scope="col" class="">
                                    <strong style="color: rgba(25, 182, 175, 1)">Phase: </strong>{{ $data['phase'] }}
                                </th>
                                <th scope="col" class="" style="position: relative;">
                                    <img style="position: absolute;top:10px" src='https://api.qrserver.com/v1/create-qr-code/?data={{ url("/dashboard/view-receipt?pid=$payment_id") }}&amp;size=100x100' alt="" title="" />
                                </th>

                            </tr>

                        </thead>
                        <tbody class="inline-grid mb-5">
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 mt-1 inline-block">
                                <th scope="row" class="text-black whitespace-nowrap uppercase">
                                    <strong style="color: rgba(25, 182, 175, 1)">Resident: </strong>{{ $data['resident'] }}
                                </th>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 mt-1 inline-block">
                                <th scope="row" class="text-black whitespace-nowrap uppercase">
                                    <strong style="color: rgba(25, 182, 175, 1)">Contact: </strong>{{ $data['contact'] }}
                                </th>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 mt-1 inline-block">
                                <th scope="row" class="text-black whitespace-nowrap uppercase">
                                    <strong style="color: rgba(25, 182, 175, 1)">Payment ID: </strong>{{ $data['payment_id'] }}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="table2 mt-4">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase ">
                            <tr>
                                <th scope="col" class="px-6 py-2 border border-gray-500">Item</th>
                                <th scope="col" class="px-6 py-2 border border-gray-500">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['receipt_items'] as $key=>$value )
                                
                            @endforeach
                            <tr class="bg-white">
                                <th scope="row" class="px-6 py-2 font-bold text-gray-900 whitespace-nowrap dark:text-white border border-gray-500">
                                    {{ $key }} <span class="font-medium"> <small>( {{ $data['month'] }} )</small>  </span>
                                </th>
                                <td class="px-6 py-2 border border-gray-500 text-gray-900">
                                    {{ $value }} PKR
                                </td>
                            </tr>
                             <tr class="bg-white">
                                <th scope="row" class="px-6 py-2 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    Total Amount Received
                                </th>
                                <td class="px-6 py-2 border border-gray-500 text-gray-900">
                                    {{ $total }} PKR
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="bottom-tagline mt-20 border-t-2 border-b-2 text-center">
            <p class="text-gray-800 text-sm py-2">This is a digitally generated receipt, does not require signature</p>
        </div>
    </div>
</div>

</html>
<script>
    // document.addEventListener('DOMContentLoaded',()=>{
    //     window.print();
    // })


</script>
</body>