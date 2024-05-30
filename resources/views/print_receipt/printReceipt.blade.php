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
                        <thead class="text-xs text-black uppercase ">
                            <tr>
                                <th scope="col" class="font-bold">
                                    Month
                                </th>
                                <th scope="col" class="font-bold">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody class="inline-grid">
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 mt-1 inline-block">
                                <th scope="row" class=" font-bold text-black whitespace-nowrap uppercase">
                                    Flat
                                </th>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 mt-1 inline-block">
                                <th scope="row" class=" font-bold text-black whitespace-nowrap uppercase">
                                    Phase
                                </th>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 mt-1 inline-block">
                                <th scope="row" class=" font-bold text-black whitespace-nowrap uppercase">
                                    Resident
                                </th>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 mt-1 inline-block">
                                <th scope="row" class=" font-bold text-black whitespace-nowrap uppercase">
                                    Contact
                                </th>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 mt-1 inline-block">
                                <th scope="row" class=" font-bold text-black whitespace-nowrap uppercase">
                                    Payment Id
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
                                <th scope="col" class="px-6 py-3 border border-gray-500">
                                </th>
                                <th scope="col" class="px-6 py-3 border border-gray-500">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white">
                                <th scope="row" class="px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white border border-gray-500">
                                    Maintenance Free <span class="font-medium">(May'24)</span>
                                </th>
                                <td class="px-6 py-1 border border-gray-500 text-gray-900">
                                    4000.00 PKR
                                </td>
                            </tr>
                             <tr class="bg-white">
                                <th scope="row" class="px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    Total
                                </th>
                                <td class="px-6 py-1 border border-gray-500 text-gray-900">
                                    4000.00 PKR
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
</body>