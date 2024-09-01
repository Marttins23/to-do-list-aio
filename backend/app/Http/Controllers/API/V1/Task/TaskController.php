<?php

namespace App\Http\Controllers\API\V1\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Repositories\Task\TaskRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

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
     * Objeto da classe 'TaskRepository', responsavel pela logica de persistencia
     * da Model 'Task'.
     *
     * @var TaskRepository
     */
    protected $taskRepository;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    /**
     * Retorna todos os registros da tabela 'tasks'
     *
     * @return Collection|Task[]
     */
    public function index()
    {
        return $this->taskRepository->all();
    }

    /**
     * Cria um objeto da Model 'Task' e persiste o registro na tabela 'tasks',
     * dadas as informacoes passadas no request.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $task = $this->taskRepository->create($request->only('title'));

        return response()->json($task, 201);
    }

    /**
     * Atualiza um registro da tabela 'tasks', tendo como base o identificador
     * do registro e as informacoes passadas no request.
     *
     * @param  Request $request
     * @param  string  $id Identificador do registro
     * @return JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $task = $this->taskRepository->update(
            $request->only('title', 'completed'),
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
        $this->taskRepository->delete($id);

        return response()->json(null, 204);
    }
}
