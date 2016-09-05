<?php

use App\LevelSport;
use App\Positions;
use App\Sport;
use App\Year;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        dd('ok');
        Sport::create(array('id' => 1, 'name' => 'Football'));
        Sport::create(array('id' => 2,'name' => 'Volleyball'));
        Sport::create(array('id' => 3,'name' => 'Tennis'));
        Sport::create(array('id' => 4,'name' => 'Cross Country'));
        Sport::create(array('id' => 5,'name' => 'Water Polo'));
        Sport::create(array('id' => 6,'name' => 'Cheer'));
        Sport::create(array('id' => 8,'name' => 'Boy\'s Basketball'));
        Sport::create(array('id' => 9,'name' => 'Girl\'s Basketball'));
        Sport::create(array('id' => 10,'name' => 'Boy\'s Soccer'));
        Sport::create(array('id' => 11,'name' => 'Girl\'s Soccer'));
        Sport::create(array('id' => 12,'name' => 'Girl\'s Water Polo'));

        Year::create(array('id' => 1,'name' => 'Freshman'));
        Year::create(array('id' => 2,'name' => 'Sophmore'));
        Year::create(array('id' => 3,'name' => 'Junior'));
        Year::create(array('id' => 4,'name' => 'Senior'));

        LevelSport::create(array('id' => 1,'name' => 'Varsity'));
        LevelSport::create(array('id' => 2,'name' => 'JV'));
        LevelSport::create(array('id' => 3,'name' => 'JV2'));
        LevelSport::create(array('id' => 4,'name' => 'Freshman'));

        $positions = array(
            array('id' => '2','name' => 'QB','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '3','name' => 'RB','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '4','name' => 'FB','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '5','name' => 'WR','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '6','name' => 'TE','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '7','name' => 'OL','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '8','name' => 'C','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '9','name' => 'G','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '10','name' => 'T','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '11','name' => 'DB','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '12','name' => 'FS','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '13','name' => 'SS','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '14','name' => 'CB','sport_id' => '1','created_at' => '2016-03-05 17:56:05','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '15','name' => 'LB','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '16','name' => 'ILB','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '17','name' => 'OLB','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '18','name' => 'DL','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '19','name' => 'DT','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '20','name' => 'NG','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '21','name' => 'DE','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '22','name' => 'PK','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '23','name' => 'LS','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '24','name' => 'K','sport_id' => '1','created_at' => '2016-03-06 05:09:20','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '25','name' => 'P','sport_id' => '1','created_at' => '2016-03-06 05:10:28','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '26','name' => 'PG','sport_id' => '8','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '27','name' => 'SG','sport_id' => '8','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '28','name' => 'G','sport_id' => '8','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '29','name' => 'PF','sport_id' => '8','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '30','name' => 'F','sport_id' => '8','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '31','name' => 'SF','sport_id' => '8','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '32','name' => 'C','sport_id' => '8','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '33','name' => 'PG','sport_id' => '9','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '34','name' => 'SG','sport_id' => '9','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '35','name' => 'G','sport_id' => '9','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '36','name' => 'F','sport_id' => '9','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '37','name' => 'PF','sport_id' => '9','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '38','name' => 'SF','sport_id' => '9','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '39','name' => 'C','sport_id' => '9','created_at' => '2016-03-06 05:15:07','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '40','name' => 'S','sport_id' => '2','created_at' => '2016-03-06 05:20:16','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '41','name' => 'OH','sport_id' => '2','created_at' => '2016-03-06 05:20:16','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '42','name' => 'MB','sport_id' => '2','created_at' => '2016-03-06 05:20:16','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '43','name' => 'OP','sport_id' => '2','created_at' => '2016-03-06 05:20:16','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '44','name' => 'DS','sport_id' => '2','created_at' => '2016-03-06 05:20:16','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '45','name' => 'L','sport_id' => '2','created_at' => '2016-03-06 05:20:16','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '46','name' => 'G','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '47','name' => 'G','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '48','name' => 'D','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '49','name' => 'D','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '50','name' => 'M','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '51','name' => 'M','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '52','name' => 'F','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '53','name' => 'F','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '54','name' => 'RB','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '55','name' => 'RB','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '56','name' => 'CB','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '57','name' => 'CB','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '58','name' => 'LB','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '59','name' => 'LB','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '60','name' => 'DM','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '61','name' => 'DM','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '62','name' => 'AM','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '63','name' => 'AM','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '64','name' => 'RM','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '65','name' => 'RM','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '66','name' => 'LM','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '67','name' => 'LM','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '68','name' => 'AT','sport_id' => '10','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '69','name' => 'AT','sport_id' => '11','created_at' => '2016-03-06 05:25:35','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '70','name' => NULL,'sport_id' => NULL,'created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '71','name' => 'D','sport_id' => '5','created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '72','name' => 'D','sport_id' => '12','created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '73','name' => '2MS','sport_id' => '5','created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '74','name' => '2MS','sport_id' => '12','created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '75','name' => '2MD','sport_id' => '5','created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '76','name' => '2MD','sport_id' => '12','created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '77','name' => 'G','sport_id' => '5','created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '78','name' => 'G','sport_id' => '12','created_at' => '2016-03-06 05:28:09','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '79','name' => 'SINGLES','sport_id' => '3','created_at' => '2016-03-06 05:30:27','updated_at' => '2008-10-04 07:59:52'),
            array('id' => '80','name' => 'DOUBLES','sport_id' => '3','created_at' => '2016-03-06 05:30:27','updated_at' => '2008-10-04 07:59:52')
        );
        foreach ($positions as $position)
        {
            Positions::create($position);
        }
    }
}
