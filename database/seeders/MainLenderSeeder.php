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
                'email'     => 'sales@dynamoney.com',
                'mobile_number'     => '1300 001 420',
                'website_url'  => 'www.dynamoney.com',
                'product_guide' => 'Dynamoney Business-Loans-Product-Guide-July.pdf',

            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Shift',
                'lender_logo'            => 'shift.png',
                'email'     => 'partners@shift.com.au',
                'mobile_number'     => '1300 249 649',
                'website_url'  => 'https://www.shift.com.au/',
                'product_guide' => 'https://www.shift.com.au/product-guide/',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'LUMI',
                'lender_logo'            => 'lumi.png',
                'email'     => 'sales@lumi.com.au',
                'mobile_number'     => '1300 015 864',
                'website_url'  => 'www.lumi.com.au',
                'product_guide' => 'Lumi Pricing Guide November 2024.pdf',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Moula',
                'lender_logo'            => 'moula.webp',
                'email'     => 'partners@moula.com.au',
                'mobile_number'     => '1300 880 972',
                'website_url'  => 'moula.com.au',
                'product_guide' => 'Moula-Product-Guide.pdf',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Propsa',
                'lender_logo'            => 'prospa.png',
                'email'     => 'partners@prospa.com',
                'mobile_number'     => '1300 964 808',
                'website_url'  => 'www.prospa.com',
                'product_guide' => 'Prospa Product Guide.pdf',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'On Deck',
                'lender_logo'            => 'on_deck.webp',
                'email'     => 'broker@ondeck.com.au',
                'mobile_number'     => '1800 676 652',
                'website_url'  => 'www.ondeck.com.au',
                'product_guide' => 'OnDeck Lending Criteria.pdf',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'ScotPac',
                'lender_logo'            => 'scotpac.png',
                'email'     => 'enquiries@businessfuel.com.au',
                'mobile_number'     => '1300 660 681',
                'website_url'  => 'businessfuel.com.au',
                'product_guide' => 'ScotPac-Solutions-eBook.pdf',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Finance One',
                'lender_logo'            => 'financeone.png',
                'email'     => 'brokers@financeone.com.au',
                'mobile_number'     => '(07) 4723 5044',
                'website_url'  => 'financeone.com.au',
                'product_guide' => 'Finance-One-Unsecured Product Guide.pdf',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'BiGGa',
                'lender_logo'            => 'biigga.png',
                'email'     => 'info@biigga.au',
                'mobile_number'     => '1300 472 663',
                'website_url'  => 'www.biigga.au',
                'product_guide' => 'BiiGGA Product Guide.pdf',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Bizcap LOC',
                'lender_logo'            => 'bizcap.png',
                'email'     => 'info@bizcap.com.au',
                'mobile_number'     => '1300 922 223',
                'website_url'  => 'www.bizcap.com.au',
                'product_guide' => 'Bizcap Cheat Sheet.pdf',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Bizcap',
                'lender_logo'            => 'bizcap.png',
                'email'     => 'info@bizcap.com.au',
                'mobile_number'     => '1300 922 223',
                'website_url'  => 'www.bizcap.com.au',
                'product_guide' => 'Bizcap Cheat Sheet.pdf',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Capify',
                'lender_logo'            => 'capify.png',
                'email'     => 'info@capify.com.au',
                'mobile_number'     => '1300 531 587',
                'website_url'  => 'www.capify.com.au',
                'product_guide' => 'Capify Broker Product Guide (March 2025).pdf',


            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Trucap',
                'lender_logo'            => 'trucap.png',
                'email'     => 'partner@trucap.com.au',
                'mobile_number'     => '1300 261 154',
                'website_url'  => 'www.trucap.com.au',
                'product_guide' => 'Trucap - Product Update 2025.pdf',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Skyecap',
                'lender_logo'            => 'skyecap.png',
                'email'     => ' partnerships@skyecap.com.au',
                'mobile_number'     => '1300 089 964',
                'website_url'  => 'skyecap.com.au',
                'product_guide' => 'Skyecap_Broker Cheat Sheet.png',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Bizfund',
                'lender_logo'            => 'bizfund.png',
                'email'     => 'info@bizfund.com.au',
                'mobile_number'     => '07 3521 5684',
                'website_url'  => 'www.bizfund.com.au',
                'product_guide' => 'Bizfund Broker Guidelines.pdf',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Rapital',
                'lender_logo'            => 'rapital.png',
                'email'     => 'rokers@gmail.rapital.com.au',
                'mobile_number'     => '1300 308 142',
                'website_url'  => 'rapital.com.au',
                'product_guide' => 'Rapital Broker Product Guide (March 2025).pdf',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Funds now',
                'lender_logo'            => 'funds_now.png',
                'email'     => 'applications@fundsnow.com.au',
                'mobile_number'     => '1300 183 359',
                'website_url'  => 'fundsnow.com.au',
                'product_guide' => 'https://www.shift.com.au/product-guide/',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'Banjo Business Loan Express',
                'lender_logo'            => 'banjo.png',
                'email'     => 'partners@banjoloans.com',
                'mobile_number'     => '1300 226 565',
                'website_url'  => 'www.banjoloans.com',
                'product_guide' => 'https://www.banjoloans.com/partners/solutions-hub/business-loan-pricing-matrix/',



            ]
        );
        MainLenderTable::create(
            [
                'lender_name'             => 'MONEYTECH',
                'lender_logo'            => 'moneytech.png',
                'email'     => 'broker@moneytech.com.au',
                'mobile_number'     => '1300 858 904',
                'website_url'  => 'www.moneytech.com.au',
                'product_guide' => 'Moneytech Product Guide.pdf',
            ]
        );
    }
}
