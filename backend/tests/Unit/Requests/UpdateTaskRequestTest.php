<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Task\UpdateTaskRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class UpdateTaskRequestTest extends TestCase
{
    /** @test */
    public function it_authorizes_the_request()
    {
        $request = new UpdateTaskRequest();
        $this->assertTrue($request->authorize());
    }

    /** @test */
    public function it_validates_title_when_completed_is_missing()
    {
        $request = new UpdateTaskRequest();

        $rules = $request->rules();

        $data = [
            'title' => 'My Task',
            'completed' => null
        ];

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function it_validates_completed_when_title_is_missing()
    {
        $request = new UpdateTaskRequest();

        $rules = $request->rules();

        $data = [
            'title' => null,
            'completed' => true
        ];

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function it_fails_validation_if_both_title_and_completed_are_missing()
    {
        $this->expectException(ValidationException::class);

        $request = new UpdateTaskRequest();

        $rules = $request->rules();

        $data = [
            'title' => null,
            'completed' => null
        ];

        $validator = Validator::make($data, $rules);

        $this->assertFalse($validator->passes());
        $validator->validate();
    }

    /** @test */
    public function it_fails_validation_if_title_is_too_short()
    {
        $this->expectException(ValidationException::class);

        $request = new UpdateTaskRequest();

        $rules = $request->rules();

        $data = [
            'title' => 'ab',
            'completed' => null
        ];

        $validator = Validator::make($data, $rules);

        $this->assertFalse($validator->passes());
        $validator->validate();
    }

    /** @test */
    public function it_fails_validation_if_title_is_not_string()
    {
        $this->expectException(ValidationException::class);

        $request = new UpdateTaskRequest();

        $rules = $request->rules();

        $data = [
            'title' => 123,
            'completed' => null
        ];

        $validator = Validator::make($data, $rules);

        $this->assertFalse($validator->passes());
        $validator->validate();
    }

    /** @test */
    public function it_allows_nullable_fields()
    {
        $request = new UpdateTaskRequest();

        $rules = $request->rules();

        $data = [
            'title' => null,
            'completed' => null
        ];

        $validator = Validator::make($data, $rules);
        $this->assertFalse($validator->passes());
    }
}
