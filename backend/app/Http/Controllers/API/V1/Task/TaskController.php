<?php

namespace App\Http\Controllers\API\V1\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use App\Services\Task\TaskService;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;

/**
 * Controller para manipulacao dos dados da Model 'Task'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Http\Controllers
 * @subpackage API\V1\Task
 * @since Integrado desde 01/09/2024
 */
class TaskController extends Controller
{
    /**
     * Objeto da classe 'taskService', responsavel pela logica de persistencia
     * da Model 'Task'.
     *
     * @var TaskService
     */
    protected $taskService;

    public function __construct()
    {
        $this->taskService = new TaskService();
    }

    /**
     * Retorna todos os registros da tabela 'tasks'
     *
     * @return Collection|Task[]
     */
    public function index()
    {
        $tasks = $this->taskService->all();

        return response()->json($tasks, 200);
    }

    /**
     * Cria um objeto da Model 'Task' e persiste o registro na tabela 'tasks',
     * dadas as informacoes passadas no request.
     *
     * @param  StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->create($request->safe()->only('title'));

        return response()->json($task, 201);
    }

    /**
     * Atualiza um registro da tabela 'tasks', tendo como base o identificador
     * do registro e as informacoes passadas no request.
     *
     * @param  UpdateTaskRequest $request
     * @param  string  $id Identificador do registro
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = $this->taskService->update(
            $request->safe()->only('title', 'completed'),
            $id
        );

        return response()->json($task, 200);
    }

    /**
     * Apaga um determinado registro da tabela 'tasks', tendo como base o
     * identificador do registro passado como parametro.
     *
     * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
     * @param  string $id
     * @return JsonResponse
     */
    public function destroy(string $id)
    {
        $this->taskService->delete($id);

        return response()->json([], 204);
    }
}
