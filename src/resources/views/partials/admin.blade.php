<div class="pt-20"></div>

<div
    class="fixed bottom-0 left-0 z-50 w-full bg-white p-4 text-center shadow-md"
>
    <a
        href="{{ request()->session()->get("is_admin") ? route("admin.index"): route("admin.auth.index") }}"
        class="{{ request()->session()->get("is_admin") ? "pb-1 text-indigo-600" : "" }} font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600"
    >
        ADMIN
    </a>
    @if(request()->session()->get("is_admin"))
        <span> /
            <a
                href="{{ route("logout") }}"
                class="font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600"
            >
                 logout
            </a>
        </span>
    @endif
</div>
