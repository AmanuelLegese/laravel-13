<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

#[Signature('app:SuperUser')]
#[Description('make user super admin')]
class SuperUser extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $input = $this->getUserInput();

        if (!User::where('email', $input['email'])->exists()) {

            // create super user
            $user = $this->createSuperUser($input);

            $this->info('Super user created successfully.');
        }
        // assign super user role to the user
        $this->assignSuperUserRole(User::where('email', $input['email'])->first());
    }

    /**
     * accept user input for super user creation
     */
    private function getUserInput()
    {
        $name = $this->ask('Enter the name of the super user');
        $email = $this->ask('Enter the email of the super user');
        $password = $this->secret('Enter the password of the super user');

        return [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];
    }

    /**
     * create super user
     */
    private function createSuperUser($input)
    {
        // create super user
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->save();
        return $user;
    }

    /**
     * assign super user role to the user
     */
    private function assignSuperUserRole(User $user)
    {
        // Assuming you have a role management system in place
        // You can assign the super user role to the user here
        // For example:
        // $user->assignRole('superuser');
        /**
         * first create a role named 'superuser' in your roles table and then assign it to the user.
         */

        Role::firstOrCreate(['name' => 'Super Admin']);
        $user->assignRole('Super Admin');
        $this->info('Super user role assigned to the user.');
    }
}
