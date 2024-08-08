<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expense_types = [
            ["name" => "Salary"],
            ["name" => "Utility"],
            ["name" => "Repairs"],
            ["name" => "Welfare"],
            ["name" => "Misc"],
            ["name" => "KElectric"],
            ["name" => "KWSB"],
            ["name" => "SSGC"],
            ["name" => "Cleaning Supplies"],
            ["name" => "Office Supplies"],
            ["name" => "Electrical Supplies"],
            ["name" => "Plumbing Supplies"],
            ["name" => "Goods Material"],
            ["name" => "Waste Disposal"],
            ["name" => "Tv Cable"],
            ["name" => "Mosque / Prayer"],
            ["name" => "Water Tanker"],
            ["name" => "Mason / Brickwork"],
            ["name" => "Repairs-Electric"],
            ["name" => "Repairs-Plumbing"],
            ["name" => "Repairs-Mason"],
            ["name" => "Decorative Goods"],
            ["name" => "CCTV Maintenance"],
            ["name" => "Eid ul Adha Provision"],
            ["name" => "Eid ul Fitr Provision"],
        ];

        foreach($expense_types as $expense_type){
            ExpenseType::create([
                "name" => $expense_type["name"]
            ]);
        }
    }
}
