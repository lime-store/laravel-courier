<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  
        User::create(['name' => 'Admin', 'email' => 'admin@test.com', 'password' => bcrypt('password'), 'role' => 'admin']);
        User::create(['name' => 'Courier1', 'email' => 'courier@test.com', 'password' => bcrypt('password'), 'role' => 'courier']);
    
        // Создаём тестовые заказы
        Order::create(['address_from' => 'ул. Ленина, 1',   'address_to' => 'ул. Пушкина, 5']);
        Order::create(['address_from' => 'пр. Мира, 10',    'address_to' => 'ул. Гагарина, 3']);
        Order::create(['address_from' => 'ул. Советская, 7','address_to' => 'пр. Победы, 15']);
    }
}
