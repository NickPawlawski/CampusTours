<?php

use Illuminate\Database\Seeder;

class LinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Links::insert([
            ['name'=>'main campus tour',
             'link'=>'https://wmich.edu/admissions/freshmen/visit',
             'description'=>'Schedule a Tour of the Main Campus',
             'active'=>1],[
            'name'=>'gaming at wmu',
            'link'=>'http://www.mlive.com/news/kalamazoo/index.ssf/2018/01/western_michigan_to_fund_espor.html',
            'description'=>'Western funds e-sports center. Check it out',
            'active'=>1
             ]
        ]);
    }
}
