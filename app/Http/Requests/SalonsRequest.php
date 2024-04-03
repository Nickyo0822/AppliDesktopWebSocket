<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalonsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'salonname' => 'required|string|max:255',
            'salonimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
?>
