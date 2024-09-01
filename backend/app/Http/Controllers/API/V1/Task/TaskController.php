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
     * @return JsonResponse
     */
    public function index()
    {
        return $this->taskService->all();
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
        return $this->taskService->create($request->safe()->only('title'));
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
        return $this->taskService->update(
            $request->safe()->only('title', 'completed'),
            $id
        );
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
        return $this->taskService->delete($id);
    }
}
