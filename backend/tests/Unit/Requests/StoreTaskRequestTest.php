<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Task\StoreTaskRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreTaskRequestTest extends TestCase
{
    /** @test */
    public function it_validates_the_title_is_required()
    {
        $request = new StoreTaskRequest();

        $validator = Validator::make(['title' => ''], $request->rules(), $request->messages());

        $this->assertTrue($validator->fails());
        $this->assertEquals('O título da tarefa é obrigatório', $validator->errors()->first('title'));
    }

    /** @test */
    public function it_validates_the_title_must_be_a_string()
    {
        $request = new StoreTaskRequest();

        $validator = Validator::make(['title' => 123], $request->rules(), $request->messages());

        $this->assertTrue($validator->fails());
        $this->assertEquals('O título da tarefa deve ser do tipo texto', $validator->errors()->first('title'));
    }

    /** @test */
    public function it_validates_the_title_must_have_a_minimum_length()
    {
        $request = new StoreTaskRequest();

        $validator = Validator::make(['title' => 'ab'], $request->rules(), $request->messages());

        $this->assertTrue($validator->fails());
        $this->assertEquals('O título da tarefa deve conter pelo menos 3 caracteres.', $validator->errors()->first('title'));
    }

    /** @test */
    public function it_passes_when_title_is_valid()
    {
        $request = new StoreTaskRequest();

        $validator = Validator::make(['title' => 'Valid Title'], $request->rules(), $request->messages());
        $this->assertFalse($validator->fails());
    }
}
