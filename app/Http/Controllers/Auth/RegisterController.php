<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EconomicActivity;
use App\Models\EconomicSector;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required_if:account_type,personal','string', 'max:255'],
            'last_name' => ['required_if:account_type,personal','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:255'],
            'document' => ['required', 'numeric'],
            'account_type' => ['required'],
            'business_name' => ['required_if:account_type,corporate','string', 'max:255'],
            'department' => ['required'],
            'province' => ['required'],
            'district' => ['required'],
            'direction' => ['required', 'string', 'max:255'],
            'name_legal_representative' => ['required_if:account_type,corporate','string', 'max:255'],
            'dni_legal_representative' => ['required_if:account_type,corporate','numeric'],
            'profession' => ['required_if:account_type,personal','string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => ( !isset($data['first_name']) ) ? null:$data['first_name'],
            'last_name' => ( !isset($data['last_name']) ) ? null:$data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'document' => $data['document'],
            'account_type' => ($data['account_type'] == 'personal') ? 'p':'b',
            'business_name' => ( !isset($data['business_name']) ) ? null:$data['business_name'],
            'department_id' => $data['department'],
            'province_id' => $data['province'],
            'district_id' => $data['district'],
            'direction' => $data['direction'],
            'name_legal_representative' => ( !isset($data['name_legal_representative']) ) ? null:$data['name_legal_representative'],
            'dni_legal_representative' => ( !isset($data['dni_legal_representative']) ) ? null:$data['dni_legal_representative'],
            'profession' => ( !isset($data['profession']) ) ? null:$data['profession'],
            'economic_activity_id' => ( !isset($data['economic_activity']) ) ? null:$data['economic_activity'],
            'economic_sector_id' => ( !isset($data['economic_sector']) ) ? null:$data['economic_sector'],
            'constitution_date' => ( !isset($data['constitution_date']) ) ? null:Carbon::createFromFormat('d/m/Y', $data['constitution_date']),
            'state_company' => (isset($data['state_company'])) ? 1:0,
        ]);
        $user->assignRole('user');
        return $user;
    }

    public function showRegistrationForm()
    {
        $departments = Department::all();
        $activities = EconomicActivity::all();
        $sectors = EconomicSector::all();

        return View::make('auth.register', compact('departments', 'activities', 'sectors'));
    }
}
