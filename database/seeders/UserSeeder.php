<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([[
            'name' => 'Super Admin',
            'username' => 'super_admin',
            'email' => 'super_admin@email-sample.com',
            'password' => bcrypt('P4$$w0Rd'),
            'email_verified_at' => now(),
            'remember_token' => str()->random(10)
        ]]);

        $users->each(fn($user) => User::create($user));

        collect([
            [
                'name' => 'Faridah Lamarauna',
                'username' => '196505171992032006',
                'front_title' => null,
                'back_title' => 'SE, M.Si',
                'field_id' => 1,
                'position' => 'Kepala Badan',
            ],
            [
                'name' => 'Agustin Maria',
                'username' => '197708232009032002',
                'front_title' => null,
                'back_title' => 'SE, MM',
                'field_id' => 1,
                'position' => 'Sekretaris Badan',
            ],
            [
                'name' => 'Andi Murfiqien Latjuba',
                'username' => '199211152014061002',
                'front_title' => null,
                'back_title' => 'S.STP., M.A.P',
                'field_id' => 1,
                'position' => 'Kasubbag Kepegawaian dan Umum',
            ],
            [
                'name' => 'Indariyani Pilohima',
                'username' => '197510302002122004',
                'front_title' => null,
                'back_title' => 'A.Md',
                'field_id' => 1,
                'position' => 'Pengelola Pranata Sarana dan Prasarana',
            ],
            [
                'name' => 'Lidyasari S. Ambanaga',
                'username' => '197107222000122004',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 1,
                'position' => 'Pengadministrasi Kepegawaian',
            ],
            [
                'name' => 'Irmasari',
                'username' => '19780512 200901 2 001',
                'front_title' => null,
                'back_title' => 'A.Md',
                'field_id' => 1,
                'position' => 'Pengelola Kepegawaian',
            ],

            [
                'name' => 'Abdul Muiz',
                'username' => '19920621 201503 1 001',
                'front_title' => null,
                'back_title' => 'S.Pt',
                'field_id' => 1,
                'position' => 'Penyuluh Kearsipan',
            ],

            [
                'name' => 'Suarman',
                'username' => '19750112 201604 1 001',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 1,
                'position' => 'Pengadministrasi Umum',
            ],

            [
                'name' => 'Irfan Tadjani',
                'username' => '19830607 201604 1 001',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 1,
                'position' => 'Pengadministrasi Kepegawaian',
            ],

            [
                'name' => 'Neopan Hidayat',
                'username' => '19701109 201604 1 001',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 1,
                'position' => 'Pengemudi',
            ],

            [
                'name' => 'Ristiadanti Citra Sukmahati T',
                'username' => '19830328 202321 2 032',
                'front_title' => null,
                'back_title' => 'SE',
                'field_id' => 1,
                'position' => 'Ahli Pertama - Analis SDM Aparatur',
            ],

            [
                'name' => 'Dian Kartika',
                'username' => '19850708 202321 2 028',
                'front_title' => null,
                'back_title' => 'S.E',
                'field_id' => 1,
                'position' => 'Ahli Pertama - Analis SDM Aparatur',
            ],

            [
                'name' => 'Heny Selviana',
                'username' => '19851015 202321 2 044',
                'front_title' => null,
                'back_title' => 'S.Sos',
                'field_id' => 1,
                'position' => 'Ahli Pertama - Analis SDM Aparatur',
            ],

            [
                'name' => 'Nurul Fitri Fatimah',
                'username' => '19940310 202321 053',
                'front_title' => null,
                'back_title' => 'S.Kom',
                'field_id' => 1,
                'position' => 'Ahli Pertama - Pranata Komputer',
            ],

            [
                'name' => 'Hetty',
                'username' => '19760816 200112 2 003',
                'front_title' => null,
                'back_title' => 'S.Sos, M.Si',
                'field_id' => 1,
                'position' => 'Kasubbag Keuangan dan Aset',
            ],

            [
                'name' => 'Rahmy',
                'username' => '19710212 200012 2 003',
                'front_title' => null,
                'back_title' => 'SE',
                'field_id' => 1,
                'position' => 'Analis Laporan Keuangan',
            ],

            [
                'name' => 'Lina Agustin',
                'username' => '19810824 201001 2 003',
                'front_title' => null,
                'back_title' => 'SP',
                'field_id' => 1,
                'position' => 'Analis Laporan Pertanggung Jawaban Bendahara',
            ],

            [
                'name' => 'Risma Rahmi. L',
                'username' => '19840925 201408 2 002',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 1,
                'position' => 'Pengelola Gaji',
            ],

            [
                'name' => 'Heriani',
                'username' => '19781104 201604 2 002',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 1,
                'position' => 'Pengadministrasi Sarana dan Prasarana',
            ],

            [
                'name' => 'Frans Octavianus',
                'username' => '19781030 200604 1 005',
                'front_title' => null,
                'back_title' => 'S.Hut',
                'field_id' => 1,
                'position' => 'Perencana Ahli Muda',
            ],


            [
                'name' => 'Witarmin',
                'username' => '19820826 201001 1 012',
                'front_title' => null,
                'back_title' => 'S.Pd',
                'field_id' => 1,
                'position' => 'Penyusun Program Anggaran dan Pelaporan',
            ],


            [
                'name' => 'Syamsul Arief',
                'username' => '19831230 201604 1 001',
                'front_title' => null,
                'back_title' => 'S.H',
                'field_id' => 1,
                'position' => 'Pengadministrasi Perencanaan dan Program',
            ],


            [
                'name' => 'Andri Kartono Paiman',
                'username' => '19850421 202321 1 012',
                'front_title' => null,
                'back_title' => 'ST',
                'field_id' => 1,
                'position' => 'Ahli Pertama - Pranata Komputer',
            ],


            [
                'name' => 'Mohamad Taofan',
                'username' => '19910507 202321 1 027',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 1,
                'position' => 'Ahli Pertama - Pranata Komputer',
            ],


            [
                'name' => 'M. Edward Yusuf Oktaviantho',
                'username' => '19741022 200112 1 003',
                'front_title' => null,
                'back_title' => 'S.Pi., M.Sc',
                'field_id' => 2,
                'position' => 'Kepala Bidang Pemanfaatan, Fasilitasi Riset dan Inovasi Daerah',
            ],


            [
                'name' => 'Asril R. Hasani',
                'username' => '19710101 199401 1 002',
                'front_title' => null,
                'back_title' => 'S.Sos., M.Si',
                'field_id' => 2,
                'position' => 'Analis Pemanfaatan IPTEK Ahli Muda',
            ],


            [
                'name' => 'Hengky Wowiling',
                'username' => '19720303 199203 1 004',
                'front_title' => null,
                'back_title' => 'S.H., M.M',
                'field_id' => 2,
                'position' => 'Analis Pemanfaatan IPTEK Ahli Muda',
            ],


            [
                'name' => 'Musa Rumanama',
                'username' => '19731209 199803 1 004',
                'front_title' => null,
                'back_title' => 'S.Pi',
                'field_id' => 2,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Rahmawati B. Sadepuh',
                'username' => '19720610 201604 2 001',
                'front_title' => null,
                'back_title' => 'S.E',
                'field_id' => 2,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Mohammad Gazali Karim',
                'username' => '19860421 201001 1 001',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 2,
                'position' => 'Pengadministrasi Umum',
            ],

            [
                'name' => 'Mariana',
                'username' => '19850624 201604 2 001',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 2,
                'position' => 'Pengadministrasi Evaluasi dan Kerjasama Penelitian',
            ],

            [
                'name' => 'Hasim R',
                'username' => '19760708 200112 1 004',
                'front_title' => null,
                'back_title' => 'S.Kom, M.Si',
                'field_id' => 3,
                'position' => 'Kepala Bidang Riset Inovasi dan Teknologi Daerah',
            ],


            [
                'name' => 'Megawati',
                'username' => '19940417 202203 2 001',
                'front_title' => null,
                'back_title' => 'S.Ak., M.Ak',
                'field_id' => 3,
                'position' => 'Ahli Pertama Peneliti',
            ],


            [
                'name' => 'Shinta Megawati Sitorus',
                'username' => '19930612 202203 2 003',
                'front_title' => null,
                'back_title' => 'M.S.Ak',
                'field_id' => 3,
                'position' => 'Ahli Pertama Peneliti',
            ],

            [
                'name' => 'Adiani Purwa Utari',
                'username' => '19881203 202203 2 001',
                'front_title' => null,
                'back_title' => 'S.Pd., M.Si',
                'field_id' => 3,
                'position' => 'Ahli Pertama Peneliti',
            ],

            [
                'name' => 'Farfar Madina Bouti',
                'username' => '19690626 199304 1 001',
                'front_title' => null,
                'back_title' => 'S.Pd.,M.Si',
                'field_id' => 3,
                'position' => 'Analis Pemanfaatan IPTEK dan Ahli Muda',
            ],

            [
                'name' => 'Mohamad Aumusal',
                'username' => '19681220 199903 1 003',
                'front_title' => null,
                'back_title' => 'S.Pt., MMA',
                'field_id' => 3,
                'position' => 'Analis Pemanfaatan IPTEK dan Ahli Muda',
            ],

            [
                'name' => 'Syarifudin',
                'username' => '19850118 202321 1 014',
                'front_title' => null,
                'back_title' => 'M.P',
                'field_id' => 3,
                'position' => 'Ahli Pertama - Peneliti',
            ],

            [
                'name' => 'Irastuti',
                'username' => '19841209 202321 2 022',
                'front_title' => null,
                'back_title' => 'S.Pt., M.Si',
                'field_id' => 3,
                'position' => 'Ahli Pertama - Peneliti',
            ],

            [
                'name' => 'Irfan',
                'username' => '19700210 200801 1 007',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 3,
                'position' => 'Pramu Laboratorium',
            ],

            [
                'name' => 'Syafroni Masloman',
                'username' => '19720214 201604 1 001',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 3,
                'position' => 'Pengadministrasi Umum',
            ],

            [
                'name' => 'Ilham',
                'username' => '19711015 201604 1 001',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 3,
                'position' => 'Pengadministrasi Umum',
            ],

            [
                'name' => 'Sjamsudin',
                'username' => '19660712 199403 1 009',
                'front_title' => null,
                'back_title' => 'S.Sos., M.A.P',
                'field_id' => 4,
                'position' => 'Kepala Bidang SDM dan Infrastruktur Riset Daerah',
            ],

            [
                'name' => 'Nani Oktavia',
                'username' => '19781013 200112 2 005',
                'front_title' => null,
                'back_title' => 'S.H., M.Si',
                'field_id' => 4,
                'position' => 'Analis Pemanfaatan IPTEK Ahli Muda',
            ],

            [
                'name' => 'Zul Fachmid Noor',
                'username' => '19720410 199103 1 002',
                'front_title' => null,
                'back_title' => 'S.Sos',
                'field_id' => 4,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Yustina Serli',
                'username' => '19760416 200701 2 013',
                'front_title' => null,
                'back_title' => 'SP',
                'field_id' => 4,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Zulfa',
                'username' => '19870515 201503 2 005',
                'front_title' => null,
                'back_title' => 'S.Si',
                'field_id' => 4,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Eddy Friaddyanto',
                'username' => '19680515 199603 1 005',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 4,
                'position' => 'Pengadministrasi Evaluasi dan Kerjasama Penelitian',
            ],

            [
                'name' => 'Darwin Bodah',
                'username' => '19681225 201604 1 001',
                'front_title' => null,
                'back_title' => 'S.Sos',
                'field_id' => 4,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Zam Ani',
                'username' => '19670729 200701 2 018',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 4,
                'position' => 'Pengadministasi Evaluasi dan Kerjasama Penelitian',
            ],

            [
                'name' => 'Basnur',
                'username' => '19780703 201408 1 001',
                'front_title' => null,
                'back_title' => 'S.AP',
                'field_id' => 4,
                'position' => 'Pengadministasi Umum',
            ],

            [
                'name' => 'Rohani I Datumusu',
                'username' => '19710107 199203 2 007',
                'front_title' => null,
                'back_title' => 'S.Sos., M.Si',
                'field_id' => 5,
                'position' => 'Kepala Bidang Kebijakan Pembangunan Riset Daerah',
            ],

            [
                'name' => 'Ayub Minggu Sura',
                'username' => '19680922 199803 1 008',
                'front_title' => 'Drs.',
                'back_title' => null,
                'field_id' => 5,
                'position' => 'Analis Pemanfaatan IPTEK Ahli Muda',
            ],

            [
                'name' => 'Ummi Kalsum',
                'username' => '19691013 199703 2 004',
                'front_title' => null,
                'back_title' => 'S.Pi',
                'field_id' => 5,
                'position' => 'Analis Pemanfaatan IPTEK dan Ahli Muda',
            ],

            [
                'name' => 'Muhammad Randhika',
                'username' => '19880816 202321 1 025',
                'front_title' => null,
                'back_title' => 'SE., M.Si',
                'field_id' => 5,
                'position' => 'Ahli Pertama - Peneliti',
            ],

            [
                'name' => 'Siemy Prayuda',
                'username' => '19670919 199008 1 001',
                'front_title' => null,
                'back_title' => 'S.Sos',
                'field_id' => 5,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Tenriyabe',
                'username' => '19690222 200012 2 003',
                'front_title' => null,
                'back_title' => 'S.Sos',
                'field_id' => 5,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Muhammad Amin Malik',
                'username' => '19740308 199403 1 003',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 5,
                'position' => 'Pengadministrasi Umum',
            ],

            [
                'name' => 'Indriati',
                'username' => '19800207 201312 2 001',
                'front_title' => null,
                'back_title' => 'SE',
                'field_id' => 5,
                'position' => 'Penyusun Penelitian dan Pengembangan',
            ],

            [
                'name' => 'Sisilia Yudi Wuisan',
                'username' => '19810708 201604 2 001',
                'front_title' => null,
                'back_title' => null,
                'field_id' => 5,
                'position' => 'Pengadministrasi Umum',
            ],

        ])->each(function ($employee) {
            $emp = User::create([
                'name' => $employee['name'],
                'username' => str()->of($employee['username'])->replace(' ', ''),
                'password' => bcrypt('password123'),
                'email' => str()->of($employee['name'])->slug() . '@sample-mail.com',
                'email_verified_at' => now(),
                'remember_token' => str()->random(10),
            ]);

            $emp->user_detail()->create([
                'front_title' => $employee['front_title'],
                'back_title' => $employee['back_title'],
                'field_id' => $employee['field_id'],
                'position' => $employee['position'],
            ]);
        });
    }
}
