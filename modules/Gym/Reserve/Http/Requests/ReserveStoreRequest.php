<?php

namespace Gym\Reserve\Http\Requests;

use App\Rules\ValidJalaliDate;
use Gym\Service\Rules\ValidUser;
use Illuminate\Foundation\Http\FormRequest;

class ReserveStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        $rules = [
            "user_id" => ['required', 'exists:users,id', new ValidUser()],
            "service_id" => 'nullable|exists:services,id',
            "sens_id" => 'nullable|exists:senses,id',
            "date"=>'nullable',
            "start_at" => ["nullable",new ValidJalaliDate()],
            "expire_at" => ["nullable",new ValidJalaliDate()],
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            "user_id" => "کاربر",
            "service_id" => "شناسه خدمت",
            "sens_id" => "شناسه سانس",
            "start_at" => "تاریخ شروع",
            "expire_at" => "تاریخ انقضاء",
        ];
    }
}
