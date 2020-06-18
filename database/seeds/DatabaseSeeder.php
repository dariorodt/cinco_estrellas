<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(WorkersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(WorkerProfilesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ServiceWorkerTableSeeder::class);
        $this->call(ClientProfilesTableSeeder::class);
        $this->call(ServiceOrdersTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ApplicationsTableSeeder::class);
        $this->call(WorkerRatingsTableSeeder::class);
        $this->call(ClientRatingsTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
    }
}
