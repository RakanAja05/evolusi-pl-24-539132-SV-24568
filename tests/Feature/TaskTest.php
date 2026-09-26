<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_page_can_be_accessed(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertSee('Task List');
    }

    public function test_task_can_be_created(): void
    {
        $task = [
            'title' => 'Belajar Laravel',
            'description' => 'Membuat aplikasi CRUD Laravel.',
            'status' => 'pending',
        ];

        $response = $this->post(route('tasks.store'), $task);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', $task);
    }

    public function test_task_can_be_read(): void
    {
        $task = Task::create([
            'title' => 'Task untuk dibaca',
            'description' => 'Deskripsi task.',
            'status' => 'in_progress',
        ]);

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertSee($task->title);
        $response->assertSee($task->description);
    }

    public function test_task_can_be_updated(): void
    {
        $task = Task::create([
            'title' => 'Judul Lama',
            'description' => 'Deskripsi Lama',
            'status' => 'pending',
        ]);

        $updatedTask = [
            'title' => 'Judul Baru',
            'description' => 'Deskripsi Baru',
            'status' => 'completed',
        ];

        $response = $this->put(
            route('tasks.update', $task),
            $updatedTask
        );

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            ...$updatedTask,
        ]);
    }

    public function test_task_can_be_deleted(): void
    {
        $task = Task::create([
            'title' => 'Task yang akan dihapus',
            'description' => 'Deskripsi.',
            'status' => 'pending',
        ]);

        $response = $this->delete(
            route('tasks.destroy', $task)
        );

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
