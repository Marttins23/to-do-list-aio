<?php

namespace Tests\Unit\Services;

use App\Repositories\Task\TaskRepositoryInterface;
use App\Services\Task\TaskService;
use Tests\TestCase;
use Illuminate\Http\JsonResponse;
use App\Models\Task;
use Mockery;

class TaskServiceTest extends TestCase
{
    protected $taskRepository;
    protected $taskService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskRepository = Mockery::mock(TaskRepositoryInterface::class);
        $this->taskService = new TaskService($this->taskRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_all_returns_all_tasks()
    {
        $tasks = collect([new Task(['title' => 'Task 1']), new Task(['title' => 'Task 2'])]);

        $this->taskRepository
            ->shouldReceive('all')
            ->once()
            ->andReturn($tasks);

        $response = $this->taskService->all();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($tasks->toJson(), $response->getContent());
    }

    public function test_create_returns_created_task()
    {
        $taskData = ['title' => 'New Task'];
        $createdTask = new Task($taskData);

        $this->taskRepository
            ->shouldReceive('create')
            ->once()
            ->with($taskData)
            ->andReturn($createdTask);

        $response = $this->taskService->create($taskData);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->status());
        $this->assertEquals($createdTask->toJson(), $response->getContent());
    }

    public function test_update_returns_updated_task()
    {
        $taskData = ['title' => 'Updated Task'];
        $taskId = 1;
        $updatedTask = new Task($taskData);

        $this->taskRepository
            ->shouldReceive('update')
            ->once()
            ->with($taskData, $taskId)
            ->andReturn($updatedTask);

        $response = $this->taskService->update($taskData, $taskId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($updatedTask->toJson(), $response->getContent());
    }

    public function test_delete_returns_no_content()
    {
        $taskId = 1;

        $this->taskRepository
            ->shouldReceive('delete')
            ->once()
            ->with($taskId)
            ->andReturn(true);

        $response = $this->taskService->delete($taskId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->status());
    }
}
