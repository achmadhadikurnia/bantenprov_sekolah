<?php

use Illuminate\Database\Seeder;

/**
 * Usage :
 * [1] $ composer dump-autoload -o
 * [2] $ php artisan db:seed --class=BantenprovSekolahSeederSekolah
 */

class BantenprovSekolahSeederSekolah extends Seeder
{
    /* text color */
    protected $RED     ="\033[0;31m";
    protected $CYAN    ="\033[0;36m";
    protected $YELLOW  ="\033[1;33m";
    protected $ORANGE  ="\033[0;33m";
    protected $PUR     ="\033[0;35m";
    protected $GRN     ="\e[32m";
    protected $WHI     ="\e[37m";
    protected $NC      ="\033[0m";

    /* File name */
    /* location : /databse/seeds/file_name.csv */
    protected $fileName = "BantenprovSekolahSeederSekolah.csv";

    /* text info : default (true) */
    protected $textInfo = true;

    /* model class */
    protected $model;

    /* __construct */
    public function __construct(){

        $this->model = new Bantenprov\Sekolah\Models\Bantenprov\Sekolah\Sekolah;

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertData();
    }

    /* function insert data */
    protected function insertData()
    {
        /* silahkan di rubah sesuai kebutuhan */
        foreach($this->readCSV() as $data){

            $this->model->create([
            	'user_id' => $data['user_id'],
                'nama' => $data['nama'],
                'npsn' => $data['npsn'],
                'jenis_sekolah_id' => $data['jenis_sekolah_id'],
                'alamat' => $data['alamat'],
                'logo' => $data['logo'],
                'foto_gedung' => $data['foto_gedung'],
                'province_id' => $data['province_id'],
                'city_id' => $data['city_id'],
                'district_id' => $data['district_id'],
                'village_id' => $data['village_id'],
                'no_telp' => $data['no_telp'],
                'email' => $data['email'],
                'kode_zona' => $data['kode_zona'],

            ]);

            if($this->textInfo){
                echo "============[DATA]============\n";
                $this->orangeText('nama : ').$this->greenText($data['nama']);
                echo"\n";
                $this->orangeText('npsn : ').$this->greenText($data['npsn']);
                echo"\n";
                $this->orangeText('jenis_sekolah_id : ').$this->greenText($data['jenis_sekolah_id']);
                echo"\n";
                $this->orangeText('alamat : ').$this->greenText($data['alamat']);
                echo"\n";
                $this->orangeText('logo : ').$this->greenText($data['logo']);
                echo"\n";
                $this->orangeText('foto_gedung : ').$this->greenText($data['foto_gedung']);
                echo"\n";
                $this->orangeText('province_id : ').$this->greenText($data['province_id']);
                echo"\n";
                $this->orangeText('city_id : ').$this->greenText($data['city_id']);
                echo"\n";
                $this->orangeText('district_id : ').$this->greenText($data['district_id']);
                echo"\n";
                $this->orangeText('village_id : ').$this->greenText($data['village_id']);
                echo"\n";
                $this->orangeText('no_telp : ').$this->greenText($data['no_telp']);
                echo"\n";
                $this->orangeText('email : ').$this->greenText($data['logo']);
                echo"\n";
                $this->orangeText('kode_zona : ').$this->greenText($data['kode_zona']);
                echo"\n";
                $this->orangeText('user_id : ').$this->greenText($data['user_id']);
                echo"\n";
                echo "============[DATA]============\n\n";
            }

        }

        $this->greenText('[ SEEDER DONE ]');
        echo"\n\n";
    }

    /* text color: orange */
    protected function orangeText($text)
    {
        printf($this->ORANGE.$text.$this->NC);
    }

    /* text color: green */
    protected function greenText($text)
    {
        printf($this->GRN.$text.$this->NC);
    }

    /* function read CSV file */
    protected function readCSV()
    {
        /* Silahkan di rubah sesuai struktur file csv */
        $file = fopen(database_path("seeds/".$this->fileName), "r");
        $all_data = array();
        $row = 1;
        while(($data = fgetcsv($file, 1000, ",")) !== FALSE){
            $all_data[] = [ 
                            'user_id' => $data[0],
                            'nama' => $data[1],
                            'npsn' => $data[2],
                            'jenis_sekolah_id' => $data[3],
                            'alamat' => $data[4],
                            'logo' => $data[5],
                            'foto_gedung' => $data[6],
                            'province_id' => $data[7],
                            'city_id' => $data[8],
                            'district_id' => $data[9],
                            'village_id' => $data[10],
                            'no_telp' => $data[11],
                            'email' => $data[13],
                            'kode_zona' => $data[14],
                        ];
        }
        fclose($file);

        return  $all_data;
    }
}
