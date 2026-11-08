<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // Insert users one by one to avoid insertBatch compatibility issue
        $users = [
            // Admin 1 - Main admin
            [
                'first_name' => 'Budi',
                'last_name'  => 'Santoso',
                'username'   => 'budisan',
                'email'      => 'budi.santoso@codehub.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_gh'    => 'https://github.com/budisantoso',
                'link_li'    => 'https://linkedin.com/in/budisantoso',
            ],
            
            // Admin 2 - Moderator
            [
                'first_name' => 'Siti',
                'last_name'  => 'Rahayu',
                'username'   => 'sitirah',
                'email'      => 'siti.rahayu@codehub.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_tw'    => 'https://twitter.com/sitirah',
                'link_gh'    => 'https://github.com/sitirah',
            ],
            
            // Regular users - Active contributors
            [
                'first_name' => 'Ahmad',
                'last_name'  => 'Fauzan',
                'username'   => 'ahmadf',
                'email'      => 'ahmad.fauzan@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_gh'    => 'https://github.com/ahmadfauzan',
                'link_li'    => 'https://linkedin.com/in/ahmadfauzan',
                'link_tw'    => 'https://twitter.com/ahmadf',
            ],
            [
                'first_name' => 'Dinda',
                'last_name'  => 'Pratiwi',
                'username'   => 'dindap',
                'email'      => 'dinda.pratiwi@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_ig'    => 'https://instagram.com/dindapratiwi',
                'link_li'    => 'https://linkedin.com/in/dindapratiwi',
            ],
            [
                'first_name' => 'Rizky',
                'last_name'  => 'Ramadhan',
                'username'   => 'rizkyr',
                'email'      => 'rizky.ramadhan@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_gh'    => 'https://github.com/rizkyramadhan',
                'link_fb'    => 'https://facebook.com/rizkyramadhan',
            ],
            [
                'first_name' => 'Nabila',
                'last_name'  => 'Putri',
                'username'   => 'nabilap',
                'email'      => 'nabila.putri@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_ig'    => 'https://instagram.com/nabilaputri',
                'link_tw'    => 'https://twitter.com/nabilap',
            ],
            [
                'first_name' => 'Fajar',
                'last_name'  => 'Hidayat',
                'username'   => 'fajarh',
                'email'      => 'fajar.hidayat@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_gh'    => 'https://github.com/fajarhidayat',
                'link_li'    => 'https://linkedin.com/in/fajarhidayat',
            ],
            [
                'first_name' => 'Dewi',
                'last_name'  => 'Lestari',
                'username'   => 'dewil',
                'email'      => 'dewi.lestari@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_fb'    => 'https://facebook.com/dewilestari',
                'link_ig'    => 'https://instagram.com/dewilestari',
            ],
            [
                'first_name' => 'Andi',
                'last_name'  => 'Wijaya',
                'username'   => 'andiw',
                'email'      => 'andi.wijaya@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_gh'    => 'https://github.com/andiwijaya',
                'link_tw'    => 'https://twitter.com/andiw',
            ],
            [
                'first_name' => 'Maya',
                'last_name'  => 'Safitri',
                'username'   => 'mayas',
                'email'      => 'maya.safitri@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_li'    => 'https://linkedin.com/in/mayasafitri',
                'link_ig'    => 'https://instagram.com/mayasafitri',
            ],
            [
                'first_name' => 'Rudi',
                'last_name'  => 'Hermawan',
                'username'   => 'rudih',
                'email'      => 'rudi.hermawan@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_gh'    => 'https://github.com/rudihermawan',
            ],
            [
                'first_name' => 'Intan',
                'last_name'  => 'Permata',
                'username'   => 'intanp',
                'email'      => 'intan.permata@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_fb'    => 'https://facebook.com/intanpermata',
                'link_li'    => 'https://linkedin.com/in/intanpermata',
            ],
            [
                'first_name' => 'Hendra',
                'last_name'  => 'Setiawan',
                'username'   => 'hendras',
                'email'      => 'hendra.setiawan@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_gh'    => 'https://github.com/hendrasetiawan',
                'link_tw'    => 'https://twitter.com/hendras',
            ],
            [
                'first_name' => 'Rina',
                'last_name'  => 'Anggraini',
                'username'   => 'rinaa',
                'email'      => 'rina.anggraini@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_ig'    => 'https://instagram.com/rinaanggraini',
            ],
            [
                'first_name' => 'Arif',
                'last_name'  => 'Rahman',
                'username'   => 'arifr',
                'email'      => 'arif.rahman@example.test',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role'       => 'user',
                'avatar'     => 'avatar.png',
                'banner'     => 'banner.png',
                'link_gh'    => 'https://github.com/arifrahman',
                'link_li'    => 'https://linkedin.com/in/arifrahman',
            ],
        ];

        // Insert one by one instead of batch to avoid CI 4.7 compatibility issue
        foreach ($users as $user) {
            $db->table('users')->insert($user);
        }
    }
}
