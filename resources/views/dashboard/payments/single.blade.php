@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Collection Data</h1>

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <h3>Flat Number</h3>
                        <p class="mt-2 font-bold">{{ $payment->flat->flat_number }}</p>
                    </div>
                    <div>
                        <h3>Payment Id</h3>
                        <p class="mt-2 font-bold">{{ $payment->payment_id }}</p>
                    </div>
                    <div>
                        <h3>Type</h3>
                        <p class="mt-2 font-bold">{{ $payment->type }}</p>
                    </div>
                    <div>
                        <h3>Amount</h3>
                        <p class="mt-2 font-bold">{{ $payment->amount }}</p>
                    </div>
                    <div>
                        <h3>Mode of Payment</h3>
                        <p class="mt-2 font-bold">{{ $payment->mode_of_payment }}</p>
                    </div>
                    <div>
                        <h3>Status</h3>
                        <p class="mt-2 font-bold">{{ $payment->status }}</p>
                    </div>
                    <div>
                        <h3>Mayment Month</h3>
                        <p class="mt-2 font-bold">{{ date("F Y", strtotime($payment->payment_month)) }}</p>
                    </div>

                    <div>
                        <h3>Due Date</h3>
                        <p class="mt-2 font-bold">{{ $payment->due_date->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <h3>Paid Date</h3>
                        <p class="mt-2 font-bold">{{ $payment->paid_date->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <h3>Created At</h3>
                        <p class="mt-2 font-bold">{{ $payment->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </section>

</main>


@endsection
