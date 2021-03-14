<?php

namespace App\UseCases\Contacts;

use App\Http\Requests\Contacts\CreateRequest;
use App\Http\Requests\Contacts\EditRequest;
use App\Models\Contact;
use App\Models\User;

class ContactService
{
    public function create($userId, CreateRequest $request): Contact
    {
        /** @var User $user */
        $user = User::findOrFail($userId);

        /** @var Contact $contact */
        $contact = Contact::make([
            'name' => $request['name'],
            'phone' => $request['phone'],
        ]);


        $contact->user()->associate($user);
        $contact->saveOrFail();

        return $contact;
    }

    public function edit($id, EditRequest $request): void
    {
        $contact = $this->getContact($id);
        $contact->update($request->only([
            'name',
            'phone',
        ]));
    }

    public function remove($id): void
    {
        $contact = $this->getContact($id);
        $contact->delete();
    }

    private function getContact($id): Contact
    {
        return Contact::findOrFail($id);
    }
}
