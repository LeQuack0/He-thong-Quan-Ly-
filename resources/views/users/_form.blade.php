<div class="mb-3"><label class="form-label">Họ tên *</label><input class="form-control" name="name"
        value="{{ old('name', $user->name) }}" required></div>
<div class="mb-3"><label class="form-label">Email *</label><input class="form-control" type="email" name="email"
        value="{{ old('email', $user->email) }}" required></div>
<div class="mb-3"><label class="form-label">Vai trò *</label><select class="form-select" name="role" required>
        <option value="giang_vien" @selected(old('role', $user->role ?? 'giang_vien') === 'giang_vien')>Giảng viên
        </option>
        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
    </select></div>
<div class="mb-3"><label class="form-label">Mật khẩu
        {{ $user->exists ? '(để trống nếu không đổi)' : '*' }}</label><input class="form-control" type="password"
        name="password" {{ $user->exists ? '' : 'required' }} minlength="8"></div>
<div class="mb-3"><label class="form-label">Nhập lại mật khẩu</label><input class="form-control" type="password"
        name="password_confirmation" {{ $user->exists ? '' : 'required' }} minlength="8"></div>