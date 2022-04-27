<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class creaOrdenRequest extends FormRequest
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
            'nombre'   => 'required|string|max:80',
            'correo'   => 'required|email:rfc,strict|max:80',
            'telefono' => 'required|numeric|max:9999999999',
        ];
    }

    /**
     *  Method in charge of returning an array and customizing the validation errors
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'El :attribute es obligatorio.',
            'email'    => 'El :attribute no es un correo valido',
            'string'   => 'El :attribute es una cadena de caracteres',
            'numeric'  => 'El :attribute debe ser numérico',
            'max'      => 'La cantidad de caracteres del :attribute no puede ser superior a :max',
        ];
    }

    /**
     *  Overwrite or customize the name of the validated attributes when displaying the error message
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'nombre'   => 'nombre del comprador',
            'correo'   => 'correo del comprador',
            'telefono' => 'teléfono del comprador',
        ];
    }
}
