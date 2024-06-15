@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Settings</h1>

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
            <div class="overflow-x-auto">
                <form action="{{ route("add_options") }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div class="col-span-1 sm:col-span-1">
                            <label for="maintenance_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Flat Maintenance</label>
                            <input type="number" name="maintenance_amount" id="maintenance_amount" value="{{ $maintenance_amount }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Flat Maintenance..." >
                            @error("maintenance_amount")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <label for="currency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Currency</label>
                            <input type="text" name="currency" id="currency" value="{{ $currency }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Currency...">
                            @error("currency")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <label for="collection_due_day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Collection due day</label>
                            <input type="number" name="collection_due_day" id="collection_due_day" value="{{ $collection_due_day }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Collection due day">
                            @error("collection_due_day")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <label for="receipt_reminder_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receipt Reminder Email</label>
                            <textarea id="receipt_reminder_email" name="receipt_reminder_email" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{$receipt_reminder_email}}</textarea>
                            @error("receipt_reminder_email")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <label for="receipt_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receipt Email</label>
                            <textarea id="receipt_email" name="receipt_email" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{$receipt_email}}</textarea>
                            @error("receipt_email")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Save
                    </button>
                </form>
            </div>
    </section>
</main>

@endsection
