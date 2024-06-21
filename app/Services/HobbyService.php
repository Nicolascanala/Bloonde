<?php

namespace App\Services;

use App\Models\Hobbie;
use App\Models\Customer;

class HobbyService
{
    /**
     * Crear / Encontrar los hobbies que han sido enviados en el request.
     * Maneja el sync para la creación y edición de los customers y sus hobbies.
     *
     * @param Customer $customer
     * @param array $hobbyNames
     * @return void
     */
    public function syncHobbies(Customer $customer, array $hobbyNames): void
    {
        $existingHobbies = Hobbie::whereIn('name', $hobbyNames)->get()->keyBy('name');
        $idsOfHobbiesToSync = [];

        foreach ($hobbyNames as $hobbyName) {
            if ($existingHobbies->has($hobbyName)) {
                $idsOfHobbiesToSync[] = $existingHobbies[$hobbyName]->id;
            } else {
                $newHobby = Hobbie::create(['name' => $hobbyName]);
                $idsOfHobbiesToSync[] = $newHobby->id;
            }
        }

        $customer->hobbies()->sync($idsOfHobbiesToSync);
    }
}
