<?php

use Illuminate\Database\Seeder;

class table_branches extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('table_branches')->delete();

        $branchList = array(
            array(
                "branch_name" => "Yellow Fin Ecoland"
            ),
            array(
                "branch_name" => "Yellow Fin Torres"
            ),
            array(
                "branch_name" => "Yellow Fin Phoenix"
            ),
            array(
                "branch_name" => "Yellow Fin Commissary"
            ),
            array(
                "branch_name" => "Marina Tuna Ecoland"
            ),
            array(
                "branch_name" => "Cafe Tavera"
            ),
            array(
                "branch_name" => "BreadDelight Ponciano"
            ),
            array(
                "branch_name" => "BreadDelight Malvar"
            ),
            array(
                "branch_name" => "BreadDelight Skyline"
            ),
            array(
                "branch_name" => "BreadDelight Ilustre"
            ),
            array(
                "branch_name" => "BreadDelight Toril"
            ),
            array(
                "branch_name" => "BreadDelight Artiaga"
            ),
        );

        DB::table('table_branches')->insert($branchList);
    }
}
