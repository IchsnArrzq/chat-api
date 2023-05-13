<?php

namespace App\Services\Contact;

use App\Contracts\ServiceContract;
use App\Models\Contact;
use App\Models\User;
use App\Services\BaseService;

class ContactToggle extends BaseService implements ServiceContract
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'contact_id' => 'required|exists:users,id',
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);

        if (
            Contact::where('contact_id', $data['contact_id'])->where('user_id', $data['user_id'])->exists()
        ) {
            Contact::where('contact_id', $data['contact_id'])->where('user_id', $data['user_id'])->delete();
        } else {
            Contact::create($data);
        }
    }
}
