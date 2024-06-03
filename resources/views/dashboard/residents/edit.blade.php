@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Edit Resident</h1>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <form action="{{ route("edit_resident") }}" method="POST" class="space-y-4">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id" value="{{ $resident->id }}">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name <span class="text-red-600">*</span></label>
                            <input type="text" name="full_name" id="full_name" value="{{ old("full_name" , $resident->full_name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Full Name...">
                            @error("full_name")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="flat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Flat <span class="text-red-600">*</span></label>
                            <select id="flat" name="flat_id" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Flat</option>
                                @foreach ($flats as $flat)
                                <option value="{{ $flat->id }}" {{ $flat->id == $resident->flat_id ? 'selected' : '' }}>{{ $flat->flat_number }} {{ " " }} ({{ $flat->phase_number }})</option>
                                @endforeach
                            </select>
                            @error("flat_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type <span class="text-red-600">*</span></label>
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" >Select Type</option>
                                <option value="Owner" {{ "Owner" == $resident->type ? 'selected' : '' }}>Owner</option>
                                <option value="Tenant" {{ "Tenant" == $resident->type ? 'selected' : '' }}>Tenant</option>
                                <option value="Former Owner" {{ "Former Owner" == $resident->type ? 'selected' : '' }}>Former Owner</option>
                                <option value="Former Tenant" {{ "Former Tenant" == $resident->type ? 'selected' : '' }}>Former Tenant</option>
                            </select>
                            @error("type")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status <span class="text-red-600">*</span></label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Status</option>
                                <option value="Active" {{ "Active" == $resident->status ? 'selected' : '' }}>Active</option>
                                <option value="Vacant (Paid)" {{ "Vacant (Paid)" == $resident->status ? 'selected' : '' }}>Vacant (Paid)</option>
                                <option value="Vacant (Arrears)" {{ "Vacant (Arrears)" == $resident->status ? 'selected' : '' }}>Vacant (Arrears)</option>
                                <option value="Active (Arrears)" {{ "Active (Arrears)" == $resident->status ? 'selected' : '' }}>Active (Arrears)</option>
                                <option value="Active (Rented)" {{ "Active (Rented)" == $resident->status ? 'selected' : '' }}>Active (Rented)</option>
                                <option value="TBC" {{ "TBC" == $resident->status ? 'selected' : '' }}>TBC</option>
                                <option value="Inactive" {{ "Inactive" == $resident->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error("status")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" name="email" id="email" value="{{ old("email" , $resident->email) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Email...">
                             @error("email")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number</label>
                            <input type="text" name="mobile" id="mobile" value="{{ old("mobile" , $resident->mobile) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mobile Number...">
                             @error("mobile")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="whatsapp_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Whatsapp Number</label>
                            <input type="text" name="whatsapp_number" id="whatsapp_number" pattern="^\+92\d{2,3}\d{7}$" value="{{ old("whatsapp_number", $resident->whatsapp_number) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="+923032157357">
                             @error("whatsapp_number")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="intercom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Intercom</label>
                            <input type="number" name="intercom" id="intercom" value="{{ old("intercom" , $resident->intercom) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Intercom...">
                             @error("intercom")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="cnic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cnic</label>
                            <input type="number" name="cnic" id="cnic" value="{{ old("cnic" , $resident->cnic) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cnic Number...">
                             @error("cnic")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="in_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">In Date</label>
                            <input type="date" name="in_date" id="in_date" value="{{ $resident->in_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("in_date")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 mb-8">
                            <label for="out_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Out Date</label>
                            <input type="date" name="out_date" id="out_date" value="{{ $resident->out_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("out_date")
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

<script>
        document.addEventListener('DOMContentLoaded',()=>{
            new TomSelect('#flat', {
                create: false,
                sortField: {
                    field: 'text',
                    direction: 'asc'
                }
            });
        })

</script>


@endsection
