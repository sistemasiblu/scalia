<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CambioPasswordRequest extends Request
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
<<<<<<< HEAD
        return 
        [
            "password" => "required|min:4|max:20|confirmed",
            "password_confirmation" => "required|min:4|max:20",
=======
        return [

        "password" => "required|min:4|max:20|confirmed",
        "password_confirmation" => "required|min:4|max:20",
            
>>>>>>> 281ff4e585714cf601c5dc16fad246c2ed8b2580
        ];
    }
}
