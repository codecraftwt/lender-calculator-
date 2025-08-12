<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LenderContactsModel;

class LenderContactsSeeder extends Seeder
{
    public function run()
    {
        LenderContactsModel::insert([
            [
                'lender_id' => 1,
                'contact_type' => 'NSW',
                'name' => 'Stewart Hickey',
                'email' => 'stewart.hickey@dynamoney.com',
                'mobile_number' => '0432 968 138',
                'title' => 'Senior Partner | Head of Commercial NSW',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 1,
                'contact_type' => 'NSW',
                'name' => 'Caitie McCann',
                'email' => 'caitiem@dynamoney.com',
                'mobile_number' => '0480 039 366',
                'title' => 'Business Development Manager - NSW',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 1,
                'contact_type' => 'NSW',
                'name' => 'Matt Nicolopoulos',
                'email' => 'matthewn@dynamoney.com',
                'mobile_number' => '0480 039 500',
                'title' => 'Business Development Manager - NSW',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 1,
                'contact_type' => 'NSW',
                'name' => 'Elaine Song',
                'email' => 'elaines@dynamoney.com',
                'mobile_number' => '0480 039 368',
                'title' => 'Business Development Manager - NSW',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 1,
                'contact_type' => 'QLD',
                'name' => 'Caleb Gunn',
                'email' => 'caleb.gunn@dynamoney.com',
                'mobile_number' => '0432 964 611',
                'title' => 'Senior Partner | Head of Commercial QLD',
                'deleted_flag' => 0,
                'state'  => 'Queensland'
            ],
            [
                'lender_id' => 1,
                'contact_type' => 'QLD',
                'name' => 'Ellis Curran',
                'email' => 'ellisc@dynamoney.com',
                'mobile_number' => '0459 457 297',
                'title' => 'Business Development Manager - QLD',
                'deleted_flag' => 0,
                'state'  => 'Queensland'

            ],
            [
                'lender_id' => 1,
                'contact_type' => 'QLD',
                'name' => 'Bradley Richter',
                'email' => 'bradley.richter@dynamoney.com',
                'mobile_number' => '0432 955 779',
                'title' => 'Business Development Manager - QLD',
                'deleted_flag' => 0,
                'state'  => 'Queensland'

            ],
            [
                'lender_id' => 1,
                'contact_type' => 'VIC & TAS',
                'name' => 'Chanel Coombs',
                'email' => 'chanelc@dynamoney.com',
                'mobile_number' => '0484 790 456',
                'title' => 'Senior Partner | Head of Commercial VIC/TAS',
                'deleted_flag' => 0,
                'state'  => 'Victoria/Tasmania'

            ],
            [
                'lender_id' => 1,
                'contact_type' => 'VIC & TAS',
                'name' => 'Stephen Davis',
                'email' => 'stephend@dynamoney.com',
                'mobile_number' => '0460 747 627',
                'title' => 'Business Development Manager - VIC',
                'deleted_flag' => 0,
                'state'  => 'Victoria/Tasmania'

            ],
            [
                'lender_id' => 1,
                'contact_type' => 'VIC & TAS',
                'name' => 'Wayne Feng',
                'email' => 'waynef@dynamoney.com',
                'mobile_number' => '0474 444 878',
                'title' => 'Business Development Manager - VIC',
                'deleted_flag' => 0,
                'state'  => 'Victoria/Tasmania'

            ],

            [
                'lender_id' => 1,
                'contact_type' => 'SA & WA',
                'name' => 'Sierina Franklin',
                'email' => 'sierinaf@dynamoney.com',
                'mobile_number' => '0460 892 035',
                'title' => 'Business Development Manager – SA & WA',
                'deleted_flag' => 0,
                'state'  => 'South Australia / Western Australia'

            ],

            // Lumi contacts

            [
                'lender_id' => 3,
                'contact_type' => '',
                'name' => 'Stephen Lew',
                'email' => 'stephen.lew@lumi.com.au',
                'mobile_number' => '',
                'title' => 'BDM – Nationwide',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 3,
                'contact_type' => '',
                'name' => 'Trent Mackie',
                'email' => 'trent.mackie@lumi.com.au',
                'mobile_number' => '',
                'title' => 'BDM – National',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 3,
                'contact_type' => '',
                'name' => 'James Allen',
                'email' => 'james.allen@lumi.com.au',
                'mobile_number' => '0482 072 068',
                'title' => 'Sales Team Lead – Broker Accounts',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 3,
                'contact_type' => '',
                'name' => 'John Clifford',
                'email' => 'john.clifford@lumi.com.au',
                'mobile_number' => '0415 427 695',
                'title' => 'Head of Broker',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 3,
                'contact_type' => '',
                'name' => 'Marc Bianco',
                'email' => 'mark.bianco@lumi.com.au',
                'mobile_number' => '0482 093 924',
                'title' => '',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 3,
                'contact_type' => 'NSW',
                'name' => 'Moneer Husari',
                'email' => 'moneer.husari@lumi.com.au',
                'mobile_number' => '0420 506 530',
                'title' => 'Senior BDM - NSW',
                'deleted_flag' => 0,
                'state'  => 'New South Wales',

            ],
            [
                'lender_id' => 3,
                'contact_type' => 'NSW & ACT',
                'name' => 'Mike Domjen',
                'email' => 'mike.domjen@lumi.com.au',
                'mobile_number' => '0477 573 377',
                'title' => 'BDM – NSW & ACT',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 3,
                'contact_type' => 'NSW & ACT',
                'name' => 'Albert Challita',
                'email' => 'albert.challita@lumi.com.au',
                'mobile_number' => '0482 078 255',
                'title' => 'BDM – NSW & ACT',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 3,
                'contact_type' => 'QLD/SA/WA',
                'name' => 'Graeme Bennett',
                'email' => 'graeme.bennett@lumi.com.au',
                'mobile_number' => '',
                'title' => 'BDM – QLD/SA/WA',
                'deleted_flag' => 0,
                'state'  => 'QueensLand / South Australia / Western Australia'
            ],
            [
                'lender_id' => 3,
                'contact_type' => 'VIC/TAS/SA',
                'name' => 'Reid Davidson',
                'email' => 'reid.davidson@lumi.com.au',
                'mobile_number' => '',
                'title' => 'BDM – VIC/TAS/SA',
                'deleted_flag' => 0,
                'state'  => 'Victoria / Tasmania'
            ],
            [
                'lender_id' => 3,
                'contact_type' => 'VIC/TAS/SA',
                'name' => 'Marko Milutinovic',
                'email' => 'marko.milutinovic@lumi.com.au',
                'mobile_number' => '',
                'title' => 'BDM – VIC/TAS/SA',
                'deleted_flag' => 0,
                'state'  => 'Victoria / Tasmania'
            ],
            [
                'lender_id' => 3,
                'contact_type' => 'VIC',
                'name' => 'Jake Pianta',
                'email' => 'jake.pianta@lumi.com.au',
                'mobile_number' => '',
                'title' => 'BDM – VIC',
                'deleted_flag' => 0,
                'state'  => 'Victoria / Tasmania'
            ],


            [
                'lender_id' => 18,
                'contact_type' => 'NSW',
                'name' => 'Sahl Jappie',
                'email' => 'sjappie@banjoloans.com',
                'mobile_number' => '0477 893 411',
                'title' => 'Business Development Manager - NSW',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'

            ],
            [
                'lender_id' => 18,
                'contact_type' => 'NSW',
                'name' => 'Samantha McPherson',
                'email' => 'smcpherson@banjoloans.com',
                'mobile_number' => '0428 628 765',
                'title' => 'Business Development Manager - NSW',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 18,
                'contact_type' => 'NSW',
                'name' => 'Joe Purcell',
                'email' => 'jpurcell@banjoloans.com',
                'mobile_number' => '0466 778 998',
                'title' => 'Business Development Manager - NSW',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 18,
                'contact_type' => 'NSW',
                'name' => 'Haifa Sameer',
                'email' => 'hsameer@banjoloans.com',
                'mobile_number' => '0411 326 245',
                'title' => 'Direct Business Development Manager',
                'deleted_flag' => 0,
                'state'  => 'New South Wales'
            ],
            [
                'lender_id' => 18,
                'contact_type' => 'VIC/TAS/SA',
                'name' => 'Jason Gatt',
                'email' => 'jgatt@banjoloans.com',
                'mobile_number' => '0434 019 725',
                'title' => 'Southern Region Sales Manager',
                'deleted_flag' => 0,
                'state'  => 'Victoria / Tasmania / South Australia'
            ],
            [
                'lender_id' => 18,
                'contact_type' => 'VIC',
                'name' => 'Steven Dang',
                'email' => 'sdang@banjoloans.com',
                'mobile_number' => '0493 576 991',
                'title' => 'Business Development Manager - VIC',
                'deleted_flag' => 0,
                'state'  => 'Victoria / Tasmania / South Australia'
            ],
            [
                'lender_id' => 18,
                'contact_type' => 'VIC/SA/TAS',
                'name' => 'Vel Markovic',
                'email' => 'vmarkovic@banjoloans.com',
                'mobile_number' => '0493 371 194',
                'title' => 'Business Development Manager - VIC/SA/TAS',
                'deleted_flag' => 0,
                'state'  => 'Victoria / Tasmania / South Australia'
            ],
            [
                'lender_id' => 18,
                'contact_type' => 'QLD',
                'name' => 'Steven Kent',
                'email' => 'skent@banjoloans.com',
                'mobile_number' => '0433 075 561',
                'title' => 'Business Development Manager - QLD',
                'deleted_flag' => 0,
                'state'  => 'Queensland'
            ],
            [
                'lender_id' => 18,
                'contact_type' => 'WA',
                'name' => 'Simon O\'Leary',
                'email' => 'soleary@banjoloans.com',
                'mobile_number' => '0422 867 909',
                'title' => 'Business Development Manager - WA',
                'deleted_flag' => 0,
                'state'  => 'Western Australia'
            ],


            [
                'lender_id' => 9,
                'contact_type' => '',
                'name' => 'Ervin Robovic',
                'email' => 'ervinr@biigga.au',
                'mobile_number' => '0497 357 354',
                'title' => 'Business Development Manager',
                'deleted_flag' => 0,
                'state' => null
            ],


            // bizcap
            [
                'lender_id' => 11,
                'contact_type' => '',
                'name' => 'Issac Garson',
                'email' => 'igarson@bizcap.com.au',
                'mobile_number' => '0420 234 805',
                'title' => 'Senior Business Development Manager',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 11,
                'contact_type' => '',
                'name' => 'Nathan Evans',
                'email' => 'nevans@bizcap.com.au',
                'mobile_number' => '0438 461 710',
                'title' => 'Senior Business Development Manager',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 11,
                'contact_type' => '',
                'name' => 'Mendy Ash',
                'email' => 'mash@bizcap.com.au',
                'mobile_number' => '0483 916 858',
                'title' => 'Senior Business Development Manager',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 11,
                'contact_type' => '',
                'name' => 'Queenie Jiang',
                'email' => 'qjiang@bizcap.com.au',
                'mobile_number' => '0485 878 364',
                'title' => 'Broker Relationships - Manager',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 11,
                'contact_type' => '',
                'name' => 'Clarisa Sylviana',
                'email' => 'csylviana@bizcap.com.au',
                'mobile_number' => '0483 914 151',
                'title' => 'Broker Relationship Specialist',
                'deleted_flag' => 0,
                'state' => null
            ],

            [
                'lender_id' => 15,
                'contact_type' => '',
                'name' => 'Mick Burill',
                'email' => 'mick@bizfund.com.au',
                'mobile_number' => '0433 182 449',
                'title' => 'Sales Manager',
                'deleted_flag' => 0,
                'state' => null
            ],


            // capify

            [
                'lender_id' => 12,
                'contact_type' => '',
                'name' => 'Danijel Trifkovic',
                'email' => 'dtrifkovic@capify.com.au',
                'mobile_number' => '0482 096 691',
                'title' => 'Business Development Manager – NSW, QLD & ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales / Queensland / Australian Capital Territory'
            ],
            [
                'lender_id' => 12,
                'contact_type' => '',
                'name' => 'James Ruddick',
                'email' => 'jruddick@capify.com.au',
                'mobile_number' => '0433 604 876',
                'title' => 'Business Development Manager – VIC, TAS, SA & WA',
                'deleted_flag' => 0,
                'state' => null

            ],
            [
                'lender_id' => 12,
                'contact_type' => '',
                'name' => 'Ziad Amin',
                'email' => 'zamin@capify.com.au',
                'mobile_number' => '0482 089 027',
                'title' => 'Senior Business Development Manager – NSW, QLD & ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales / Queensland / Australian Capital Territory'
            ],
            [
                'lender_id' => 12,
                'contact_type' => '',
                'name' => 'Leinnor Reyes',
                'email' => 'lreyes@capify.com.au',
                'mobile_number' => '0482 085 987',
                'title' => 'Business Development Manager – NSW, QLD & ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales / Queensland / Australian Capital Territory'
            ],
            [
                'lender_id' => 12,
                'contact_type' => '',
                'name' => 'Carlo Aoun',
                'email' => 'caoun@capify.com.au',
                'mobile_number' => '0482 095 957',
                'title' => 'Business Development Manager',
                'deleted_flag' => 0,
                'state' => null
            ],

            [
                'lender_id' => 8,
                'contact_type' => '',
                'name' => 'Jeff Fiteni',
                'email' => 'jeff.fiteni@financeone.com.au',
                'mobile_number' => '0400 782 820',
                'title' => 'National BDM Manager',
                'deleted_flag' => 0,
                'state' => null
            ],

            // finance one
            [
                'lender_id' => 8,
                'contact_type' => 'NSW, ACT',
                'name' => 'Kiran Nair',
                'email' => 'kiran.nair@financeone.com.au',
                'mobile_number' => '0476 902 871',
                'title' => 'BDM – NSW, ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales'
            ],
            [
                'lender_id' => 8,
                'contact_type' => 'NSW',
                'name' => 'Karan Sharma',
                'email' => 'karan.sharma@financeone.com.au',
                'mobile_number' => '0437 628 778',
                'title' => 'BDM – NSW',
                'deleted_flag' => 0,
                'state' => 'New South Wales'
            ],
            [
                'lender_id' => 8,
                'contact_type' => 'NSW',
                'name' => 'Kyle Bowe',
                'email' => 'kyle.bowe@financeone.com.au',
                'mobile_number' => '0447 226 833',
                'title' => 'BDM – NSW',
                'deleted_flag' => 0,
                'state' => 'New South Wales'
            ],
            [
                'lender_id' => 8,
                'contact_type' => 'QLD North',
                'name' => 'Sarah Bauer',
                'email' => 'sarah.bauer@financeone.com.au',
                'mobile_number' => '0419 943 461',
                'title' => 'BDM – QLD North',
                'deleted_flag' => 0,
                'state' => 'Queensland / Western Australia'
            ],
            [
                'lender_id' => 8,
                'contact_type' => 'QLD South',
                'name' => 'David Munn',
                'email' => 'david.munn@financeone.com.au',
                'mobile_number' => '0428 274 762',
                'title' => 'BDM – QLD South',
                'deleted_flag' => 0,
                'state' => 'Queensland / Western Australia'
            ],
            [
                'lender_id' => 8,
                'contact_type' => 'QLD & WA',
                'name' => 'Cameron Layfield',
                'email' => 'cameron.layfield@financeone.com.au',
                'mobile_number' => '0460 556 568',
                'title' => 'BDM – QLD & WA',
                'deleted_flag' => 0,
                'state' => 'Queensland / Western Australia'
            ],
            [
                'lender_id' => 8,
                'contact_type' => 'VIC & TAS',
                'name' => 'Nicholas Lazarus',
                'email' => 'nicholas.lazarus@financeone.com.au',
                'mobile_number' => '0488 208 060',
                'title' => 'BDM – VIC & TAS',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia'
            ],
            [
                'lender_id' => 8,
                'contact_type' => 'SA & VIC',
                'name' => 'Melissa Romeo',
                'email' => 'melissa.romeo@financeone.com.au',
                'mobile_number' => '0428 870 297',
                'title' => 'BDM – SA & VIC',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia'
            ],
            [
                'lender_id' => 8,
                'contact_type' => 'VIC & SA',
                'name' => 'Rebekah Beale',
                'email' => 'rebekah.beale@financeone.com.au',
                'mobile_number' => '0418 307 904',
                'title' => 'BDM – VIC & SA',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia'
            ],


            // funds now

            [
                'lender_id' => 17,
                'contact_type' => '',
                'name' => 'Jack Shultz',
                'email' => 'jack@fundsnow.com.au',
                'mobile_number' => '0490 784 834',
                'title' => 'Business Development Manager',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 17,
                'contact_type' => '',
                'name' => 'Luke Sylvester',
                'email' => 'luke@fundsnow.com.au',
                'mobile_number' => '',
                'title' => '',
                'deleted_flag' => 0,
                'state' => null
            ],

            // moneytech

            [
                'lender_id' => 19,
                'contact_type' => '',
                'name' => 'Steven Godwin',
                'email' => 'steven.godwin@moneytech.com.au',
                'mobile_number' => '0432 300 686',
                'title' => 'National Sales Manager - Small Business',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 19,
                'contact_type' => '',
                'name' => 'Mariana Garcia',
                'email' => 'mariana.garcia@moneytech.com.au',
                'mobile_number' => '0405 078 004',
                'title' => 'BDM - Small Business NSW',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 19,
                'contact_type' => '',
                'name' => 'James Excell',
                'email' => 'james.excell@moneytech.com.au',
                'mobile_number' => '0414 640 715',
                'title' => 'BDM - Small Business VIC, TAS & SA',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 19,
                'contact_type' => '',
                'name' => 'Mahalia Fagan',
                'email' => 'mahalia.fagan@moneytech.com.au',
                'mobile_number' => '0423 860 410',
                'title' => 'BDM - Small Business QLD & WA',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 19,
                'contact_type' => '',
                'name' => 'Mandela Opuku',
                'email' => 'mandela.opuku@moneytech.com.au',
                'mobile_number' => '0491 221 271',
                'title' => 'BDM',
                'deleted_flag' => 0,
                'state' => null
            ],


            // Moula

            [
                'lender_id' => 4,
                'contact_type' => '',
                'name' => 'Sam Sfeir',
                'email' => 'sam.sfeir@moula.com.au',
                'mobile_number' => '0448 253 430',
                'title' => 'Head of Sales',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 4,
                'contact_type' => '',
                'name' => 'Linette Laverdure',
                'email' => 'linette.laverdure@moula.com.au',
                'mobile_number' => '0447 789 482',
                'title' => 'Regional Sales Manager - VIC, SA, TAS & WA',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 4,
                'contact_type' => '',
                'name' => 'Peter Cutuli',
                'email' => 'peter.cutuli@moula.com.au',
                'mobile_number' => '0419 675 792',
                'title' => 'Regional Sales Manager - NSW, ACT & QLD',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 4,
                'contact_type' => '',
                'name' => 'Nicholas Lim',
                'email' => 'nicholas.lim@moula.com.au',
                'mobile_number' => '0418 276 391',
                'title' => 'BDM - VIC & TAS',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 4,
                'contact_type' => '',
                'name' => 'Sam Brant',
                'email' => 'sam.brant@moula.com.au',
                'mobile_number' => '0498 073 583',
                'title' => 'BDM - QLD',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 4,
                'contact_type' => '',
                'name' => 'Gillian Paton',
                'email' => 'gillian.paton@moula.com.au',
                'mobile_number' => '0457 090 612',
                'title' => 'BDM - SA & WA',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 4,
                'contact_type' => '',
                'name' => 'Miriam Portela',
                'email' => 'miriam.portela@moula.com.au',
                'mobile_number' => '0429 185 386',
                'title' => 'BDM - NSW',
                'deleted_flag' => 0,
                'state' => null
            ],

            // ondeck

            [
                'lender_id' => 6,
                'contact_type' => '',
                'name' => 'Nick Reily',
                'email' => 'nreily@ondeck.com.au',
                'mobile_number' => '',
                'title' => 'Head of Partnerships',
                'deleted_flag' => 0,
                'state' => null

            ],
            [
                'lender_id' => 6,
                'contact_type' => '',
                'name' => 'William Purcell',
                'email' => 'wpurcell@ondeck.com.au',
                'mobile_number' => '0482 094 050',
                'title' => 'BDM - NSW, ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales / Australian Capital Territory',
            ],
            [
                'lender_id' => 6,
                'contact_type' => '',
                'name' => 'Nada Abousaada',
                'email' => 'nabousaada@ondeck.com.au',
                'mobile_number' => '0481 609 110',
                'title' => 'BDM - NSW, ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales / Australian Capital Territory'
            ],
            [
                'lender_id' => 6,
                'contact_type' => '',
                'name' => 'Hugo Thomas',
                'email' => 'hthomas@ondeck.com.au',
                'mobile_number' => '0480 095 589',
                'title' => 'BDM - NSW, ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales / Australian Capital Territory'
            ],
            [
                'lender_id' => 6,
                'contact_type' => '',
                'name' => 'Connor O\'Shea',
                'email' => 'coshea@ondeck.com.au',
                'mobile_number' => '0483 980 889',
                'title' => 'BDM - VIC, SA, WA, TAS',
                'deleted_flag' => 0,
                'state' => 'Victoria / South Australia / Western Australia / Tasmania'
            ],
            [
                'lender_id' => 6,
                'contact_type' => '',
                'name' => 'Patrick Tagg',
                'email' => 'ptagg@ondeck.com.au',
                'mobile_number' => '0483 928 717',
                'title' => 'BDM - VIC, SA, WA, TAS',
                'deleted_flag' => 0,
                'state' => 'Victoria / South Australia / Western Australia / Tasmania'
            ],
            [
                'lender_id' => 6,
                'contact_type' => '',
                'name' => 'Shaun Andrews',
                'email' => 'sandrews@ondeck.com.au',
                'mobile_number' => '0489 088 735',
                'title' => 'BDM - QLD, NT',
                'deleted_flag' => 0,
                'state' => null
            ],

            // Propsa

            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Roberto Sanz',
                'email' => 'roberto.s@prospa.com',
                'mobile_number' => '',
                'title' => 'General Manager of Sales & Partnerships',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Paul Evans',
                'email' => 'paul.evans@prospa.com',
                'mobile_number' => '',
                'title' => 'National Sales Manager',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Ben Howell',
                'email' => 'ben.h@prospa.com',
                'mobile_number' => '',
                'title' => 'Senior BDM - NSW/ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales / Australian Capital Territory'
            ],
            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Mitchell Smith',
                'email' => 'mitchell.smith@prospa.com',
                'mobile_number' => '',
                'title' => 'BDM - NSW/ACT',
                'deleted_flag' => 0,
                'state' => 'New South Wales / Australian Capital Territory'
            ],
            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Jaime Aplin',
                'email' => 'jaime.aplin@prospa.com',
                'mobile_number' => '0402 007 225',
                'title' => 'Senior BDM - SA/NT',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Karl Lawrence',
                'email' => 'karl.lawrence@prospa.com',
                'mobile_number' => '',
                'title' => 'BDM - VIC/TAS',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania'
            ],
            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Pete Birrell',
                'email' => 'pete.birrell@prospa.com',
                'mobile_number' => '0415 126 128',
                'title' => 'BDM - VIC/TAS',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania'
            ],
            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Anna Davis',
                'email' => 'anna.davis@prospa.com',
                'mobile_number' => '',
                'title' => 'BDM - QLD',
                'deleted_flag' => 0,
                'state' => 'Queensland'


            ],
            [
                'lender_id' => 5,
                'contact_type' => '',
                'name' => 'Jacob Pickering',
                'email' => 'jacob.pickering@prospa.com',
                'mobile_number' => '',
                'title' => 'BDM - QLD',
                'deleted_flag' => 0,
                'state' => 'Queensland'

            ],

            // scotpac 

            [
                'lender_id' => 7,
                'contact_type' => '',
                'name' => 'Benjamin Moore',
                'email' => 'mooreb@scotpac.com.au',
                'mobile_number' => '0426 992 663',
                'title' => 'BDM',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 7,
                'contact_type' => '',
                'name' => 'Daniel La Cognata',
                'email' => 'lacognatad@scotpac.com.au',
                'mobile_number' => '0413 366 355',
                'title' => 'Head of Sales - Business Lending',
                'deleted_flag' => 0,
                'state' => null
            ],


            // shift

            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Andrew Wagg',
                'email' => 'andrew.wagg@shift.com.au',
                'mobile_number' => '',
                'title' => 'Head of Broker Sales',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Marie Boyagi',
                'email' => 'marie.boyagi@shift.com.au',
                'mobile_number' => '',
                'title' => 'National Manager, Strategic Partnerships',
                'deleted_flag' => 0,
                'state' => null
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Vasa Eleninovski',
                'email' => 'vasa.eleninovski@shift.com.au',
                'mobile_number' => '0413 454 125',
                'title' => 'State Manager - NSW',
                'deleted_flag' => 0,
                'state' => 'New South Wales',

            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Emilija Grubisic',
                'email' => 'emilija.grubisic@shift.com.au',
                'mobile_number' => '0455 180 013',
                'title' => 'BDM - NSW',
                'deleted_flag' => 0,
                'state' => 'New South Wales',

            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Katherine Valderrama',
                'email' => 'katherine.valderrama@shift.com.au',
                'mobile_number' => '0497 163 300',
                'title' => 'BDM - NSW',
                'deleted_flag' => 0,
                'state' => 'New South Wales',

            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Simon Winters',
                'email' => 'simon.winters@shift.com.au',
                'mobile_number' => '0473 061 282',
                'title' => 'State Manager - QLD',
                'deleted_flag' => 0,
                'state' => 'Queensland / Northern Territory ',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Joshua Pickering',
                'email' => 'joshua.pickering@shift.com.au',
                'mobile_number' => '0417 909 260',
                'title' => 'BDM - QLD',
                'deleted_flag' => 0,
                'state' => 'Queensland / Northern Territory ',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Montana Tym',
                'email' => 'montana.tym@shift.com.au',
                'mobile_number' => '0488 844 033',
                'title' => 'BDM - QLD/NT',
                'deleted_flag' => 0,
                'state' => 'Queensland / Northern Territory ',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Matthew Schofield',
                'email' => 'matthew.schofield@shift.com.au',
                'mobile_number' => '0424 246 653',
                'title' => 'State Manager - VIC',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Darren Gibson',
                'email' => 'darren.gibson@shift.com.au',
                'mobile_number' => '0414 373 907',
                'title' => 'BDM - VIC/SA',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Frank Palamara',
                'email' => 'frank.palamara@shift.com.au',
                'mobile_number' => '0481 992 508',
                'title' => 'BDM - VIC/TAS',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Steven Camilleri',
                'email' => 'steven.camilleri@shift.com.au',
                'mobile_number' => '0493 108 368',
                'title' => 'BDM - VIC/TAS',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Tashnia Rahman',
                'email' => 'tashnia.rahman@shift.com.au',
                'mobile_number' => '0434 117 814',
                'title' => 'BDM - VIC',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Thomas Banner',
                'email' => 'thomas.banner@shift.com.au',
                'mobile_number' => '0480 040 846',
                'title' => 'BDM - VIC',
                'deleted_flag' => 0,
                'state' => 'Victoria / Tasmania / South Australia',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Geraldine Brabazon',
                'email' => 'geraldine.brabazon@shift.com.au',
                'mobile_number' => '0412 946 050',
                'title' => 'State Manager - WA',
                'deleted_flag' => 0,
                'state' => 'Western Australia',
            ],
            [
                'lender_id' => 2,
                'contact_type' => '',
                'name' => 'Mark Worthington',
                'email' => 'mark.worthington@shift.com.au',
                'mobile_number' => '0432 054 190',
                'title' => 'BDM - WA',
                'deleted_flag' => 0,
                'state' => 'Western Australia',
            ],


            // trucap

            [
                'lender_id' => 13,
                'contact_type' => '',
                'name' => 'Matthew Marquez',
                'email' => 'matthew@trucap.com.au',
                'mobile_number' => '0426 513 618',
                'title' => 'Business Development Manager',
                'deleted_flag' => 0,
                'state' => null
            ],


        ]);
    }
}
