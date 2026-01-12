<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create or update admin user
        $email = 'litobandaoficial@gmail.com';

        $user = User::firstOrNew(['email' => $email]);
        $user->name = 'Admin';
        $user->email = $email;
        // `password` attribute uses the `hashed` cast in the User model,
        // so assign the plain password and let the model cast handle hashing.
        $user->password = 'Gerardway06*';
        // If your app uses roles/is_admin flag, set it here. Adjust as needed:
        if (Schema::hasColumn('users', 'is_admin')) {
            $user->is_admin = true;
        }
        $user->save();
    }
}
