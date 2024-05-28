@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Residents</h1>

    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 py-4">
        <div class="w-full md:w-1/2">
        </div>
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <a href="{{ url("/dashboard/residents/add") }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-[24px] h-[24px] text-white mr-2 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                </svg>

                Add Resident
            </a>
        </div>
    </div>

    @if (Session::has("success"))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ Session::get("success") }}</span>
        </div>
    @endif

    @if (Session::has("fail"))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
         <span class="font-medium">{{ Session::get("fail") }}</span>
        </div>
    @endif

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
        <p class="w-full text-right mb-3">Total : {{ $residents_count }}</p>
       
    <div class="filters">
                <form action="{{ route("residents") }}" method="GET" class="space-y-4 mb-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2 md:grid-cols-2">
                        <div class="col-span-1 sm:col-span-1">
                            <input id="full_name" name="full_name" value="{{ $filters->full_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Name..." />
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Status</option>
                                <option value="Active" {{ $filters->status == "Active"  ? "selected" : "" }}>Active</option>
                                <option value="Vacant (Paid)" {{ $filters->status == "Vacant (Paid)"  ? "selected" : ""}}>Vacant (Paid)</option>
                                <option value="Vacant (Arrears)" {{ $filters->status == "Vacant (Arrears)"  ? "selected" : ""}}>Vacant (Arrears)</option>
                                <option value="Active (Arrears)" {{ $filters->status == "Active (Arrears)"  ? "selected" : ""}}>Active (Arrears)</option>
                                <option value="Active (Rented)" {{ $filters->status == "Active (Rented)"  ? "selected" : ""}}>Active (Rented)</option>
                                <option value="TBC" {{ $filters->status == "TBC"  ? "selected" : ""}}>TBC</option>
                                <option value="Inactive" {{ $filters->status == "Inactive"  ? "selected" : ""}}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Type</option>
                                <option value="Owner" {{ $filters->type == "Owner"  ? "selected" : ""}}>Owner</option>
                                <option value="Tenant" {{ $filters->type == "Tenant"  ? "selected" : ""}}>Tenant</option>
                                <option value="Former Owner" {{ $filters->type == "Former Owner"  ? "selected" : ""}}>Former Owner</option>
                                <option value="Former Tenant" {{ $filters->type == "Former Tenant"  ? "selected" : ""}}>Former Tenant</option>
                            </select>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <select id="flat" name="flat_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Flat</option>
                                @foreach ($flats as $flat)
                                <option value="{{ $flat->id }}" {{ $filters->flat_id == $flat->id  ? "selected" : "" }}>{{ $flat->flat_number }} ({{ $flat->phase_number }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
    
    
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">Full Name</th>
                            <th scope="col" class="px-4 py-3">Flat</th>
                            <th scope="col" class="px-4 py-3">Type</th>
                            <th scope="col" class="px-4 py-3">Mobile</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($residents->isEmpty())

                        <tr class="border-b dark:border-gray-700">
                            <td colspan="5" scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">No Data</th>
                        </tr>

                        @else

                        @foreach ($residents as $index => $resident)

                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index + 1 }}</th>
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $resident->full_name }}</th>
                            <td class="px-4 py-3">{{ $resident->flat->flat_number }} {{ "" }} ({{ $resident->flat->phase_number }})</td>
                            <td class="px-4 py-3">{{ $resident->type }}</td>
                            <td class="px-4 py-3">{{ $resident->mobile }}</td>
                            <td class="px-4 py-3">{{ $resident->status }}</td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <span>
                                    <a href="{{ url("/dashboard/residents/$resident->id") }}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>
                                    </a>
                                </span>
                                <span class="ml-5">
                                    <a href="{{ url("/dashboard/residents/edit/$resident->id") }}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                    </a>
                                </span>
                                <span class="ml-5">
                                    <button onclick="ConfirmationModal({{ $resident->id }})" type="button" data-modal-target="delete-user-modal" data-modal-toggle="delete-user-modal" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>
                                    </button>
                                </span>
                            </td>
                        </tr>

                        @endforeach

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include("components.confirmationModal.confirmation" , ["route" => "delete_resident"])

</main>


@endsection
