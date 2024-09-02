<?php

namespace App\Services\Task;

use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Mockery\MockInterface;

/**
 * Servico responsavel acionar o repositorio das 'tasks' e validar o retorno
 * das operacoes.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Services
 * @subpackage Task
 * @since Integrado desde 01/09/2024
 */
class TaskService
{
    protected TaskRepositoryInterface|MockInterface $taskRepository;

    public function __construct(TaskRepositoryInterface|MockInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Retorna todos os registros da tabela 'tasks' em formato JSON.
     *
     * @return JsonResponse
     */
    public function all()
    {
        try {

            return response()->json($this->taskRepository->all(), 200);

        } catch(\Exception $e) {

            return $this->getErrorJsonResponse($e);

        }
    }

    /**
     * Cria um objeto da Model 'Task' e persiste o registro na tabela 'tasks',
     * dadas as informacoes passadas.
     *
     * @param  array $data
     * @return Collection|Task[]|JsonResponse
     */
    public function create(array $data)
    {
        try {

            return response()->json($this->taskRepository->create($data), 201);

        } catch(\Exception $e) {

            return $this->getErrorJsonResponse($e);

        }
    }

    /**
     * Atualiza um registro da tabela 'tasks', tendo como base o identificador
     * do registro e as informacoes passadas.
     *
     * @param  array  $data
     * @param  string|int $id
     * @return Collection|Task[]|JsonResponse
     */
    public function update(array $data, $id)
    {
        try {

            return response()->json($this->taskRepository->update($data, $id), 200);

        } catch(\Exception $e) {

            return $this->getErrorJsonResponse($e);

        }
    }

    /**
     * Apaga um determinado registro da tabela 'tasks', tendo como base o
     * identificador do registro passado como parametro.
     *
     * @param  string $id
     * @return bool|null|JsonResponse
     */
    public function delete($id)
    {
        try {

            return response()->json($this->taskRepository->delete($id,), 204);

        } catch(\Exception $e) {

            return $this->getErrorJsonResponse($e);

        }
    }

    /**
     * Retorna a resposta de acordo com o tipo de Exception recebida como parametro.
     *
     * @param  \Exception $exception
     * @return JsonResponse
     */
    private function getErrorJsonResponse($exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(
                ['message' => 'Não foi encontrado nenhum registro com o ID passado como parâmetro.'],
                404
            );
        }

        return response()->json(
            ['message' => 'Ocorreu um erro inesperado ao processar a sua requisição'],
            500
        );
    }
}
