<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\School;
use App\Social;
use App\Season;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

    /**
     * create the admin user
     */
    public function createAdmin(){

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
