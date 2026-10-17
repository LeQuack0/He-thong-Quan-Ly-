@push('styles')
    <style>
        .sidebar {
            background: var(--c-sidebar);
            color: #d9e4f0;
            padding: 20px 0
        }

        .sidebar h3 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #8fa9cc;
            padding: 0 20px;
            margin-bottom: 10px
        }

        .sidebar ul {
            list-style: none;
            margin-bottom: 24px;
            padding-left: 0
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #d9e4f0;
            text-decoration: none;
            border-left: 3px solid transparent
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, .08);
            border-left-color: var(--c-accent);
            color: #fff
        }
    </style>
@endpush
<aside class="sidebar">
    @foreach (collect($menuHienThi->get('sidebar', []))->filter(function ($menu) {
        return auth()->user()->isAdmin() || !in_array(trim((string) parse_url($menu->url, PHP_URL_PATH), '/'), ['users', 'menu'], true); })->groupBy('nhom') as $nhom => $menus)
        @if ($nhom)
        <h3>{{ $nhom }}</h3>@endif
        <ul>@foreach ($menus as $menu)
        <li><a href="{{ $menu->url }}" @class(['active' => $menu->dangChon()])>{{ $menu->ten }}</a></li>@endforeach
        </ul>
    @endforeach
    <h3>Tài khoản</h3>
    <ul>
        <li><a href="{{ route('profile.edit') }}" @class(['active' => request()->routeIs('profile.*')])>Tài khoản của
                tôi</a></li>
    </ul>
</aside>