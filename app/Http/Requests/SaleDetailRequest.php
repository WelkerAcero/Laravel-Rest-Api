<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class SaleDetailRequest extends FormRequest
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

    public function getSubTotal()
    {
        $quantity = $this->input('quantity');
        $product_id = $this->input('product_id');

        $product = DB::table('products')->select('price')->where('id', $product_id)->first();
        if ($product) return $product->price * $quantity;
        return 0;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'sub_total' => $this->getSubTotal()
        ]);
    }

    public function rules()
    {
        return [
            'sale_code_id' => 'required',
            'quantity' => 'required',
            'product_id' => 'required',
            'sub_total' => 'required'
        ];
    }
}
