<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductTypeModel;

class LenderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        //dynamoney
        ProductTypeModel::create([
            'product_id' => 1,
            'sub_product_name' => 'Term',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 500000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);

        ProductTypeModel::create([
            'product_id' => 2,
            'sub_product_name' => 'Overdraft',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 500000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);

        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Corporate',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 200000,
            'max_loan_amount' => 2000000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);


        //ondeck
        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Teir 1',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 24,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 1000000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Teir 2',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 24,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Teir 3',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 24,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Teir 4',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 24,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);


        //shift
        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Teir 1',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 24,
            'min_loan_amount' => 25000,
            'max_loan_amount' => 1000000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Teir 2',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 24,
            'min_loan_amount' => 25000,
            'max_loan_amount' => 500000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Teir 3',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 24,
            'min_loan_amount' => 25000,
            'max_loan_amount' => 500000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Teir 4',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 24,
            'min_loan_amount' => 25000,
            'max_loan_amount' => 500000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Teir 0',
            'trading_time' => 60,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 200000,
            'max_loan_amount' => 750000,
            'annual_income' => 5000000,
            'credit_score' => 750,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Teir 1',
            'trading_time' => 60,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 750000,
            'annual_income' => 1000000,
            'credit_score' => 750,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Teir 2',
            'trading_time' => 36,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 750000,
            'annual_income' => 5000000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Teir 3',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 300000,
            'annual_income' => 50000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Teir 4',
            'trading_time' => 18,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 200000,
            'annual_income' => 50000,
            'credit_score' => 450,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Teir 5',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 150000,
            'annual_income' => 50000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);



        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Teir 0',
            'trading_time' => 60,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 200000,
            'max_loan_amount' => 750000,
            'annual_income' => 5000000,
            'credit_score' => 750,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Teir 1',
            'trading_time' => 60,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 750000,
            'annual_income' => 1000000,
            'credit_score' => 750,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Teir 2',
            'trading_time' => 36,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 750000,
            'annual_income' => 250000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Teir 3',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 300000,
            'annual_income' => 50000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Teir 1',
            'trading_time' => 60,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 5000000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode([
                'Fitness',
                'Fuel Stations',
                'Accommodation',
                'Hospitality',
                'Restaurants',
                'Beauty'
            ]),
        ]);

        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Teir 2',
            'trading_time' => 36,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 1000000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode([
                'Fitness',
                'Fuel Stations',
                'Accommodation',
                'Hospitality',
                'Restaurants',
                'Beauty'
            ]),
        ]);

        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Teir 3',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 200000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode([
                'Fitness',
                'Fuel Stations',
                'Accommodation',
                'Hospitality',
                'Restaurants',
                'Beauty'
            ]),
        ]);

        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Teir 4',
            'trading_time' => 18,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 75000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode([
                'Fitness',
                'Fuel Stations',
                'Accommodation',
                'Hospitality',
                'Restaurants',
                'Beauty'
            ]),
        ]);

        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Teir 5',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 75000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode([
                'Fitness',
                'Fuel Stations',
                'Accommodation',
                'Hospitality',
                'Restaurants',
                'Beauty'
            ]),
        ]);


        ProductTypeModel::create([
            'product_id' => 10,
            'sub_product_name' => 'Propsa Business Line of Credit',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 2000,
            'max_loan_amount' => 150000,
            'annual_income' => 72000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 9,
            'sub_product_name' => 'Propsa Small Business Loan',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 150000,
            'annual_income' => 72000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 9,
            'sub_product_name' => 'Propsa Business Loan Plus Tier 1',
            'trading_time' => 74,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 150000,
            'max_loan_amount' => 5000000,
            'annual_income' => 4000000,
            'credit_score' => 800,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 9,
            'sub_product_name' => 'Propsa Business Loan Plus Tier 2',
            'trading_time' => 60,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 150000,
            'max_loan_amount' => 5000000,
            'annual_income' => 2500000,
            'credit_score' => 800,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 9,
            'sub_product_name' => 'Propsa Business Loan Plus Tier 3',
            'trading_time' => 36,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 150000,
            'max_loan_amount' => 5000000,
            'annual_income' => 1000000,
            'credit_score' => 700,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 11,
            'sub_product_name' => 'Lightning Loan',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 175000,
            'annual_income' => 100000,
            'credit_score' => 500,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 11,
            'sub_product_name' => 'Lightning Loan Plus',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 175000,
            'max_loan_amount' => 250000,
            'annual_income' => 100000,
            'credit_score' => 500,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 12,
            'sub_product_name' => 'Tier 1',
            'trading_time' => 48,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 120000,
            'credit_score' => 625,
            'property_owner' => 'yes',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 12,
            'sub_product_name' => 'Tier 2',
            'trading_time' => 48,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 100000,
            'max_loan_amount' => 200000,
            'annual_income' => 120000,
            'credit_score' => 625,
            'property_owner' => 'yes',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 12,
            'sub_product_name' => 'Tier 2',
            'trading_time' => 36,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 200000,
            'max_loan_amount' => 500000,
            'annual_income' => 120000,
            'credit_score' => 625,
            'property_owner' => 'yes',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 13,
            'sub_product_name' => 'Diamond',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 75000,
            'annual_income' => 120000,
            'credit_score' => 650,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 13,
            'sub_product_name' => 'Platinum',
            'trading_time' => 18,
            'GST_registration' => 'Yes',
            'gst_time' => 6,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 50000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 13,
            'sub_product_name' => 'Gold',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 3,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 35000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 14,
            'sub_product_name' => 'Tier 1',
            'trading_time' => 60,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 0,
            'max_loan_amount' => 500000,
            'annual_income' => 1000000,
            'credit_score' => 0,
            'property_owner' => 'no',
            'negative_days' => 14,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 14,
            'sub_product_name' => 'Tier 2',
            'trading_time' => 24,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 0,
            'max_loan_amount' => 300000,
            'annual_income' => 500000,
            'credit_score' => 0,
            'property_owner' => 'no',
            'negative_days' => 14,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 14,
            'sub_product_name' => 'Tier 3',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 0,
            'max_loan_amount' => 150000,
            'annual_income' => 120000,
            'credit_score' => 0,
            'property_owner' => 'no',
            'negative_days' => 14,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 14,
            'sub_product_name' => 'Tier 4',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 0,
            'max_loan_amount' => 120000,
            'annual_income' => 50000,
            'credit_score' => 0,
            'property_owner' => 'no',
            'negative_days' => 14,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);



        ProductTypeModel::create([
            'product_id' => 15,
            'sub_product_name' => 'Line of Credit',
            'trading_time' => 9,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 0,
            'max_loan_amount' => 300000,
            'annual_income' => 240000,
            'credit_score' => 300,
            'property_owner' => 'no',
            'negative_days' => 14,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Ticket Brokers', 'Cryptocurrency']),
        ]);

        ProductTypeModel::create([
            'product_id' => 17,
            'sub_product_name' => 'Unsecured Loan',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 300000,
            'annual_income' => 60000,
            'credit_score' => 300,
            'property_owner' => 'yes',
            'negative_days' => 14,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Non-Profits Charities', 'Adult Entertainment', 'Debt Collection & Repair Services', 'Payday Lenders', 'Pawn Shops', 'Medical Marijuana', 'Travel Agencies', 'Multi-level Marketing & Rewards Schemes', 'Residential Builders']),
        ]);


        ProductTypeModel::create([
            'product_id' => 17,
            'sub_product_name' => 'Innovice Finance',
            'trading_time' => 3,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 2000,
            'max_loan_amount' => 100000,
            'annual_income' => 0,
            'credit_score' => 300,
            'property_owner' => 'yes',
            'negative_days' => 14,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Non-Profits Charities', 'Adult Entertainment', 'Debt Collection & Repair Services', 'Payday Lenders', 'Pawn Shops', 'Medical Marijuana', 'Travel Agencies', 'Multi-level Marketing & Rewards Schemes', 'Residential Builders']),
        ]);


        ProductTypeModel::create([
            'product_id' => 21,
            'sub_product_name' => 'Tier A',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 20000,
            'max_loan_amount' => 150000,
            'annual_income' => 600000,
            'credit_score' => 500,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 21,
            'sub_product_name' => 'Tier B',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 20000,
            'max_loan_amount' => 150000,
            'annual_income' => 600000,
            'credit_score' => 500,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 21,
            'sub_product_name' => 'Tier C',
            'trading_time' => 10,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 15000,
            'max_loan_amount' => 1000000,
            'annual_income' => 360000,
            'credit_score' => 300,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 21,
            'sub_product_name' => 'Tier D',
            'trading_time' => 10,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 20000,
            'max_loan_amount' => 250000,
            'annual_income' => 600000,
            'credit_score' => 500,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 22,
            'sub_product_name' => 'Tier A',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 100000,
            'annual_income' => 84000,
            'credit_score' => 500,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 23,
            'sub_product_name' => 'Tier A',
            'trading_time' => 3,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 100000,
            'annual_income' => 84000,
            'credit_score' => 200,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => 5,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Non-Profits Charities', 'Adult Entertainment', 'Debt Collection & Repair Services', 'Payday Lenders', 'Pawn Shops', 'Medical Marijuana', 'Travel Agencies', 'Multi-level Marketing & Rewards Schemes', 'Residential Builders']),
        ]);


        ProductTypeModel::create([
            'product_id' => 24,
            'sub_product_name' => 'Tier A',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 20000,
            'max_loan_amount' => 500000,
            'annual_income' => 240000,
            'credit_score' => 200,
            'property_owner' => 'no',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'restricted_industry' => json_encode(['Property Development', 'Non-Profits Charities', 'Adult Entertainment', 'Debt Collection & Repair Services', 'Payday Lenders', 'Pawn Shops', 'Medical Marijuana', 'Travel Agencies', 'Multi-level Marketing & Rewards Schemes', 'Residential Builders']),
        ]);
    }
}
