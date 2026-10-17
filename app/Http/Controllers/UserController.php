<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private const SORTABLE = ['id', 'name', 'email', 'role', 'created_at'];
    private const PER_PAGE_OPTIONS = [10, 20, 50];

    public function index(Request $request)
    {
        $filters = Validator::make($request->query(), [
            'keyword' => ['nullable', 'string', 'max:100'],
            'role' => ['nullable', 'in:admin,giang_vien'],
            'sort' => ['nullable', 'in:' . implode(',', self::SORTABLE)],
            'direction' => ['nullable', 'in:asc,desc'],
            'perPage' => ['nullable', 'in:' . implode(',', self::PER_PAGE_OPTIONS)],
        ])->valid();

        $sort = $filters['sort'] ?? 'name';
        $direction = $filters['direction'] ?? 'asc';
        $perPage = (int) ($filters['perPage'] ?? 10);

        $users = User::query()
            ->when(isset($filters['keyword']), function ($query) use ($filters) {
                $keyword = '%' . $filters['keyword'] . '%';
                $query->where(function ($sub) use ($keyword) {
                    $sub->where('name', 'like', $keyword)
                        ->orWhere('email', 'like', $keyword);
                });
            })
            ->when(isset($filters['role']), fn ($query) => $query->where('role', $filters['role']))
            ->orderBy($sort, $direction)
            ->orderBy('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('users.index', [
            'users' => $users,
            'filters' => $filters,
            'sort' => $sort,
            'direction' => $direction,
            'perPage' => $perPage,
            'sortable' => self::SORTABLE,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
        ]);
    }

    public function create()
    {
        return view('users.create', ['user' => new User()]);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Đã tạo tài khoản.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if ($user->is($request->user()) && ($data['role'] ?? $user->role) !== 'admin') {
            return back()
                ->withErrors(['role' => 'Không thể tự hạ quyền Admin của chính mình.'])
                ->withInput();
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Đã cập nhật tài khoản.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->is($request->user())) {
            return back()->withErrors(['user' => 'Không thể tự xóa tài khoản đang đăng nhập.']);
        }

        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return back()->withErrors(['user' => 'Không thể xóa tài khoản Admin cuối cùng.']);
        }

        $user->delete();

        return back()->with('success', 'Đã xóa tài khoản.');
    }

    public function profile(Request $request)
    {
        return view('users.profile', ['user' => $request->user()]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return back()->with('success', 'Đã cập nhật tài khoản của bạn.');
    }
}
