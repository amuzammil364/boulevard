@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Add Employee</h1>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <form action="{{ route("add_employee") }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name <span class="text-red-600">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old("name") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Name...">
                            @error("name")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role <span class="text-red-600">*</span></label>
                            <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select role</option>
                                <option value="Watchman" {{ old("role") == "Watchman" ? "selected" : "" }}>Watchman</option>
                                <option value="Accountant" {{ old("role") == "Accountant" ? "selected" : "" }}>Accountant</option>
                                <option value="Administrator" {{ old("role") == "Administrator" ? "selected" : "" }}>Administrator</option>
                                <option value="Manager" {{ old("role") == "Manager" ? "selected" : "" }}>Manager</option>
                                <option value="Sweeper" {{ old("role") == "Sweeper" ? "selected" : "" }}>Sweeper</option>                                
                                <option value="Gardener" {{ old("role") == "Gardener" ? "selected" : "" }}>Gardener</option>                                
                                <option value="Electrician" {{ old("role") == "Electrician" ? "selected" : "" }}>Electrician</option>                                
                                <option value="Plumber" {{ old("role") == "Plumber" ? "selected" : "" }}>Plumber</option>                                
                                <option value="Vendor" {{ old("role") == "Vendor" ? "selected" : "" }}>Vendor</option>                                
                                <option value="CCTV Technitian" {{ old("role") == "CCTV Technitian" ? "selected" : "" }}>CCTV Technitian</option>                                
                                <option value="Intercom" {{ old("role") == "Intercom" ? "selected" : "" }}>Intercom</option>                                
                                <option value="TV Cable" {{ old("role") == "TV Cable" ? "selected" : "" }}>TV Cable</option>                                
                                <option value="Carpenter" {{ old("role") == "Carpenter" ? "selected" : "" }}>Carpenter</option>                                
                                <option value="Goods Supplier" {{ old("role") == "Goods Supplier" ? "selected" : "" }}>Goods Supplier</option>                                
                                <option value="Water Supplier" {{ old("role") == "Water Supplier" ? "selected" : "" }}>Water Supplier</option>                                
                                <option value="Mason" {{ old("role") == "Mason" ? "selected" : "" }}>Mason</option>                                
                                <option value="Other" {{ old("role") == "Other" ? "selected" : "" }}>Other</option>                                
                            </select>
                            @error("role")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="address" id="address" value="{{ old("address") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Address...">
                            @error("address")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="cnic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cnic</label>
                            <input type="text" name="cnic" id="cnic" value="{{ old("cnic") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cnic Number...">
                            @error("cnic")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                            <input type="number" name="phone" id="phone" value="{{ old("phone") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Phone...">
                            @error("phone")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="salary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                            <input type="number" name="salary" id="salary" value="{{ old("salary") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Salary...">
                            @error("salary")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="comps" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference</label>
                            <input type="text" name="comps" id="comps" value="{{ old("comps") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Reference...">
                            @error("comps")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status <span class="text-red-600">*</span></label>
                            
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Status</option>
                                <option value="Active" {{ old("status") == "Active" ? "selected" : "" }}>Active</option>
                                <option value="InActive" {{ old("status") == "InActive" ? "selected" : "" }}>InActive</option>
                                <option value="Vacation" {{ old("status") == "Vacation" ? "selected" : "" }}>Vacation</option>
                            </select>

                            @error("status")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 mb-8">
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old("start_date") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </form>
            </div>
    </section>
</main>

@endsection
