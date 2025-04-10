<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền gửi yêu cầu này hay không.
     */
    public function authorize()
    {
        return true; // Bạn có thể thêm logic xác thực ở đây nếu cần
    }

    /**
     * Lấy các quy tắc xác thực cho yêu cầu.
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}
