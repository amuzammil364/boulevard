@extends("dashboard.layout.layout")

@section("dashboard/dashboard")

<main class="p-4 sm:ml-64 md:ml-64 h-auto pt-20">
    <h1 class="font-bold text-3xl mb-8">Edit Expense</h1>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-md">
            <div class="overflow-x-auto">
                <form action="{{ route("edit_expense") }}" method="POST" class="space-y-4">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id" value="{{ $expense->id }}" />
                    <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-1">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type <span class="text-red-600">*</span></label>
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Type</option>
                                <option value="Salary" {{ $expense->type == "Salary" ? "selected" : "" }}>Salary</option>
                                <option value="Utility" {{ $expense->type == "Utility" ? "selected" : "" }}>Utility</option>
                                <option value="Repairs" {{ $expense->type == "Repairs" ? "selected" : "" }}>Repairs</option>
                                <option value="Welfare" {{ $expense->type == "Welfare" ? "selected" : "" }}>Welfare</option>
                                <option value="Misc" {{ $expense->type == "Misc" ? "selected" : "" }}>Misc</option>   
                                <option value="KElectric" {{ ($expense->type == "KElectric" ? "selected" : "") }}>KElectric</option>                                
                                <option value="KWSB" {{ ($expense->type == "KWSB" ? "selected" : "") }}>KWSB</option>                                
                                <option value="SSGC" {{ ($expense->type == "SSGC" ? "selected" : "") }}>SSGC</option>                                
                                <option value="Cleaning Supplies" {{ ($expense->type == "Cleaning Supplies" ? "selected" : "") }}>Cleaning Supplies</option>                                
                                <option value="Office Supplies" {{ ($expense->type == "Office Supplies" ? "selected" : "") }}>Office Supplies</option>                                
                                <option value="Electrical Supplies" {{ ($expense->type == "Electrical Supplies" ? "selected" : "") }}>Electrical Supplies</option>                                
                                <option value="Plumbing Supplies" {{ ($expense->type == "Plumbing Supplies" ? "selected" : "") }}>Plumbing Supplies</option>                                
                                <option value="Goods Material" {{ ($expense->type == "Goods Material" ? "selected" : "") }}>Goods Material</option>
                                <option value="Waste Disposal" {{ ($expense->type == "Waste Disposal" ? "selected" : "") }}>Waste Disposal</option>                                
                                <option value="Tv Cable" {{ ($expense->type == "Tv Cable" ? "selected" : "") }}>Tv Cable</option>                                
                                <option value="Mosque / Prayer" {{ ($expense->type == "Mosque / Prayer" ? "selected" : "") }}>Mosque / Prayer</option>                                
                                <option value="Water Tanker" {{ ($expense->type == "Water Tanker" ? "selected" : "") }}>Water Tanker</option>                                
                                <option value="Mason / Brickwork" {{ ($expense->type == "Mason / Brickwork" ? "selected" : "") }}>Mason / Brickwork</option>                                
                                <option value="Repairs-Electric" {{ ($expense->type == "Repairs-Electric" ? "selected" : "") }}>Repairs-Electric</option>                                
                                <option value="Repairs-Plumbing" {{ ($expense->type == "Repairs-Plumbing" ? "selected" : "") }}>Repairs-Plumbing</option>                                
                                <option value="Repairs-Mason" {{ ($expense->type == "Repairs-Mason" ? "selected" : "") }}>Repairs-Mason</option>                          
                                <option value="Decorative Goods" {{ ($expense->type == "Decorative Goods" ? "selected" : "") }}>Decorative Goods</option>                          
                                <option value="CCTV Maintenance" {{ ($expense->type == "CCTV Maintenance" ? "selected" : "") }}>CCTV Maintenance</option>                          
                                <option value="Eid ul Adha Provision" {{ ($expense->type == "Eid ul Adha Provision" ? "selected" : "") }}>Eid ul Adha Provision</option>                                
                                <option value="Eid ul Fitr Provision" {{ ($expense->type == "Eid ul Fitr Provision" ? "selected" : "") }}>Eid ul Fitr Provision</option>                                
                            </select>
                            @error("status")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="employee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee</label>
                            <select id="employee_id" name="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $employee->id == $expense->employee_id ? "selected" : "" }}>{{ $employee->name }}</option>
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
                                <option value="{{ $resident->id }}" {{ $resident->id == $expense->resident_id ? "selected" : "" }}>{{ $resident->name }}</option>
                                @endforeach
                            </select>
                            @error("resident_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div> -->


                        <div class="col-span-2 sm:col-span-1">
                            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reference</label>
                            <input type="text" name="reference" id="reference" value="{{ old("reference", $expense->reference) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Reference...">
                            @error("reference")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="receipt_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receipt Id</label>
                            <input type="number" name="receipt_id" id="receipt_id" value="{{ old("receipt_id", $expense->receipt_id) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Receipt Id...">
                            @error("receipt_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status <span class="text-red-600">*</span></label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Status</option>
                                <option value="Paid" {{ "Paid" == $expense->status ? "selected" : "" }} >Paid</option>
                                <option value="Pending" {{ "Pending" == $expense->status ? "selected" : "" }} >Pending</option>
                            </select>
                            @error("status")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Id <span class="text-red-600">*</span></label>
                            <input type="text" name="payment_id" id="payment" value="{{ old("payment_id" , $expense->payment_id) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Payment Id..." readonly />
                            @error("payment_id")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="mode_of_payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mode of Payment <span class="text-red-600">*</span></label>
                            <select id="mode_of_payment" name="mode_of_payment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select Mode Payment</option>
                                <option value="Cash" {{ "Cash" == $expense->mode_of_payment ? "selected" : "" }} >Cash</option>
                                <option value="Card" {{ "Card" == $expense->mode_of_payment ? "selected" : "" }} >Card</option>
                                <option value="Bank Transfers" {{ "Bank Transfers" == $expense->mode_of_payment ? "selected" : "" }} >Bank Transfers</option>
                                <option value="Mobile Payment" {{ "Mobile Payment" == $expense->mode_of_payment ? "selected" : "" }} >Mobile Payment</option>
                                <option value="Cheque" {{ "Cheque" == $expense->mode_of_payment ? "selected" : "" }} >Cheque</option>
                            </select>
                            @error("mode_of_payment")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount <span class="text-red-600">*</span></label>
                            <input type="number" name="amount" id="amount" value="{{ old("amount" , $expense->amount) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Amount...">
                            @error("amount")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="expense_month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expense Month</label>
                            <input type="month" name="expense_month" id="expense_month" value="{{ old("expense_month",date('Y-m', strtotime($expense->expense_month))) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("expense_month")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due Date</label>
                            <input type="date" name="due_date" id="due_date" value="{{ old("due_date" , $expense->due_date) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                             @error("due_date")
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 mb-8">
                            <label for="paid_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paid Date</label>
                            <input type="date" name="paid_date" id="paid_date" value="{{ old("paid_date" , $expense->paid_date) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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

@endsection
