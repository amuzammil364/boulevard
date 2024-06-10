@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Add Expense</h1>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <form action="{{ route("add_expense") }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-1">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type <span class="text-red-600">*</span></label>
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Type</option>
                                <option value="Salary" {{ (old("type") == "Salary" ? "selected" : "") }}>Salary</option>
                                <option value="Utility" {{ (old("type") == "Utility" ? "selected" : "") }}>Utility</option>
                                <option value="Repairs" {{ (old("type") == "Repairs" ? "selected" : "") }}>Repairs</option>
                                <option value="Welfare" {{ (old("type") == "Welfare" ? "selected" : "") }}>Welfare</option>
                                <option value="Misc" {{ (old("type") == "Misc" ? "selected" : "") }}>Misc</option>                                
                                <option value="KElectric" {{ (old("type") == "KElectric" ? "selected" : "") }}>KElectric</option>                                
                                <option value="KWSB" {{ (old("type") == "KWSB" ? "selected" : "") }}>KWSB</option>                                
                                <option value="SSGC" {{ (old("type") == "SSGC" ? "selected" : "") }}>SSGC</option>                                
                                <option value="Cleaning Supplies" {{ (old("type") == "Cleaning Supplies" ? "selected" : "") }}>Cleaning Supplies</option>                                
                                <option value="Office Supplies" {{ (old("type") == "Office Supplies" ? "selected" : "") }}>Office Supplies</option>                                
                                <option value="Electrical Supplies" {{ (old("type") == "Electrical Supplies" ? "selected" : "") }}>Electrical Supplies</option>                                
                                <option value="Plumbing Supplies" {{ (old("type") == "Plumbing Supplies" ? "selected" : "") }}>Plumbing Supplies</option>                                
                                <option value="Goods Material" {{ (old("type") == "Goods Material" ? "selected" : "") }}>Goods Material</option>                                
                                <option value="Waste Disposal" {{ (old("type") == "Waste Disposal" ? "selected" : "") }}>Waste Disposal</option>                                
                                <option value="Tv Cable" {{ (old("type") == "Tv Cable" ? "selected" : "") }}>Tv Cable</option>                                
                                <option value="Mosque / Prayer" {{ (old("type") == "Mosque / Prayer" ? "selected" : "") }}>Mosque / Prayer</option>                                
                                <option value="Water Tanker" {{ (old("type") == "Water Tanker" ? "selected" : "") }}>Water Tanker</option>                                
                                <option value="Mason / Brickwork" {{ (old("type") == "Mason / Brickwork" ? "selected" : "") }}>Mason / Brickwork</option>                                
                                <option value="Repairs-Electric" {{ (old("type") == "Repairs-Electric" ? "selected" : "") }}>Repairs-Electric</option>                                
                                <option value="Repairs-Plumbing" {{ (old("type") == "Repairs-Plumbing" ? "selected" : "") }}>Repairs-Plumbing</option>                                
                                <option value="Repairs-Mason" {{ (old("type") == "Repairs-Mason" ? "selected" : "") }}>Repairs-Mason</option>                                
                                <option value="Decorative Goods" {{ (old("type") == "Decorative Goods" ? "selected" : "") }}>Decorative Goods</option>                                
                                <option value="CCTV Maintenance" {{ (old("type") == "CCTV Maintenance" ? "selected" : "") }}>CCTV Maintenance</option>                                
                            </select>
                            @error("type")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="employee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee</label>
                            <select id="employee" name="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ (old("employee_id") == $employee->id ? "selected" : "") }}>{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @error("employee_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="col-span-2 sm:col-span-1">
                            <label for="resident" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resident</label>
                            <select id="resident" name="resident_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Resident</option>
                                @foreach ($residents as $resident)
                                <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                                @endforeach
                            </select>
                            @error("resident_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div> -->
                        

                        <div class="col-span-2 sm:col-span-1">
                            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference</label>
                            <input type="text" name="reference" id="reference" value="{{ old("reference") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Reference...">
                            @error("reference")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="receipt_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receipt Id</label>
                            <input type="number" name="receipt_id" id="receipt_id" value="{{ old("receipt_id") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Receipt Id...">
                            <div class="text-right mt-2">
                                <button type="button" id="clear_receipt_id_btn" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Clear</button>
                            </div>
                            @error("receipt_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status <span class="text-red-600">*</span></label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Status</option>
                                <option value="Paid" {{ (old("status") == "Paid" ? "selected" : "") }}>Paid</option>
                                <option value="Pending" {{ (old("status") == "Pending" ? "selected" : "") }}>Pending</option>
                            </select>
                            @error("status")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Id <span class="text-red-600">*</span></label>
                            <input type="text" name="payment_id" id="payment" value="{{ old("payment_id" , $payment_id) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Payment Id..." readonly>
                            @error("payment_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="mode_of_payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mode of Payment <span class="text-red-600">*</span></label>
                            <select id="mode_of_payment" name="mode_of_payment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Mode Payment</option>
                                <option value="Cash" {{ (old("mode_of_payment") == "Cash" ? "selected" : "selected") }}>Cash</option>
                                <option value="Card" {{ (old("mode_of_payment") == "Card" ? "selected" : "") }}>Card</option>
                                <option value="Bank Transfers" {{ (old("mode_of_payment") == "Bank Transfers" ? "selected" : "") }}>Bank Transfers</option>
                                <option value="Mobile Payment" {{ (old("mode_of_payment") == "Mobile Payment" ? "selected" : "") }}>Mobile Payment</option>
                                <option value="Cheque" {{ (old("mode_of_payment") == "Cheque" ? "selected" : "") }}>Cheque</option>
                            </select>
                            @error("mode_of_payment")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount <span class="text-red-600">*</span></label>
                            <input type="number" name="amount" id="amount" value="{{ old("amount") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Amount...">
                            @error("amount")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="expense_month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expense Month</label>
                            <input type="month" name="expense_month" id="expense_month" value="{{ old("expense_month",date('Y-m')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("expense_month")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due Date</label>
                            <input type="date" name="due_date" id="due_date" value="{{ date('Y-m-d') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("due_date")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 mb-8">
                            <label for="paid_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paid Date</label>
                            <input type="date" name="paid_date" id="paid_date" value="{{ date('Y-m-d') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("paid_date")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </form>
            </div>
    </section>
</main>

<script>

let clear_receipt_id_btn = document.querySelector("#clear_receipt_id_btn");

clear_receipt_id_btn.addEventListener("click" , () =>{
    document.querySelector("#receipt_id").value = "";
});

</script>

@endsection
