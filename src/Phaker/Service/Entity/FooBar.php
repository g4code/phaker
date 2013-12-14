<?php

namespace G4\Phaker\Service\Entity;

class FooBar extends EntityAbstract
{
    public function getData()
    {
        $faker = \Faker\Factory::create();

        return array(
            'user_id'  => $faker->randomNumber(5),
            'username' => $faker->userName,
            'email'    => $faker->email,
            'password' => $faker->md5,
            'address'  => $faker->address,
            'status'   => $faker->text(),
        );
    }
}