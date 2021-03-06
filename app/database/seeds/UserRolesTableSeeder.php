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
            'key'   => 'edit_notice',
            'description'   => 'Możliwość dodawania i edytowania ogłoszeń'
        ));
        Role::createIfNotExists(array(
            'key'   => 'edit_sites',
            'description'   => 'Możliwość dodawania i edytowania stron'
        ));
        
        $user = User::where('login', '=', 'mariusz')->first();
        $user->roles()->detach($role->id);
        $user->roles()->attach($role->id);
    }
    
}
