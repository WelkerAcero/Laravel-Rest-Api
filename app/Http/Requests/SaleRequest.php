<?php

namespace App\Http\Requests;

use App\Models\Sale;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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

    public function setBilldCode()
    {
        $CHARACTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $CODE_LENGTH = 12;

        $code = '';
        $repeat = false;
        
        do {
            $code = '';
            for ($i = 0; $i < $CODE_LENGTH; $i++) {
                $randomIndex = floor(rand() / getrandmax() * strlen($CHARACTERS));
                $code .= substr($CHARACTERS, $randomIndex, 1);
            }

            $verifyExistence = Sale::where('sale_code', $code)->get();
            if (count($verifyExistence) > 0) $repeat = true;

        } while ($repeat);

        return $code;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'sale_code' => $this->setBilldCode(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('PUT')) {
            return [
                'sale_code' => 'required', Rule::unique('sales')->ignore($this->sale->sale_code),
                'user_id' => 'required',
                'customer_id' => 'required'
            ];
        }
        if ($this->isMethod('POST')) {
            return [
                'sale_code' => 'required',
                'user_id' => 'required',
                'customer_id' => 'required'
            ];
        }
    }
}
