<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Transacao;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\TransacaoFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Cria Tenants
        $tenant1 = Tenant::create(['id' => 'tenant1']);
        $tenant2 = Tenant::create(['id' => 'tenant2']);

        //Cria Domains para os Tenants
        $tenant1->domains()->create(['domain' => 'tenant1.localhost']);
        $tenant2->domains()->create(['domain' => 'tenant2.localhost']);

        //Cria dois usuarios no Tenant1 e duas transacoes para cada um deles
        $tenant1->run(function () {
            $t1user1 = User::create([
                'name' => 'T1user1',
                'email' => 't1test1@test.com',
                'password' => bcrypt('Password!1'),
            ]);
            $t1user2 = User::create([
                'name' => 'T1user2',
                'email' => 't1test2@test.com',
                'password' => bcrypt('Password!1'),
            ]);
            $t1user1->transacoes()->create(TransacaoFactory::new()->make(['user_id' => $t1user1->id])->toArray());
            $t1user2->transacoes()->create(TransacaoFactory::new()->make(['user_id' => $t1user2->id])->toArray());
        });

        //Cria dois usuarios no Tenant2 e duas transacoes para cada um deles
        $tenant2->run(function () {
            $t2user1 = User::create([
                'name' => 'T2user1',
                'email' => 't2test1@test.com',
                'password' => bcrypt('Password!1'),
            ]);
            $t2user2 = User::create([
                'name' => 'T2user2',
                'email' => 't2test2@test.com',
                'password' => bcrypt('Password!1'),
            ]);
            $t2user1->transacoes()->create(TransacaoFactory::new()->make(['user_id' => $t2user1->id])->toArray());
            $t2user2->transacoes()->create(TransacaoFactory::new()->make(['user_id' => $t2user2->id])->toArray());
        });
    }
}
