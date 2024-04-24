@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Employee Data</h1>

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <h3>Role</h3>
                        <p class="mt-2 font-bold">{{ $employee->role }}</p>
                    </div>
                    <div>
                        <h3>Name</h3>
                        <p class="mt-2 font-bold">{{ $employee->name }}</p>
                    </div>
                    <div>
                        <h3>Address</h3>
                        <p class="mt-2 font-bold">{{ $employee->address }}</p>
                    </div>
                    <div>
                        <h3>Cnic Number</h3>
                        <p class="mt-2 font-bold">{{ $employee->cnic }}</p>
                    </div>
                    <div>
                        <h3>Salary</h3>
                        <p class="mt-2 font-bold">{{ $employee->salary }}</p>
                    </div>
                    <div>
                        <h3>Comps</h3>
                        <p class="mt-2 font-bold">{{ $employee->comps }}</p>
                    </div>
                    <div>
                        <h3>Status</h3>
                        <p class="mt-2 font-bold">{{ $employee->status }}</p>
                    </div>
                    <div>
                        <h3>Start Date</h3>
                        <p class="mt-2 font-bold">{{ $employee->start_date->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <h3>Created At</h3>
                        <p class="mt-2 font-bold">{{ $employee->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </section>

</main>


@endsection
