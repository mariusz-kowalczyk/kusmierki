<?php

/**
 * Description of UserRolesSeeder
 *
 * @author Mariusz Kowalczyk
 */
class UserRolesTableSeeder extends Seeder {
    
    public function run() {
        
        $role = Role::createIfNotExists(array(
            'key'   => 'admin',
            'description'   => 'Najwyższe uprawnienia'
        ));
        Role::createIfNotExists(array(
            'key'   => 'edit_gallery',
            'description'   => 'Możliwość dodawanie i edytowania glarii oraz zdjęć'
        ));
        Role::createIfNotExists(array(
            'key'   => 'add_notice',
            'description'   => 'Możliwość dodawania ogłoszeń'
        ));
        
        $user = User::where('login', '=', 'mariusz')->first();
        $user->roles()->detach($role->id);
        $user->roles()->attach($role->id);
    }
    
}
