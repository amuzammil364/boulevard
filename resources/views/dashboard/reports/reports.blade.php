@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20" id="main">
    <div class="flex items-center justify-center space-y-3 md:space-y-0 w-full" style="height: 70vh;">
        <div class="w-full md:w-1/2">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Reports</h5>
                <div class="reports-btns mt-6 inline-block flex justify-center">
                    <form action="" class="mr-2">
                        @csrf
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Defaulters
                        </button>
                    </form>
                    <a href="{{ url("/dashboard/summary") }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Monthly Summary Report
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection