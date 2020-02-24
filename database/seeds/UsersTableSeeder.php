<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Department;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Department::class, 15)->create();

        for ($i = 1; $i <= 10; $i++) {
            factory(User::class, 5000)->create();
            echo 'create 5000 users ... '.PHP_EOL;
        }

        User::where('id','<=',2)->update(['deep'=>0]);
        User::whereBetween('id',[3,1000])->update(['deep'=>1,'parent_id'=>User::where('deep', 0)->first()->id]);
        User::whereBetween('id',[1001,4000])->update(['deep'=>2,'parent_id'=>User::where('deep', 1)->first()->id]);
        User::whereBetween('id',[4001,5000])->update(['deep'=>3,'parent_id'=>User::where('deep', 2)->first()->id]);
        User::where('id','>',5001)->update(['deep'=>4,'parent_id'=>User::where('deep', 3)->first()->id]);

    }
}
