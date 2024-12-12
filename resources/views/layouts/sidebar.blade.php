<aside id="sidebar" class="w-full lg:w-64 bg-gray-800 text-white hidden lg:flex lg:flex-col lg:justify-between">
    <div>
        <div class="p-4 text-center items-center">
            <h1 class="text-2xl font-bold mb-4 hidden lg:block">SIPERPUS</h1>
        </div>
        <nav class="px-2">
            <ul>
                <ul>
                    <li class="mb-2">
                        <a href="/" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/books" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                            <i class="fas fa-book mr-3"></i>
                            Books
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/categories" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                            <i class="fa-solid fa-list mr-3"></i>
                            Book Categories
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/bookshelves" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                            <i class="fa-solid fa-chart-column mr-3"></i>
                            Bookshelves
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/members" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                            <i class="fa-solid fa-users mr-3"></i>
                            Members
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/loans" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                            <i class="fa-solid fa-cart-flatbed mr-3"></i>
                            Loans
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/loans/returns" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                            <i class="fa-solid fa-cart-flatbed flip-horizontal mr-3"></i>
                            Returns
                        </a>
                    </li>
                    @if(auth()->user()->hasRole('admin'))
                        <li class="mb-2">
                            <a href="/users" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                                <i class="fa-solid fa-user mr-3"></i>
                                Users
                            </a>
                        </li>
                    @endif
                </ul>
            </ul>
        </nav>
    </div>
    <div class="p-4">
        <div class="flex items-center mb-4">
            <a href="/profile" class="py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                {{ Auth::user()->name }}
            </a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-2 px-4 rounded hover:bg-gray-700 flex items-center">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>
                Logout
            </button>
        </form>
    </div>
</aside>
