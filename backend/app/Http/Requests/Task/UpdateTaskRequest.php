<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para validacao da acao 'update' de uma 'task'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Http
 * @subpackage Requests\Task
 * @since Integrado desde 01/09/2024
 */
class UpdateTaskRequest extends FormRequest
{
    /**
     * Determina se a validacao pode ser executada.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

     /**
     * Array contendo as regras da validacao.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|min:3|required_without_all:completed',
            'completed' => 'nullable|boolean|required_without_all:title',
        ];
    }

    /**
     * Array contendo as mensagens que serao retornadas caso a validacao falhe.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.string' => 'O título da tarefa deve ser do tipo texto',
            'title.min' => 'O título da tarefa deve conter pelo menos 3 caracteres.',
            'title.required_without_all' => 'O título da tarefa é obrigatório',
            'completed.required_without_all' => 'O status da tarefa é obrigatório'
        ];
    }
}
