<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
    <a class="navbar-brand" href="{{ auth()->user()->role === 'admin' ? route('admin.index') : route('courier.index') }}">
        🚚 Доставка
    </a>

    <div class="ms-auto d-flex align-items-center gap-3">
        <span class="text-muted">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Выйти</button>
        </form>
    </div>
</nav>