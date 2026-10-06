<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
 public function run(): void { User::firstOrCreate(['email'=>'admin@bardoprimo.com'],['name'=>'Administrador','password'=>Hash::make('password')]); foreach(['Cervejas','Destilados','Refrigerantes'] as $name) Category::firstOrCreate(['name'=>$name]); foreach(['Atacadão','Roldão','Mega Stock'] as $name) Supplier::firstOrCreate(['name'=>$name]); }
}
