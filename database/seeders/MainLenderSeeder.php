<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MainLenderTable;

class MainLenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MainLenderTable::create(
            [
                'lender_name'             => 'Dynamoney',
                'lender_logo'            => 'dynamoney.png',
                'GST_registration'     => 'Yes'
            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Shift',
                'lender_logo'            => 'shift.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'LUMI',
                'lender_logo'            => 'lumi.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Moula',
                'lender_logo'            => 'moula.png',
                'GST_registration'     => 'Yes'
            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Propsa',
                'lender_logo'            => 'propsa.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'On Deck',
                'lender_logo'            => 'on_deck.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Boost Business',
                'lender_logo'            => 'boost_business.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Finance One',
                'lender_logo'            => 'finance_one.png',
                'GST_registration'     => 'Yes'
            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Finance One Plus',
                'lender_logo'            => 'finance_one_plus.jpg',
                'GST_registration'     => 'Yes'
            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Bizcap LOC',
                'lender_logo'            => 'bizcap_loc.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Bizcap',
                'lender_logo'            => 'bizcaploc.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Capify',
                'lender_logo'            => 'capify.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Skyecap',
                'lender_logo'            => 'Skyecap.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Banjo Business Loan Express',
                'lender_logo'            => 'Banjo_Business_Loan_Express.png',
                'GST_registration'     => 'No'

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'MONEYTECH',
                'lender_logo'            => 'moneytech.png',
                'GST_registration'     => 'No'

            ]
        );
    }
}
