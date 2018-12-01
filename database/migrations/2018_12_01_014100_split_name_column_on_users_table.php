<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SplitNameColumnOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('name');
            $table->string('last_name')->after('first_name');
        });

        $users = App\User::all();

        foreach($users as $user) {
            $user->update([
                'first_name' => explode(' ', $user->name)[0],
                'last_name' => explode(' ', $user->name)[1]
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('first_name');
        });

        $users = App\User::all();

        foreach($users as $user) {
            $user->update([
                'name' => implode(' ', [$user->first_name, $user->last_name]),
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
        });
    }
}
