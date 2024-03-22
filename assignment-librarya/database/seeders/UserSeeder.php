<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Database\Factories\AuthorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUsersData(Roles::AUTHOR, 'author');
        $this->setUsersData(Roles::REVIEWER, 'reviewer');
    }

    /**
     * @param int $userType
     * @param string $userTypeName
     * @param int $iterator
     *
     * @return void
     */
    private function setUsersData(int $userType, string $userTypeName): void
    {
        for($i=1;$i<6;$i++) {
            User::create([
                'role_id' => $userType,
                'name' => $userTypeName.$i,
                'email' => $userTypeName.$i.'@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), //password,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
