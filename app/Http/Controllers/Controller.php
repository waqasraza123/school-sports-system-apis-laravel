<?php

namespace App\Http\Controllers;
use App\School;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected $schoolId;
    public function __construct()
    {
        if (Auth::check()){
            $this->schoolId = Auth::user()->school_id;
            $currentSchool = School::find($this->schoolId);
            View::share(['school_id' => $this->schoolId, 'currentSchool' => $currentSchool]);
        }
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
