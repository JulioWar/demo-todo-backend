<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "task" => "required",
            "date" => "required"
        ];
    }

    public function response(array $errors){
        return response()->json([
            'status_code' => 400,
            'message' => "No se pudo guardar la tarea. verifique la fecha y la tarea."
        ]);
    }


}
