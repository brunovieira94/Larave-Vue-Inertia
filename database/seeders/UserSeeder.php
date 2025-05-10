<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Traits\ProgressBar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    use ProgressBar;

    private int $batchSize = 1000;
    private int $totalUsers = 1000000;

    public function run(): void
    {
        $this->prepareDatabase();
        $this->startProgress($this->totalUsers);

        DB::disableQueryLog();

        try {
            DB::beginTransaction();

            for ($i = 0; $i < $this->totalUsers; $i += $this->batchSize) {
                $this->processBatch($i);
                $this->advanceProgress($this->batchSize);
            }

            DB::commit();
            echo "\nSeeding completed successfully!\n";
        } catch (\Exception $e) {
            DB::rollBack();
            echo "\nError: " . $e->getMessage() . "\n";
            throw $e;
        }
    }

    private function prepareDatabase(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        DB::table('addresses')->truncate();
        Schema::enableForeignKeyConstraints();
    }

    private function processBatch(int $offset): void
    {
        $now = now();
        $users = $this->generateUsers($now);

        DB::table('users')->insert($users);

        $lastUserId = DB::table('users')->latest('id')->first()->id;
        $firstUserId = $lastUserId - $this->batchSize + 1;

        $addresses = $this->generateAddresses($firstUserId, $now);
        DB::table('addresses')->insert($addresses);
    }

    private function generateUsers($timestamp): array
    {
        return User::factory()
            ->count($this->batchSize)
            ->make()
            ->map(fn($user) => array_merge($user->toArray(), [
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]))
            ->toArray();
    }

    private function generateAddresses(int $firstUserId, $timestamp): array
    {
        $addresses = [];

        for ($j = 0; $j < $this->batchSize; $j++) {
            $addr = Address::factory()->make();
            $addresses[] = [
                'user_id' => $firstUserId + $j,
                'country' => $addr->country,
                'city' => $addr->city,
                'post_code' => $addr->post_code,
                'street' => $addr->street,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        return $addresses;
    }
}

