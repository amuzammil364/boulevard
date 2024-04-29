@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Expense Data</h1>

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <h3>Employee</h3>
                        <p class="mt-2 font-bold">{{ $expense->employee->name }}</p>
                    </div>
                    <div>
                        <h3>Payment Id</h3>
                        <p class="mt-2 font-bold">{{ $expense->payment_id }}</p>
                    </div>
                    <div>
                        <h3>Type</h3>
                        <p class="mt-2 font-bold">{{ $expense->type }}</p>
                    </div>
                    <div>
                        <h3>Amount</h3>
                        <p class="mt-2 font-bold">{{ $expense->amount }}</p>
                    </div>
                    <div>
                        <h3>Mode of Payment</h3>
                        <p class="mt-2 font-bold">{{ $expense->mode_of_payment }}</p>
                    </div>
                    <div>
                        <h3>Status</h3>
                        <p class="mt-2 font-bold">{{ $expense->status }}</p>
                    </div>
                    <div>
                        <h3>Due Date</h3>
                        <p class="mt-2 font-bold">{{ $expense->due_date->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <h3>Paid Date</h3>
                        <p class="mt-2 font-bold">{{ $expense->paid_date->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <h3>Created At</h3>
                        <p class="mt-2 font-bold">{{ $expense->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </section>

</main>


@endsection
