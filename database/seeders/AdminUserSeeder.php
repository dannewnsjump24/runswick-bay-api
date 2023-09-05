<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $name = text(
            label: 'What is your name?',
        );

        $email = text(
            label: 'What is your email?',
            validate: fn (string $value) => match (true) {
                Validator::make([
                    'email' => $value,
                ], [
                    'email' => ['email'],
                ])->fails() => 'The email must be a valid email.',
                Validator::make([
                    'email' => $value,
                ], [
                    'email' => ['unique:users,email'],
                ])->fails() => 'The email must not already exist.',
                default => null
            }
        );

        $password = password(
            label: 'What is your password?',
            placeholder: 'Minimum 8 characters...',
            validate: fn (string $value) => match (true) {
                strlen($value) < 8 => 'The password must be at least 8 characters.',
                default => null
            }
        );

        User::factory()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }
}
