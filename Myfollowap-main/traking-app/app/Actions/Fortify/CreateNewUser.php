<?php

namespace App\Actions\Fortify;

use App\Models\roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
{
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),
        ],
        'password' => $this->passwordRules(),
        'role' => 'required', // Make sure the 'role' field is required
    ])->validate();

    // Retrieve the role by name and get its ID
    $roleName = $input['role'];
    $role = roles::where('name', $roleName)->first();

    return User::create([
        'name'=>$input['name'],
        'email'=>$input['email'],
        'password'=> Hash::make($input['password']),
        "original_password"=>$input['password'],
        'id_role'=>$role->id, // Assign the role's ID
    ]);
}

}
