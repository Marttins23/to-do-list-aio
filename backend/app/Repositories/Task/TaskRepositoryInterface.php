<?php

namespace App\Repositories\Task;

/**
 * Interface que define os metodos obrigatorios do 'TaskRepository'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Repositories
 * @subpackage Task
 * @since Integrado desde 01/09/2024
 */
interface TaskRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);
}
