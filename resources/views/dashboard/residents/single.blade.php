@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Resident Data</h1>

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <h3>Flat Number</h3>
                        <p class="mt-2 font-bold">{{ $resident->flat->flat_number }}</p>
                    </div>
                    <div>
                        <h3>Full Name</h3>
                        <p class="mt-2 font-bold">{{ $resident->full_name }}</p>
                    </div>
                    <div>
                        <h3>Email</h3>
                        <p class="mt-2 font-bold">{{ $resident->email }}</p>
                    </div>
                    <div>
                        <h3>Type</h3>
                        <p class="mt-2 font-bold">{{ $resident->type }}</p>
                    </div>
                    <div>
                        <h3>Status</h3>
                        <p class="mt-2 font-bold">{{ $resident->status }}</p>
                    </div>
                    <div>
                        <h3>Mobile Number</h3>
                        <p class="mt-2 font-bold">{{ $resident->mobile }}</p>
                    </div>
                    <div>
                        <h3>Intercom</h3>
                        <p class="mt-2 font-bold">{{ $resident->intercom }}</p>
                    </div>
                    <div>
                        <h3>Cnic Number</h3>
                        <p class="mt-2 font-bold">{{ $resident->cnic }}</p>
                    </div>
                    <div>
                        <h3>In Date</h3>
                        <p class="mt-2 font-bold">{{ $resident->in_date->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <h3>Out Date</h3>
                        <p class="mt-2 font-bold">{{ $resident->out_date->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <h3>Created At</h3>
                        <p class="mt-2 font-bold">{{ $resident->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </section>

</main>


@endsection
