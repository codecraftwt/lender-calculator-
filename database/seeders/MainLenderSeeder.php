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

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Shift',
                'lender_logo'            => 'shift.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'LUMI',
                'lender_logo'            => 'lumi.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Moula',
                'lender_logo'            => 'moula.png',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Propsa',
                'lender_logo'            => 'propsa.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'On Deck',
                'lender_logo'            => 'on_deck.png',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'ScotPac(Boost Business)',
                'lender_logo'            => 'boost_business.png',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Finance One',
                'lender_logo'            => 'finance_one.png',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'BiGGa',
                'lender_logo'            => 'bigga.png',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Bizcap LOC',
                'lender_logo'            => 'bizcap_loc.png',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Bizcap',
                'lender_logo'            => 'bizcaploc.png',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Capify',
                'lender_logo'            => 'capify.png',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Trucap',
                'lender_logo'            => 'trucap.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Skyecap',
                'lender_logo'            => 'Skyecap.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Bizfund',
                'lender_logo'            => 'bizfund.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Rapital',
                'lender_logo'            => 'rapital.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Funds now',
                'lender_logo'            => 'funds_now.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Banjo Business Loan Express',
                'lender_logo'            => 'Banjo_Business_Loan_Express.png',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'MONEYTECH',
                'lender_logo'            => 'moneytech.png',


            ]
        );
    }
}
