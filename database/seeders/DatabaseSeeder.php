<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Product;
use App\Models\TypeProduct;
use App\Models\News;
use App\Models\Slide;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Customer::factory(10)->create();
        TypeProduct::factory(5)->create();
        Product::factory(20)->create();
        Bill::factory(10)->create();
        BillDetail::factory(30)->create();
        User::factory(1)->create();
        News::factory(5)->create();
        Slide::factory(5)->create();
    }
}
