<header class="header">
    <div class="logo">
        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none fw-bold fs-5">
            HUCE<span style="color: var(--c-accent, #f5a623);">.Web</span>
        </a>
    </div>
    
    <div class="d-flex align-items-center gap-3">
        <span class="text-white">
            {{ auth()->user()->name ?? '' }} 
            <small class="text-warning">({{ auth()->user()->role ?? '' }})</small>
        </span>
        
        <!-- Nút Đăng xuất màu đỏ, hiển thị trực tiếp -->
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-light text-danger fw-bold shadow-sm px-3 py-1">
                Đăng xuất
            </button>
        </form>
    </div>
</header>