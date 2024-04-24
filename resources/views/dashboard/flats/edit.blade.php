@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Edit Flat</h1>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <form action="{{ route("edit_flat") }}" method="POST" class="space-y-4">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id" value="{{ $flat->id }}">
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div class="col-span-1 sm:col-span-1">
                            <label for="flat_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Flat Number</label>
                            <input type="text" name="flat_number" id="first_name" value="{{ old("flat_number" , $flat->flat_number) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Flat Number...">
                            @error("flat_number")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <label for="phase_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phase Number</label>
                            <input type="text" name="phase_number" id="last_name" value="{{ old("phase_number" , $flat->phase_number) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Phase Number...">
                            @error("phase_number")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1 sm:col-span-1 mb-4">
                            <label for="occupancy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Occupancy</label>
                            <input type="number" name="occupancy" id="occupancy" value="{{ old("occupancy" , $flat->occupancy) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Occupancy...">
                             @error("occupancy")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update
                    </button>
                </form>
            </div>
    </section>
</main>

@endsection
