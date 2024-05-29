

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="pt-14 fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidenav">
        <div class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <ul class="space-y-2">
                @if (Session::has("role_id") && Session::get("role_id") == 1 || Session::get("role_id") == 2)
                    <li>
                        <a href="{{ url("/dashboard") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <img class="h-auto" width="20" src="{{URL::asset('/icons/dashboard.png')}}" alt="image description">
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                @endif

                @if (Session::has("role_id") && Session::get("role_id") == 1)
                    <li>
                        <a href="{{ url("/dashboard/users") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <img class="h-auto" width="20" src="{{URL::asset('/icons/users.png')}}" alt="image description">
                            <span class="ml-3">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url("/dashboard/flats") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <img class="h-auto" width="20" src="{{URL::asset('/icons/flats.png')}}" alt="image description">
                            <span class="ml-3">Flats</span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ url("/dashboard/residents") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img class="h-auto" width="20" src="{{URL::asset('/icons/residents.png')}}" alt="image description">
                        <span class="ml-3">Residents</span>
                    </a>
                </li>

                @if (Session::has("role_id") && Session::get("role_id") == 1)
                    <li>
                        <a href="{{ url("/dashboard/payments") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <img class="h-auto" width="20" src="{{URL::asset('/icons/payments.png')}}" alt="image description">
                            <span class="ml-3">Collections</span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ url("/dashboard/employees") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img class="h-auto" width="20" src="{{URL::asset('/icons/employees.png')}}" alt="image description">
                        <span class="ml-3">Employees</span>
                    </a>
                </li>
                @if (Session::has("role_id") && Session::get("role_id") == 1)
                <li>
                    <a href="{{ url("/dashboard/expenses") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img class="h-auto" width="20" src="{{URL::asset('/icons/expenses.png')}}" alt="image description">
                        <span class="ml-3">Expenses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url("/dashboard/transactions") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img class="h-auto" width="20" src="{{URL::asset('/icons/transactions.png')}}" alt="image description">
                        <span class="ml-3">Transactions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url("/dashboard/summary") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img class="h-auto" width="20" src="{{URL::asset('/icons/transactions.png')}}" alt="image description">
                        <span class="ml-3">Summary</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
        <div class="hidden absolute bottom-0 left-0 justify-start p-4 space-x-4 w-full lg:flex bg-white dark:bg-gray-800 z-20 border-r border-gray-200 dark:border-gray-700">
            <a href='{{ url("/dashboard/settings") }}' data-tooltip-target="tooltip-settings" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <div id="tooltip-settings" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                Settings page
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
    </aside>
