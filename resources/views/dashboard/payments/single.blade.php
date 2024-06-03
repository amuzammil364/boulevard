@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Collection Data</h1>

    @if (Session::has("success"))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ Session::get("success") }}</span>
        </div>
    @endif

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <h3>Flat Number</h3>
                        <p class="mt-2 font-bold">{{ $payment->flat->flat_number }}</p>
                    </div>
                    <div>
                        <h3>Resident</h3>
                        <p class="mt-2 font-bold">{{ !empty($payment->flat->residents)?$payment->flat->residents[0]->full_name:"" }}</p>
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

            <br>
            <br>
            <div class="overflow-x-auto ">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <a href="{{ url("/dashboard/print-receipt?type=payment&pid=$payment->payment_id") }}"  target="_blank" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                <path d="M17 0h-5.768a1 1 0 1 0 0 2h3.354L8.4 8.182A1.003 1.003 0 1 0 9.818 9.6L16 3.414v3.354a1 1 0 0 0 2 0V1a1 1 0 0 0-1-1Z"/>
                                <path d="m14.258 7.985-3.025 3.025A3 3 0 1 1 6.99 6.768l3.026-3.026A3.01 3.01 0 0 1 8.411 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V9.589a3.011 3.011 0 0 1-1.742-1.604Z"/>
                            </svg>
                            <span class="ms-2">Download Receipt</span> 
                        </a>
                    </div>
                    <div>
                        <form action="{{ route("sendReceiptMail") }}" method="POST">
                            @csrf
                            <!-- <input type="hidden" name="send_receipt" value="send_receipt"> -->
                            <input type="hidden" name="pid" value="{{$payment->payment_id}}">
                            <button type="submit"  class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z"/>
                                    <path d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z"/>
                                </svg>
                                <span class="ms-2">Send Receipt</span> 
                            </button>
                        </form>
                    </div>                    
                </div>
            </div>


        </section>

</main>


@endsection
