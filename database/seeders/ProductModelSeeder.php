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
            'product_name' => 'TERM',

        ]);

        ProductModel::create([
            'lender_id' => 1,
            'product_name' => 'OVERDRAFT',

        ]);

        // ProductModel::create([
        //     'lender_id' => 1,
        //     'product_name' => 'CORPORATE',

        // ]);

        ProductModel::create([
            'lender_id' => 2,
            'product_name' => 'Business Overdraft',

        ]);

        ProductModel::create([
            'lender_id' => 2,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 3,
            'product_name' => 'Business Loan',

        ]);

        ProductModel::create([
            'lender_id' => 3,
            'product_name' => 'Line Of Credit',

        ]);

        ProductModel::create([
            'lender_id' => 4,
            'product_name' => 'Business Loan',

        ]);

        ProductModel::create([
            'lender_id' => 5,
            'product_name' => 'Business Loan',

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
            'product_name' => 'Business Loan',

        ]);

        ProductModel::create([
            'lender_id' => 8,
            'product_name' => 'Unsecured Cash Flow Loan',

        ]);

        ProductModel::create([
            'lender_id' => 9,
            'product_name' => 'Cash Advance & Line of Credit',

        ]);

        ProductModel::create([
            'lender_id' => 10,
            'product_name' => 'Line of Credit',

        ]);

        ProductModel::create([
            'lender_id' => 11,
            'product_name' => 'Bizcap',

        ]);

        ProductModel::create([
            'lender_id' => 12,
            'product_name' => 'Capify',

        ]);

        ProductModel::create([
            'lender_id' => 13,
            'product_name' => 'Position Criteria',

        ]);

        ProductModel::create([
            'lender_id' => 13,
            'product_name' => 'Unsecured & Secured Term Loans',

        ]);

        ProductModel::create([
            'lender_id' => 13,
            'product_name' => 'Consolidation Loans',

        ]);

        ProductModel::create([
            'lender_id' => 15,
            'product_name' => 'Term Loan',

        ]);

        ProductModel::create([
            'lender_id' => 14,
            'product_name' => 'Skyecap',

        ]);

        ProductModel::create([
            'lender_id' => 16,
            'product_name' => 'Rapital',

        ]);

        ProductModel::create([
            'lender_id' => 17,
            'product_name' => 'Funds now',

        ]);

        ProductModel::create([
            'lender_id' => 18,
            'product_name' => 'Banjo Business Loan Express',

        ]);

        ProductModel::create([
            'lender_id' => 19,
            'product_name' => 'Moneytech',

        ]);
    }
}
