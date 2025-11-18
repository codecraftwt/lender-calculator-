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
            'sub_product_name' => 'Term Loan A (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 24,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 500000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'interest_rate' => 14.40,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);

        ProductTypeModel::create([
            'product_id' => 1,
            'sub_product_name' => 'Term Loan B (Property Backed)',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 250000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'interest_rate' => 14.40,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);

        ProductTypeModel::create([
            'product_id' => 1,
            'sub_product_name' => 'Term Loan C (Non-Property Backed)',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 100000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'interest_rate' => 19.40,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);



        ProductTypeModel::create([
            'product_id' => 2,
            'sub_product_name' => 'Overdraft A (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 24,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 500000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'interest_rate' => 14.55,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);


        ProductTypeModel::create([
            'product_id' => 2,
            'sub_product_name' => 'Overdraft B (Property Backed)',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 250000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'interest_rate' => 14.55,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);

        ProductTypeModel::create([
            'product_id' => 2,
            'sub_product_name' => 'Overdraft C (Non-Property Backed)',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 100000,
            'annual_income' => 120000,
            'credit_score' => 500,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'interest_rate' => 18.55,
            'restricted_industry' => json_encode(['Fitness', 'Beauty', 'Property Development']),
        ]);


        //shift term
        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Term Loan A (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 1000000,
            'annual_income' => 10000000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 14.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Term Loan B (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 5000000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 17.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Term Loan C (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 1500000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 20.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Term Loan D (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 23.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);


        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Term Loan A (Non-Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 10000000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 14.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);


        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Term Loan B (Non-Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 5000000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 17.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Term Loan C (Non-Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 1500000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 20.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 3,
            'sub_product_name' => 'Term Loan D (Non-Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 23.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);


        // shift overdraft


        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Overdraft A (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 1000000,
            'annual_income' => 10000000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 14.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Overdraft B (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 5000000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 17.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Overdraft C (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 1500000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 19.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Overdraft D (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 20.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);


        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Overdraft A (Non-Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 10000000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 14.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);


        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Overdraft B (Non-Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 5000000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 17.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Overdraft C (Non-Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 1500000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 19.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);

        ProductTypeModel::create([
            'product_id' => 4,
            'sub_product_name' => 'Overdraft D (Non-Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 250000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 24.95,
            'restricted_industry' => json_encode(['Property Development', 'Mining Services', 'Primary Agriculture (Farms)']),
        ]);




        //Lumi
        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Term Loan-Tier 0',
            'trading_time' => 60,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 200000,
            'max_loan_amount' => 750000,
            'annual_income' => 5000000,
            'credit_score' => 750,
            'property_owner' =>  'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 15.50,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Term Loan-Tier 1',
            'trading_time' => 60,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 750000,
            'annual_income' => 1000000,
            'credit_score' => 750,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 17.50,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Term Loan-Tier 2',
            'trading_time' => 36,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 750000,
            'annual_income' => 250000,
            'credit_score' => 600,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 22.50,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Term Loan-Tier 3',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 300000,
            'annual_income' => 50000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 29.50,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Term Loan-Tier 4',
            'trading_time' => 18,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 200000,
            'annual_income' => 50000,
            'credit_score' => 450,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 39.50,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 5,
            'sub_product_name' => 'Term Loan-Tier 5',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 150000,
            'annual_income' => 50000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 44.50,
            'restricted_industry' => null,
        ]);



        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Line Of Credit-Tier 0',
            'trading_time' => 60,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 200000,
            'max_loan_amount' => 750000,
            'annual_income' => 5000000,
            'credit_score' => 750,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 15.50,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Line Of Credit-Tier 1',
            'trading_time' => 60,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 750000,
            'annual_income' => 1000000,
            'credit_score' => 750,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 17.50,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Line Of Credit-Tier 2',
            'trading_time' => 36,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 750000,
            'annual_income' => 250000,
            'credit_score' => 600,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 22.50,
            'restricted_industry' => null,
        ]);



        ProductTypeModel::create([
            'product_id' => 6,
            'sub_product_name' => 'Line Of Credit-Tier 3',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 300000,
            'annual_income' => 50000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 29.50,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Term Loan - A',
            'trading_time' => 60,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 5000000,
            'credit_score' => 600,
            'property_owner' => 'Yes',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 15.99,
            'restricted_industry' => json_encode(['Gym/Fitness', 'Fuel Stations',  'Accommodation', 'Hospitality', 'Restaurants', 'Beauty']),
        ]);



        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Term Loan - B',
            'trading_time' => 36,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 1000000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 20.09,
            'restricted_industry' => json_encode(['Gym/Fitness', 'Fuel Stations',  'Accommodation', 'Hospitality', 'Restaurants', 'Beauty']),
        ]);


        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Term Loan - C',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 200000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 25.99,
            'restricted_industry' => json_encode(['Gym/Fitness', 'Fuel Stations',  'Accommodation', 'Hospitality', 'Restaurants', 'Beauty']),
        ]);


        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Term Loan - D',
            'trading_time' => 18,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 75000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 29.99,
            'restricted_industry' => json_encode(['Gym/Fitness', 'Fuel Stations',  'Accommodation', 'Hospitality', 'Restaurants', 'Beauty']),
        ]);


        ProductTypeModel::create([
            'product_id' => 7,
            'sub_product_name' => 'Term Loan - E',
            'trading_time' => 6,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 250000,
            'annual_income' => 75000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 35.99,
            'restricted_industry' => json_encode(['Gym/Fitness', 'Fuel Stations',  'Accommodation', 'Hospitality', 'Restaurants', 'Beauty']),
        ]);

        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Business Loan Plus - Premium Rates',
            'trading_time' => 36,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 150000,
            'max_loan_amount' => 500000,
            'annual_income' => 1000000,
            'credit_score' => 400,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 14.95,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Business Loan Plus - Standard Rates',
            'trading_time' => 36,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 150000,
            'max_loan_amount' => 500000,
            'annual_income' => 1000000,
            'credit_score' => 400,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => 28.95,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Small Business Loan - Premium Rates',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 150000,
            'annual_income' => 72000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 14.95,
            'restricted_industry' => null,
        ]);



        ProductTypeModel::create([
            'product_id' => 8,
            'sub_product_name' => 'Small Business Loan - Standard Rates',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 150000,
            'annual_income' => 72000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 28.95,
            'restricted_industry' => null,
        ]);



        ProductTypeModel::create([
            'product_id' => 9,
            'sub_product_name' => 'Line of Credit (Asset Backed)  - Premium Rates',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 100000,
            'max_loan_amount' => 500000,
            'annual_income' => 1000000,
            'credit_score' => 400,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 14.95,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 9,
            'sub_product_name' => 'Line of Credit (Asset Backed)  - Standard Rates',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 100000,
            'max_loan_amount' => 500000,
            'annual_income' => 1000000,
            'credit_score' => 400,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => 28.95,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 9,
            'sub_product_name' => 'Line of Credit (Non-Asset Backed)  - Premium Rates',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 100000,
            'annual_income' => 72000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 14.95,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 9,
            'sub_product_name' => 'Line of Credit (Non-Asset Backed)  - Standard Rates',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 100000,
            'annual_income' => 72000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => 28.95,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 10,
            'sub_product_name' => 'Business Loan',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 250000,
            'credit_score' => 500,
            'property_owner' => 'No',
            'negative_days' => 20,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 11,
            'sub_product_name' => 'Term Loan A',
            'trading_time' => 36,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 200000,
            'max_loan_amount' => 500000,
            'annual_income' => 120000,
            'credit_score' => 625,
            'property_owner' => 'Yes',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 11,
            'sub_product_name' => 'Term Loan B',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 100000,
            'max_loan_amount' => 200000,
            'annual_income' => 120000,
            'credit_score' => 625,
            'property_owner' => 'Yes',
            'negative_days' => 20,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 11,
            'sub_product_name' => 'Term Loan C',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 100000,
            'annual_income' => 120000,
            'credit_score' => 400,
            'property_owner' => 'No',
            'negative_days' => 20,
            'number_of_dishonours' => 2,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 12,
            'sub_product_name' => 'Diamond Loan (Property Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 75000,
            'annual_income' => 120000,
            'credit_score' => 550,
            'property_owner' => 'Yes',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 11.45,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 12,
            'sub_product_name' => 'Diamond Loan (Non Property-Backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 50000,
            'annual_income' => 120000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 13.45,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 13,
            'sub_product_name' => 'Platinum Loan',
            'trading_time' => 18,
            'GST_registration' => 'Yes',
            'gst_time' => 6,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 50000,
            'annual_income' => 120000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => 15,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 17.45,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 14,
            'sub_product_name' => 'Gold Loan',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 3,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 35000,
            'annual_income' => 120000,
            'credit_score' => 550,
            'property_owner' => 'No',
            'negative_days' => 30,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 23.45,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 15,
            'sub_product_name' => 'Tier 1',
            'trading_time' => 60,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'annual_income' => 1000000,
            'credit_score' => 0,
            'property_owner' => 'Yes',
            'negative_days' => 0,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => 25,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 15,
            'sub_product_name' => 'Tier 2',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 300000,
            'annual_income' => 500000,
            'credit_score' => 0,
            'property_owner' => 'Yes',
            'negative_days' => 14,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 35,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 15,
            'sub_product_name' => 'Tier 3',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 150000,
            'annual_income' => 120000,
            'credit_score' => 0,
            'property_owner' => 'No',
            'negative_days' => 14,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 40,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 15,
            'sub_product_name' => 'Tier 4',
            'trading_time' => 6,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 10000,
            'max_loan_amount' => 50000,
            'annual_income' => 120000,
            'credit_score' => 0,
            'property_owner' => 'No',
            'negative_days' => 14,
            'number_of_dishonours' => 3,
            'deleted_flag' => 0,
            'interest_rate' => 45,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 16,
            'sub_product_name' => 'Business Loan',
            'trading_time' => 4,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 5000000,
            'annual_income' => 144000,
            'credit_score' => 0,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => json_encode([' Car Dealerships', 'Labour Hire', 'Finance Businesses', 'Securiy', 'Labour Hire', 'Commercial Cleaning', 'Adult Entertainment', 'Online Pharmacies', 'Nutraceuticals and Drug Paraphernalia']),
        ]);


        ProductTypeModel::create([
            'product_id' => 17,
            'sub_product_name' => 'Line Of Credit',
            'trading_time' => 9,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 300000,
            'annual_income' => 240000,
            'credit_score' => 300,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => json_encode([' Car Dealerships', 'Labour Hire', 'Finance Businesses', 'Securiy', 'Labour Hire', 'Commercial Cleaning', 'Adult Entertainment', 'Online Pharmacies', 'Nutraceuticals and Drug Paraphernalia']),
        ]);


        ProductTypeModel::create([
            'product_id' => 18,
            'sub_product_name' => 'Business Loan (Asset backed)',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 300000,
            'annual_income' => 60000,
            'credit_score' => 300,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => json_encode(['Commercial Builders', 'Coffee retail']),
        ]);

        ProductTypeModel::create([
            'product_id' => 18,
            'sub_product_name' => 'Business Loan (Non Asset-backed)',
            'trading_time' => 12,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 200000,
            'annual_income' => 60000,
            'credit_score' => 300,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => json_encode(['Commercial Builders', 'Coffee retail']),
        ]);

        ProductTypeModel::create([
            'product_id' => 19,
            'sub_product_name' => 'Invoice Finance',
            'trading_time' => 3,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 2000,
            'max_loan_amount' => 150000,
            'annual_income' => 0,
            'credit_score' => 200,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 20,
            'sub_product_name' => 'Term Loan',
            'trading_time' => 6,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 250000,
            'annual_income' => 420000,
            'credit_score' => 350,
            'property_owner' => 'No',
            'negative_days' => 8,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);


        ProductTypeModel::create([
            'product_id' => 21,
            'sub_product_name' => 'Term Loan (Asset Backed)',
            'trading_time' => 10,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 150000,
            'max_loan_amount' => 250000,
            'annual_income' => 360000,
            'credit_score' => 300,
            'property_owner' => 'Yes',
            'negative_days' => 5,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' =>  json_encode(['Real Estate', 'Property Management', 'Gas Stations', 'Recycling Services', 'Pool Contractors & Maintenance', 'Solar Panel Sales & Installation;', 'Agricultural Businesses', 'Staffing Agencies']),
        ]);



        ProductTypeModel::create([
            'product_id' => 21,
            'sub_product_name' => 'Term Loan (Non-asset Backed)',
            'trading_time' => 10,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 20000,
            'max_loan_amount' => 150000,
            'annual_income' => 360000,
            'credit_score' => 300,
            'property_owner' => 'No',
            'negative_days' => 5,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' =>  json_encode(['Real Estate', 'Property Management', 'Gas Stations', 'Recycling Services', 'Pool Contractors & Maintenance', 'Solar Panel Sales & Installation;', 'Agricultural Businesses', 'Staffing Agencies']),
        ]);


        ProductTypeModel::create([
            'product_id' => 22,
            'sub_product_name' => 'Term Loan',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 100000,
            'annual_income' => 84000,
            'credit_score' => null,
            'property_owner' => 'No',
            'negative_days' => 5,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' =>  null,
        ]);

        ProductTypeModel::create([
            'product_id' => 23,
            'sub_product_name' => 'Term Loan',
            'trading_time' => 3,
            'GST_registration' => 'No',
            'gst_time' => 0,
            'min_loan_amount' => 5000,
            'max_loan_amount' => 100000,
            'annual_income' => 120000,
            'credit_score' => 200,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 8,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' =>  json_encode(['Commercial/Residential Builders ', 'Used Car Dealerships & Wholesalers',]),
        ]);

        ProductTypeModel::create([
            'product_id' => 24,
            'sub_product_name' => 'Term Loan',
            'trading_time' => 6,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 20000,
            'max_loan_amount' => 500000,
            'annual_income' => 240000,
            'credit_score' => 350,
            'property_owner' => 'No',
            'negative_days' => 10,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' =>  null,
        ]);


        ProductTypeModel::create([
            'product_id' => 25,
            'sub_product_name' => 'Term Loan',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 20000,
            'max_loan_amount' => 250000,
            'annual_income' => 500000,
            'credit_score' => 600,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => 0,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' =>  json_encode(['Construction and Transport', 'Postal', 'Warehousing',]),
        ]);


        ProductTypeModel::create([
            'product_id' => 26,
            'sub_product_name' => 'Business Loan (Property Backed)',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 12,
            'min_loan_amount' => 25000,
            'max_loan_amount' => 500000,
            'annual_income' => 0,
            'credit_score' => 450,
            'property_owner' => 'Yes',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 26,
            'sub_product_name' => 'Business Loan (Non-property backed)',
            'trading_time' => 24,
            'GST_registration' => 'Yes',
            'gst_time' => 24,
            'min_loan_amount' => 25000,
            'max_loan_amount' => 500000,
            'annual_income' => 0,
            'credit_score' => 450,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);

        ProductTypeModel::create([
            'product_id' => 27,
            'sub_product_name' => 'Line of Credit',
            'trading_time' => 12,
            'GST_registration' => 'Yes',
            'gst_time' => 0,
            'min_loan_amount' => 50000,
            'max_loan_amount' => 250000,
            'annual_income' => 500000,
            'credit_score' => 450,
            'property_owner' => 'No',
            'negative_days' => null,
            'number_of_dishonours' => null,
            'deleted_flag' => 0,
            'interest_rate' => null,
            'restricted_industry' => null,
        ]);
    }
}
