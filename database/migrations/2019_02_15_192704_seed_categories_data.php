<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
                'name'        => 'java',
                'description' => 'write less,work more',
            ],
            [
                'name'        => 'php',
                'description' => 'the best language in the world',
            ],
            [
                'name'        => 'js',
                'description' => 'we can build everything',
            ],
            [
                'name'        => 'python',
                'description' => 'talk is cheap,show me the code',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('categories')->truncate();
    }
}
