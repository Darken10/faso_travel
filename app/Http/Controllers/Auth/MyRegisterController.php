<?php

namespace App\Http\Controllers\Auth;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\PasswordValidationRules;

class MyRegisterController extends Controller
{
   
    public function step1(){
        return view('auth.register.step1');
    }

    public function step2(){
        return view('auth.register.step2');
    }

    public function step3(){
        return view('auth.register.step3');
    }

    public function post_step1(Request $request){
        $data = $request->validate([
            'first_name' => ['required','min:2'],
            'last_name' => ['required','min:2'],
            'sexe' => ['required','min:2']
        ]);
        $request->session()->put('step1', $data);

        return redirect()->route('auth.register.step2');
    }

    public function post_step2(Request $request){
        
        $data = $request->validate([
            'numero_identifiant' => ['required','min:2'],
            'numero' => ['required','min:2'],
            'email' => ['required','min:2']
        ]);
        $request->session()->put('step2', $data);


        return redirect()->route('auth.register.step3');
    }

    public function post_step3(Request $request){
        $data = $request->validate([
            'password' => ['required','min:2'],
            'password_confirmation' => ['required','min:2'],
        ]);
        $request->session()->put('step3', $data);


        $input = array_merge(session('step3'),session('step2'),session('step1'));

        User::create([
            'password' => Hash::make($input['password']),

        ...$input,
        ])->sendEmailVerificationNotification();

        dd();
    }

    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}

