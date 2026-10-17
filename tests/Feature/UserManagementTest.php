<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_user_management_and_sort(): void
    {
        $admin = User::factory()->create(['name' => 'Quản trị viên', 'role' => 'admin']);
        User::factory()->create(['name' => 'Trần Văn B', 'email' => 'b@example.com', 'role' => 'giang_vien']);
        User::factory()->create(['name' => 'Nguyễn Văn A', 'email' => 'a@example.com', 'role' => 'giang_vien']);

        $response = $this->actingAs($admin)->get(route('users.index', [
            'sort' => 'name',
            'direction' => 'asc',
        ]));

        $response->assertOk()
            ->assertSee('Nguyễn Văn A')
            ->assertSee('Họ tên');

        $this->assertSame(
            ['Nguyễn Văn A', 'Quản trị viên', 'Trần Văn B'],
            $response->viewData('users')->getCollection()->pluck('name')->all()
        );
    }

    public function test_lecturer_cannot_open_admin_user_management_or_menu(): void
    {
        $lecturer = User::factory()->create(['role' => 'giang_vien']);

        $this->actingAs($lecturer)->get(route('users.index'))->assertForbidden();
        $this->actingAs($lecturer)->get(route('menu.index'))->assertForbidden();
    }

    public function test_admin_user_creation_uses_form_request_validation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->from(route('users.create'))
            ->post(route('users.store'), [
                'name' => '',
                'email' => 'email-khong-hop-le',
                'role' => 'khong-hop-le',
                'password' => '123',
                'password_confirmation' => 'khac',
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['name', 'email', 'role', 'password']);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_lecturer_can_update_own_profile_but_cannot_update_other_users(): void
    {
        $lecturer = User::factory()->create(['role' => 'giang_vien']);
        $otherUser = User::factory()->create(['role' => 'giang_vien']);

        $this->actingAs($lecturer)
            ->put(route('profile.update'), [
                'name' => 'Giảng viên đã sửa',
                'email' => $lecturer->email,
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('users', ['id' => $lecturer->id, 'name' => 'Giảng viên đã sửa']);

        $this->actingAs($lecturer)->get(route('users.edit', $otherUser))->assertForbidden();
    }
}
