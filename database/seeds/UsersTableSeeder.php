<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::firstOrCreate(['email' => 'admin@admin.com'], [
            'first_name' => 'admin',
            'last_name'  => 'admin',
            'email'      => 'admin@admin.com',
            'password'   => bcrypt('admin'),
        ]);

        $request_approver = \App\Models\User::firstOrCreate(['email' => 'requests@hg.com'], [
            'first_name' => 'requests',
            'last_name'  => 'hg',
            'email'      => 'requests@hg.com',
            'password'   => bcrypt('admin'),
        ]);

        $request_approver->assign('slack_approver');

        $request_approver->settings()->firstOrCreate([
            'key' => 'slack_hook',
        ],[
            'key' => 'slack_hook',
            'value' => 'asdasdasdasdas',
        ]);
    }
}
