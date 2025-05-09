<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Address;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $batchSize = 1000;
        $totalUsers = 1000000;

        for ($i = 0; $i < $totalUsers; $i += $batchSize) {
            $now = now();

            $users = User::factory()->count($batchSize)->make()->toArray();

            DB::table('users')->insert(array_map(function ($user) use ($now) {
                return array_merge($user, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }, $users));

            $lastUserId = DB::table('users')->latest('id')->first()->id;
            $firstUserId = $lastUserId - $batchSize + 1;

            $addresses = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $addr = Address::factory()->make();
                $addresses[] = [
                    'user_id' => $firstUserId + $j,
                    'country' => $addr->country,
                    'city' => $addr->city,
                    'post_code' => $addr->post_code,
                    'street' => $addr->street,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            DB::table('addresses')->insert($addresses);

            echo "Seeded: " . ($i + $batchSize) . " users\n";
        }
    }
}

