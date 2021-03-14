<?php

namespace App\UseCases\Contacts;

use App\Models\Contact;
use App\Models\User;

class FavoriteService
{
    public function add($userId, $contactId): void
    {
        $user = $this->getUser($userId);
        $contact = $this->getContact($contactId);

        $user->addToFavorites($contact->id);
    }

    public function remove($userId, $contactId): void
    {
        $user = $this->getUser($userId);
        $contact = $this->getContact($contactId);

        $user->removeFromFavorites($contact->id);
    }

    private function getUser($userId): User
    {
        return User::findOrFail($userId);
    }

    private function getContact($contactId): Contact
    {
        return Contact::findOrFail($contactId);
    }
}
