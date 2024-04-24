@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">User Data</h1>

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <h3>Role</h3>
                        <p class="mt-2 font-bold">{{ $user->role->name }}</p>
                    </div>
                    <div>
                        <h3>First Name</h3>
                        <p class="mt-2 font-bold">{{ $user->first_name }}</p>
                    </div>
                    <div>
                        <h3>Last Name</h3>
                        <p class="mt-2 font-bold">{{ $user->last_name }}</p>
                    </div>
                    <div>
                        <h3>Email</h3>
                        <p class="mt-2 font-bold">{{ $user->email }}</p>
                    </div>
                    <div>
                        <h3>Phone Number</h3>
                        <p class="mt-2 font-bold">{{ $user->phone }}</p>
                    </div>
                    <div>
                        <h3>Created At</h3>
                        <p class="mt-2 font-bold">{{ $user->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </section>

</main>


@endsection
