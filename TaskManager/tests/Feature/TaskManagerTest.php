<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_create_update_and_delete_a_task(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('tasks.store'), ['title' => 'Buy groceries'])
            ->assertRedirect(route('dashboard'));

        $task = Task::where('title', 'Buy groceries')->firstOrFail();
        $this->assertSame($user->id, $task->user_id);

        $this->actingAs($user)
            ->put(route('tasks.update', $task), ['title' => 'Buy fruit'])
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Buy fruit']);

        $this->actingAs($user)
            ->delete(route('tasks.destroy', $task))
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_a_user_cannot_access_another_users_task(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::create(['user_id' => $owner->id, 'title' => 'Private task']);

        $this->actingAs($otherUser)
            ->get(route('tasks.edit', $task))
            ->assertNotFound();

        $this->actingAs($otherUser)
            ->put(route('tasks.update', $task), ['title' => 'Changed'])
            ->assertNotFound();

        $this->actingAs($otherUser)
            ->delete(route('tasks.destroy', $task))
            ->assertNotFound();

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Private task']);
    }
}
