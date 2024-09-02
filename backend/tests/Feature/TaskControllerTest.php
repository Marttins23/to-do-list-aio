<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Services\Task\TaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected TaskService|MockInterface $taskService;

    public function setUp(): void
    {
        parent::setUp();

        $this->taskService = Mockery::mock(TaskService::class);
        $this->app->instance(TaskService::class, $this->taskService);
    }

    /** @test */
    public function it_can_list_all_tasks()
    {
        $tasks = Task::factory()->count(3)->make();

        $this->taskService
            ->shouldReceive('all')
            ->once()
            ->andReturn(response()->json($tasks, 200));

        $response = $this->getJson(route('tasks.index'));

        $response->assertStatus(200)->assertJson($tasks->toArray());
    }

    /** @test */
    public function it_can_create_a_new_task()
    {
        $taskData = ['title' => 'New Task'];

        $this->taskService
            ->shouldReceive('create')
            ->once()
            ->with($taskData)
            ->andReturn(response()->json($taskData, 201));

        $response = $this->postJson(route('tasks.store'), $taskData);

        $response->assertStatus(201)->assertJson($taskData);
    }

    /** @test */
    public function it_can_update_an_existing_task()
    {
        $task = Task::factory()->create(['title' => 'Task']);
        $updatedData = ['title' => 'Updated Task', 'completed' => true];

        $this->taskService
            ->shouldReceive('update')
            ->once()
            ->with($updatedData, $task->id)
            ->andReturn(response()->json($updatedData, 200));

        $response = $this->putJson(route('tasks.update', $task->id), $updatedData);

        $response->assertStatus(200)->assertJson($updatedData);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create(['title' => 'Task']);

        $this->taskService
            ->shouldReceive('delete')
            ->once()
            ->with($task->id)
            ->andReturn(response()->json(null, 204));

        $response = $this->deleteJson(route('tasks.destroy', $task->id));

        $response->assertStatus(204);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
