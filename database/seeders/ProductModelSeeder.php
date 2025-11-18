<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductModel;


class ProductModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        ProductModel::create([
            'lender_id' => 1,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 1,
            'product_name' => 'Overdraft Loan',

        ]);



        ProductModel::create([
            'lender_id' => 2,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 2,
            'product_name' => 'Overdraft Loan',

        ]);

        ProductModel::create([
            'lender_id' => 3,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 3,
            'product_name' => 'Line Of Credit',

        ]);


        ProductModel::create([
            'lender_id' => 4,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 5,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 5,
            'product_name' => 'Line of Credit',

        ]);

        ProductModel::create([
            'lender_id' => 6,
            'product_name' => 'Business Loan',

        ]);

        ProductModel::create([
            'lender_id' => 7,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 8,
            'product_name' => 'Diamond Loan',

        ]);

        ProductModel::create([
            'lender_id' => 8,
            'product_name' => 'Platinum Loan',

        ]);

        ProductModel::create([
            'lender_id' => 8,
            'product_name' => 'Gold Loan',

        ]);

        ProductModel::create([
            'lender_id' => 9,
            'product_name' => 'Bigga',

        ]);

        // ProductModel::create([
        //     'lender_id' => 10,
        //     'product_name' => 'Line of Credit',

        // ]);

        ProductModel::create([
            'lender_id' => 11,
            'product_name' => 'Business Loan',

        ]);

        ProductModel::create([
            'lender_id' => 11,
            'product_name' => 'Line of Credit',

        ]);

        ProductModel::create([
            'lender_id' => 12,
            'product_name' => 'Business Loan',

        ]);

        ProductModel::create([
            'lender_id' => 12,
            'product_name' => 'Invoive Finance',

        ]);

        ProductModel::create([
            'lender_id' => 13,
            'product_name' => 'Term Loan',

        ]);

        // ProductModel::create([
        //     'lender_id' => 13,
        //     'product_name' => 'Unsecured & Secured Term Loans',

        // ]);

        // ProductModel::create([
        //     'lender_id' => 13,
        //     'product_name' => 'Consolidation Loans',

        // ]);

        ProductModel::create([
            'lender_id' => 15,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 14,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 16,
            'product_name' => 'Term  Loan',

        ]);

        ProductModel::create([
            'lender_id' => 17,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 18,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 19,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 19,
            'product_name' => 'Line Of Credit',

        ]);
    }
}
