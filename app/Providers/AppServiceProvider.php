<?php

namespace App\Providers;
use App\Role;
use App\SportsList;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\School;
use App\Social;
use App\Season;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->createAdmin();
        $this->addSports();
        $this->addRoles();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function addSports(){
        $sportsList = SportsList::all();

        //if table is empty insert the sports list
        if(!count($sportsList)){
            $data = SportsList::insert([
                [
                    'name' => 'Baseball',
                    'order_by' => 1,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Boy\'s Basketball',
                    'order_by' => 2,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Girl’s Basketball',
                    'order_by' => 3,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Cheer',
                    'order_by' => 4,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Cross Country',
                    'order_by' => 5,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Football',
                    'order_by' => 6,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Golf',
                    'order_by' => 7,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Boy’s Lacrosse',
                    'order_by' => 8,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Girl’s Lacrosse',
                    'order_by' => 9,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Boy’s Soccer',
                    'order_by' => 10,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Girl’s Soccer',
                    'order_by' => 11,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Softball',
                    'order_by' => 12,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Swimming',
                    'order_by' => 13,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Girl’s Tennis',
                    'order_by' => 14,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Boy’s Tennis',
                    'order_by' => 15,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Track & Field',
                    'order_by' => 16,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Boy’s Volleyball',
                    'order_by' => 17,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Girl’s Volleyball',
                    'order_by' => 18,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Boys Water Polo',
                    'order_by' => 19,
                    'icon' => 'url'
                ],
                [
                    'name' => 'Girl’s Water Polo',
                    'order_by' =>20,
                    'icon' => 'url'
                ]
            ]);
        }
    }

    /**
     * create the admin user
     */
    public function createAdmin(){

        if(Schema::hasTable('schools')){
            $school = School::firstOrCreate([
                'school_email' => 'admin@gmail.com',
                'name' => 'Admin',
                'school_logo' => 'https://lh3.googleusercontent.com/YGqr3CRLm45jMF8eM8eQxc1VSERDTyzkv1CIng0qjcenJZxqV5DBgH5xlRTawnqNPcOp=w300'

            ]);

            $user = User::firstOrCreate([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'school_id' => $school->id
            ]);

            $user->password = bcrypt('admin');
            $user->save();

            $seasons = Season::where('name', 'Fall')->first();
            $now = Carbon::now('utc')->toDateTimeString();
            if(!($seasons)){
                Season::insert([
                    ['name' => 'Fall', 'created_at' => $now, 'updated_at' => $now],
                    ['name' => 'Spring', 'created_at' => $now, 'updated_at' => $now],
                    ['name' => 'Winter', 'created_at' => $now, 'updated_at' => $now],
                ]);
            }
        }
    }

    /**
     * add user roles to db
     */
    public function addRoles(){

        $role = Role::all();

        if(!$role->first()){
            $role = Role::insert([
                [
                    'name' => 'super_admin',
                    'display_name' => 'Super Admin',
                    'description' => 'Can control all schools'
                ],
                [
                    'name' => 'admin',
                    'display_name' => 'Admin',
                    'description' => 'Can control all schools under him'
                ],
                [
                    'name' => 'editor',
                    'display_name' => 'Editor/Controller',
                    'description' => 'Can add/edit content to all schools under him'
                ]

            ]);
        }
    }
}
