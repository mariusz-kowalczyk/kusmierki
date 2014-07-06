<?php

/**
 * Description of UserRolesSeeder
 *
 * @author Mariusz Kowalczyk
 */
class UserRolesTableSeeder extends Seeder {
    
    public function run() {
        
        $role = new Role();
        $role->key = 'admin';
        $role->description = 'Najwyższe uprawnienia';
        $role->save();
        
        $user = User::where('login', '=', 'mariusz')->first();
        $user->roles()->attach($role->id);
    }
    
}
