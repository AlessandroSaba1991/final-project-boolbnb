<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
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
            "title"=>['required'],
            "rooms"=>['required', 'numeric', 'min:1', 'max:100'],
            "beds"=>['required', 'numeric', 'min:1', 'max:100'],
            "bathrooms"=>['required', 'numeric', 'min:1', 'max:100'],
            "square_meters"=>['required', 'numeric', 'min:1', 'max:30000'],
            "address"=>['required'],
            "latitude"=>['required'],
            "longitude"=>['required'],
            "cover_image"=>['nullable'],
            "description"=>['nullable'],
            "visible"=>['required'],
            "services" => ['exists:services,id']
            
        ];
    }
}
