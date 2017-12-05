<?php
//10-36
namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ArticuloFormRequest extends Request
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
            //4:35
            'idcategoria'=>'required',
            'codigo'=>'required|max:50',
            'nombre'=>'required|max:100',
            'stock'=>'required|numeric',
            'descripcion'=>'max:512',
            'imagen'=>'mimes:jpeg,bmp,png'
            
        ];
    }
}
