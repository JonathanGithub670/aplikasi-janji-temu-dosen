<?php

namespace Database\Seeders;

use App\Models\Pembahasan;
use App\Models\Semester;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create ([
        //     'name' => 'Jonathan Lumban Batu',
        //     'email' => 'jonathan@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // User::create ([
        //     'name' => 'Alexandria Dadario',
        //     'email' => 'alexandria@gmail.com',
        //     'password' => bcrypt('54321')
        // ]);

        // Category::create ([
        //     'name' => 'Web Programming',
        //     'slug' => 'web-programming'
        // ]);

        // Category::create ([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // Category::create ([
        //     'name' => 'Culinary',
        //     'slug' => 'culinary'
        // ]);

        // Post::factory(20)->create();

        // Post::create ([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat quod temporibus incidunt aspernatur nisi, quibusdam illo fugiat ipsam perspiciatis sed facilis perferendis deserunt repudiandae.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat quod temporibus incidunt aspernatur nisi, quibusdam illo fugiat ipsam perspiciatis sed facilis perferendis deserunt repudiandae. Mollitia, nesciunt. Eaque esse perferendis soluta ducimus ipsam quod. Repudiandae maxime veniam doloremque in, minima quae ullam. Non in eum corrupti, nisi id tempore earum ea reprehenderit ullam ab natus maiores doloremque labore possimus optio magnam! Culpa quibusdam assumenda enim quaerat tempora impedit laborum deserunt rem sit. Illum repellendus porro possimus, in quidem labore dolorem cumque doloremque eaque, modi consequatur, vero quam aliquid molestias adipisci.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create ([
        // 'title' => 'Judul Ke Dua',
        // 'slug' => 'judul-ke-dua',
        // 'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat quod temporibus incidunt aspernatur nisi, quibusdam illo fugiat ipsam perspiciatis sed facilis perferendis deserunt repudiandae.',
        // 'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat quod temporibus incidunt aspernatur nisi, quibusdam illo fugiat ipsam perspiciatis sed facilis perferendis deserunt repudiandae. Mollitia, nesciunt. Eaque esse perferendis soluta ducimus ipsam quod. Repudiandae maxime veniam doloremque in, minima quae ullam. Non in eum corrupti, nisi id tempore earum ea reprehenderit ullam ab natus maiores doloremque labore possimus optio magnam! Culpa quibusdam assumenda enim quaerat tempora impedit laborum deserunt rem sit. Illum repellendus porro possimus, in quidem labore dolorem cumque doloremque eaque, modi consequatur, vero quam aliquid molestias adipisci.',
        // 'category_id' => 3,
        // 'user_id' => 2
        // ]);

        // Post::create ([
        // 'title' => 'Judul Ke Tiga',
        // 'slug' => 'judul-ke-tiga',
        // 'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat quod temporibus incidunt aspernatur nisi, quibusdam illo fugiat ipsam perspiciatis sed facilis perferendis deserunt repudiandae.',
        // 'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat quod temporibus incidunt aspernatur nisi, quibusdam illo fugiat ipsam perspiciatis sed facilis perferendis deserunt repudiandae. Mollitia, nesciunt. Eaque esse perferendis soluta ducimus ipsam quod. Repudiandae maxime veniam doloremque in, minima quae ullam. Non in eum corrupti, nisi id tempore earum ea reprehenderit ullam ab natus maiores doloremque labore possimus optio magnam! Culpa quibusdam assumenda enim quaerat tempora impedit laborum deserunt rem sit. Illum repellendus porro possimus, in quidem labore dolorem cumque doloremque eaque, modi consequatur, vero quam aliquid molestias adipisci.',
        // 'category_id' => 2,
        // 'user_id' => 1
        // ]);

        // Post::create ([
        // 'title' => 'Judul Ke Empat',
        // 'slug' => 'judul-ke-empat',
        // 'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat quod temporibus incidunt aspernatur nisi, quibusdam illo fugiat ipsam perspiciatis sed facilis perferendis deserunt repudiandae.',
        // 'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quaerat quod temporibus incidunt aspernatur nisi, quibusdam illo fugiat ipsam perspiciatis sed facilis perferendis deserunt repudiandae. Mollitia, nesciunt. Eaque esse perferendis soluta ducimus ipsam quod. Repudiandae maxime veniam doloremque in, minima quae ullam. Non in eum corrupti, nisi id tempore earum ea reprehenderit ullam ab natus maiores doloremque labore possimus optio magnam! Culpa quibusdam assumenda enim quaerat tempora impedit laborum deserunt rem sit. Illum repellendus porro possimus, in quidem labore dolorem cumque doloremque eaque, modi consequatur, vero quam aliquid molestias adipisci.',
        // 'category_id' => 2,
        // 'user_id' => 2
        // ]);

        User::create ([
            'nim' => 'admin',
            'name' => 'admin',
            // 'email' => 'admin@example.com',
            // 'email_verified_at' => now(),
            'password' => bcrypt('password'),
            // 'role' => 'superadmin',
            'role' => 'admin',
            'status' => true
        ]);

        // User::create ([
        //     'nim' => 'dosen1',
        //     'name' => 'dosen 1',
        //     'email' => 'dosen1n@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password'),
        //     'role' => 'dosen',
        //     'status' => true
        // ]);

        // User::create ([
        //     'nim' => 'dosen2',
        //     'name' => 'dosen 2',
        //     'email' => 'dosen2@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password'),
        //     'role' => 'dosen',
        //     'status' => true
        // ]);
        // User::create ([
        //     'nim' => 'dosen3',
        //     'name' => 'dosen 3',
        //     'email' => 'dosen3@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password'),
        //     'role' => 'chaplin',
        //     'status' => true
        // ]);
        // User::create ([
        //     'nim' => 'dosen4',
        //     'name' => 'dosen 4',
        //     'email' => 'dosen4@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password'),
        //     'role' => 'fungsionaris',
        //     'status' => true
        // ]);

        Pembahasan::create([
            // 'ide_pembahasan'=>'Pembuatan Website'
            'ide_pembahasan'=>'Bimbingan Skripsi'
        ]);
        Pembahasan::create([
            // 'ide_pembahasan'=>'Pemasangan Kabel STP dan UTP'
            'ide_pembahasan'=>'Bimbingan Akademik'
        ]);
        Pembahasan::create([
            // 'ide_pembahasan'=>'Pemasangan CCTV'
            'ide_pembahasan'=>'Bimbingan Konseling'
        ]);
        Pembahasan::create([
            // 'ide_pembahasan'=>'Pemasangan CCTV'
            'ide_pembahasan'=>'Bimbingan PKL'
        ]);
        Semester::create([
            'isi_semester'=>'Semester 1 (Satu)',
            
        ]);
        Semester::create([
            'isi_semester'=>'Semester 2 (Dua)',
        ]);
        Semester::create([
            
            'isi_semester'=>'Semester 3 (Tiga)',
            
        ]);
        Semester::create([
            
            'isi_semester'=>'Semester 4 (Empat)',
            
        ]);
        Semester::create([
            
            'isi_semester'=>'Semester 5 (Lima)',
            
        ]);
        Semester::create([
            
            'isi_semester'=>'Semester 6 (Enam)',
            
        ]);
        Semester::create([
            
            'isi_semester'=>'Semester 7 (Tujuh)',
            
        ]);
        Semester::create([
            
            'isi_semester'=>'Semester 8 (Delapan)',
            
        ]);
        Semester::create([
            
            'isi_semester'=>'Semester 9 (Sembilan)',
            
        ]);
        Semester::create([
            
            'isi_semester'=>'non-aktif',
        ]);

        // Kriteria::create([
        //     'kode' => 'kode',
        //     'nama_kriteria' => '',
        //     'atribute' => '',
        //     'bobot' => ''
        // ]);

        // Role::create([
        //     'isi_role' => 'Admin'
        // ]);
        // Role::create([
        //     'isi_role' => 'Dosen'
        // ]);
        // Role::create([
        //     'isi_role' => 'Mahasiswa'
        // ]);


        // User::factory(4)->create();
    }
}
