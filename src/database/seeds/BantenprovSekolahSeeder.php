<?php

use Illuminate\Database\Seeder;

class BantenprovSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BantenprovSekolahSeederJenisSekolah::class);
        $this->call(BantenprovSekolahSeederSekolah::class);
        $this->call(BantenprovSekolahSeederProdiSekolah::class);
    }
}
