<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->userID = Str::uuid();
        $user->name = 'User 1';
        $user->email = 'user1@gmail.com';
        $user->password = Hash::make('12345');
        $user->roleID = '3dafb9d5-3c54-4b11-8aa9-267198181d62';
        $user->save();
    }
}
