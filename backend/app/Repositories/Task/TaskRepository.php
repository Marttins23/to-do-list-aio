<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

/**
 * Repository da Model 'Task'. Encapsula toda a logica de persistencia de
 * objetos dessa classe.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Repositories
 * @subpackage Task
 * @since Integrado desde 01/09/2024
 */
class TaskRepository implements TaskRepositoryInterface
{
    /**
     * Retorna todos os registros da tabela 'tasks'.
     *
     * @return Collection|Task[]
     */
    public function all()
    {
        return Task::all();
    }

    /**
     * Cria um objeto da Model 'Task' e persiste o registro na tabela 'tasks',
     * dadas as informacoes passadas como parametro.
     *
     * @param  array $data
     * @return Task
     */
    public function create(array $data)
    {
        return Task::create($data);
    }

    /**
     * Atualiza um registro da tabela 'tasks', tendo como base o identificador
     * do registro e as informacoes passadas como parametro.
     *
     * @param  array  $data
     * @param  string|int $id
     * @return Task
     */
    public function update(array $data, $id)
    {
        $task = $this->findTaskOrFail($id);
        $task->update($data);

        return $task;
    }

    /**
     * Deleta um registro da tabela 'tasks', tendo como parametro o identificador
     * do registro. Retorna 'true' em caso de succeso, ou 'false' em caso
     * de falha.
     *
     * @param  string|int $id
     * @return void
     */
    public function delete($id)
    {
        $task = $this->findTaskOrFail($id);
        $task->delete();
    }

    /**
     * Encontra e retorna um registro da tabela 'tasks', tendo como parametro
     * o identificador do registro.
     *
     * @param  string|int $id
     * @return Task
     */
    public function find($id)
    {
        return $this->findTaskOrFail($id);
    }

    /**
     * Encontra e retorna um registro da tabela 'tasks', tendo como parametro
     * o identificador do registro, ou lanca um  execao, em caso de falha.
     *
     * @param  string|int $id
     * @return Task
     */
    private function findTaskOrFail($id): Task
    {
        return Task::findOrFail($id);
    }

}
