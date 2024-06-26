@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Edit Collection</h1>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <form action="{{ route("edit_payment") }}" method="POST" class="space-y-4">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id" value="{{ $payment->id }}" />
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="flat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Flat <span class="text-red-600">*</span></label>
                            <select id="flat" name="flat_id" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Flat</option>
                                @foreach ($flats as $flat)
                                <option value="{{ $flat->id }}" {{ $flat->id == $payment->flat_id ? "selected" : "" }}>{{ $flat->flat_number }} ({{ $flat->phase_number }})</option>
                                @endforeach
                            </select>
                            @error("flat_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type <span class="text-red-600">*</span></label>
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Type</option>
                                <option value="Maintenance" {{ $payment->type == "Maintenance" ? "selected" : "" }}>Maintenance</option>
                                <option value="Welfare" {{ $payment->type == "Welfare" ? "selected" : "" }}>Welfare</option>
                                <option value="Misc" {{ $payment->type == "Misc" ? "selected" : "" }}>Misc</option>
                                <option value="Eid-ul-Adha Provision" {{ $payment->type == "Eid-ul-Adha Provision" ? "selected" : "" }}>Eid-ul-Adha Provision</option>
                                <option value="Paint Renovation" {{ $payment->type == "Paint Renovation" ? "selected" : "" }}>Paint Renovation</option>
                            </select>
                            @error("status")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status <span class="text-red-600">*</span></label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Status</option>
                                <option value="Paid" {{ "Paid" == $payment->status ? "selected" : "" }} >Paid</option>
                                <option value="Pending" {{ "Pending" == $payment->status ? "selected" : "" }} >Pending</option>
                            </select>
                            @error("status")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference</label>
                            <input type="text" name="reference" id="reference" value="{{ old("reference", $payment->reference) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Reference...">
                            @error("reference")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="receipt_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receipt Id</label>
                            <input type="number" name="receipt_id" id="receipt_id" value="{{ old("receipt_id", $payment->receipt_id) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Receipt Id...">
                            @error("receipt_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        
                        <div class="col-span-2 sm:col-span-1">
                            <label for="payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Id <span class="text-red-600">*</span></label>
                            <input type="text" name="payment_id" id="payment" value="{{ old("payment_id" , $payment->payment_id) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Payment Id..." readonly >
                            @error("payment_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="mode_of_payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mode of Payment <span class="text-red-600">*</span></label>
                            <select id="mode_of_payment" name="mode_of_payment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Mode Payment</option>
                                <option value="Cash" {{ "Cash" == $payment->mode_of_payment ? "selected" : "" }} >Cash</option>
                                <option value="Card" {{ "Card" == $payment->mode_of_payment ? "selected" : "" }} >Card</option>
                                <option value="Bank Transfers" {{ "Bank Transfers" == $payment->mode_of_payment ? "selected" : "" }} >Bank Transfers</option>
                                <option value="Mobile Payment" {{ "Mobile Payment" == $payment->mode_of_payment ? "selected" : "" }} >Mobile Payment</option>
                                <option value="Cheque" {{ "Cheque" == $payment->mode_of_payment ? "selected" : "" }} >Cheque</option>
                            </select>
                            @error("mode_of_payment")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount <span class="text-red-600">*</span></label>
                            <input type="number" name="amount" id="amount" value="{{ old("amount" , $payment->amount) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Amount...">
                            @error("amount")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="payment_month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Month</label>
                            <input type="month" name="payment_month" id="payment_month" value="{{ old("payment_month",date('Y-m', strtotime($payment->payment_month)) ) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("payment_month")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due Date</label>
                            <input type="date" name="due_date" id="due_date" value="{{ old("due_date" , $payment->due_date) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("due_date")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 mb-8">
                            <label for="paid_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paid Date</label>
                            <input type="date" name="paid_date" id="paid_date" value="{{ old("paid_date" , $payment->paid_date) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("paid_date")
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
