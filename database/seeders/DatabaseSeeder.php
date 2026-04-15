<?php

namespace Database\Seeders;

use App\Models\Pembahasan;
use App\Models\Semester;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        User::create([
            'nim' => 'admin',
            'name' => 'admin',
            // 'email' => 'admin@example.com',
            // 'email_verified_at' => now(),
            'password' => bcrypt('password'),
            // 'role' => 'superadmin',
            'role' => 'admin',
            'status' => true
        ]);

        User::create([
            'nim' => '0111045403',
            'name' => 'Jhonri Madian S.E., M.M',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0120086901',
            'name' => 'Nottina Samosir, S.Th., M.Psi',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0131127102',
            'name' => 'Fati Gratianus Nefi Larosa, S.T., S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0105087301',
            'name' => 'Doli Hasibuan, S.E., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0010017005',
            'name' => 'Darwin Robinson Manalu, S.Kom., M.M., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0123077901',
            'name' => 'Indra M Sarkis S, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'fungsionaris',
            'status' => true
        ]);

        User::create([
            'nim' => '0417087802',
            'name' => 'Sri Agustina Hutapea, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0122118501',
            'name' => 'Edward Hutagalung, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0102029401',
            'name' => 'Yolanda Yulianti Pratiwi Rumpa, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'fungsionaris',
            'status' => true
        ]);

        User::create([
            'nim' => '0125089301',
            'name' => 'Arisa Prima Silaban, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0107128302',
            'name' => 'Dr. Marzuki Sinambela, S.Kom., M.T',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0128078901',
            'name' => 'Susanto Sitepu, S.T., M.T',
            'password' => bcrypt('password'),
            'role' => 'fungsionaris',
            'status' => true
        ]);

        User::create([
            'nim' => '0103107101',
            'name' => 'Bengar Rumahorbo, S.Th., M.Th',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0125057201',
            'name' => 'Naekson Fandri Saragih, S.T., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'fungsionaris',
            'status' => true
        ]);

        User::create([
            'nim' => '0110027501',
            'name' => 'Imelda Sri Damayanti, S.Si., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0102057401',
            'name' => 'Alfonsus Situmorang, S.Si., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0130117005',
            'name' => 'Venni Silalahi, S.S., M.Hum',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0116027701',
            'name' => 'Jimmy Febryans Nabeho, S.T., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0122017802',
            'name' => 'Asaziduhu Gea, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'fungsionaris',
            'status' => true
        ]);

        User::create([
            'nim' => '0101018805',
            'name' => 'Indra Kelana Jaya, S.T., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'fungsionaris',
            'status' => true
        ]);

        User::create([
            'nim' => '0101038602',
            'name' => 'Margaretha Yohanna, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0107018301',
            'name' => 'Samuel Van Basten Halomoan Manurung, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0126079101',
            'name' => 'Harlan Gilbert Simanullang, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0101116402',
            'name' => 'Drs. Posma SM Lumbanraja, M.Si',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '0113037301',
            'name' => 'Mambiton Aritonang, S.Kom., M.Pd.',
            'password' => bcrypt('password'),
            'role' => 'fungsionaris',
            'status' => true
        ]);

        User::create([
            'nim' => '0120118401',
            'name' => 'Mutiara U. Purba, S.Kom., M.Kom',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => true
        ]);

        User::create([
            'nim' => '-',
            'name' => 'Pdt. Titulina Doloksaribu',
            'password' => bcrypt('password'),
            'role' => 'chaplin',
            'status' => true
        ]);

        User::create([
            'nim' => '219520040',
            'name' => 'Jonathan Lumban Batu',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
            'status' => true
        ]);
        Pembahasan::create([
            // 'ide_pembahasan'=>'Pembuatan Website'
            'ide_pembahasan' => 'Bimbingan Skripsi'
        ]);
        Pembahasan::create([
            // 'ide_pembahasan'=>'Pemasangan Kabel STP dan UTP'
            'ide_pembahasan' => 'Bimbingan Akademik'
        ]);
        Pembahasan::create([
            // 'ide_pembahasan'=>'Pemasangan CCTV'
            'ide_pembahasan' => 'Bimbingan Konseling'
        ]);
        Pembahasan::create([
            // 'ide_pembahasan'=>'Pemasangan CCTV'
            'ide_pembahasan' => 'Bimbingan PKL'
        ]);
        Semester::create([
            'isi_semester' => 'Semester 1 (Satu)',

        ]);
        Semester::create([
            'isi_semester' => 'Semester 2 (Dua)',
        ]);
        Semester::create([

            'isi_semester' => 'Semester 3 (Tiga)',

        ]);
        Semester::create([

            'isi_semester' => 'Semester 4 (Empat)',

        ]);
        Semester::create([

            'isi_semester' => 'Semester 5 (Lima)',

        ]);
        Semester::create([

            'isi_semester' => 'Semester 6 (Enam)',

        ]);
        Semester::create([

            'isi_semester' => 'Semester 7 (Tujuh)',

        ]);
        Semester::create([

            'isi_semester' => 'Semester 8 (Delapan)',

        ]);
        Semester::create([

            'isi_semester' => 'Semester 9 (Sembilan)',

        ]);
        Semester::create([

            'isi_semester' => 'non-aktif',
        ]);

        // Seed jabatan untuk semua dosen/chaplin/fungsionaris
        $dosenUsers = User::whereNotIn('role', ['admin', 'mahasiswa'])->get();
        foreach ($dosenUsers as $user) {
            DB::table('jabatan')->insert([
                'jabatan' => ucfirst($user->role),
                'create_user_id' => $user->id,
            ]);
        }

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
