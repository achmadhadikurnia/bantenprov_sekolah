<?php

namespace Bantenprov\Sekolah\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\Sekolah\Facades\SekolahFacade;

/* Models */
use Bantenprov\Sekolah\Models\Bantenprov\Sekolah\Sekolah;
use Bantenprov\Sekolah\Models\Bantenprov\Sekolah\JenisSekolah;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Bantenprov\Zona\Models\Bantenprov\Zona\Zona;
use App\User;

/* Etc */
use Validator;
use Auth;

/**
 * The SekolahController class.
 *
 * @package Bantenprov\Sekolah
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SekolahController extends Controller
{
    protected $sekolah;
    protected $jenis_sekolah;
    protected $zona;
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sekolah          = new Sekolah;
        $this->jenis_sekolah    = new JenisSekolah;
        $this->province         = new Province;
        $this->city             = new City;
        $this->district         = new District;
        $this->village          = new Village;
        $this->zona             = new Zona;
        $this->user             = new User;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);

            $query = $this->sekolah->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->sekolah->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('nama', 'like', $value)
                    ->orWhere('npsn', 'like', $value)
                    ->orWhere('alamat', 'like', $value)
                    ->orWhere('email', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;

        $response = $query->with('jenis_sekolah', 'province', 'city', 'district', 'village', 'zona', 'user')->paginate($perPage);

        return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $sekolahs = $this->sekolah->with('jenis_sekolah', 'province', 'city', 'district', 'village', 'zona', 'user')->get();

        foreach($sekolahs as $sekolah){
            array_set($sekolah, 'label', $sekolah->nama);
        }

        $response['sekolahs']   = $sekolahs;
        $response['error']      = false;
        $response['message']    = 'Success';
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id        = isset(Auth::User()->id) ? Auth::User()->id : null;
        $sekolah        = $this->sekolah->getAttributes();
        $jenis_sekolahs = $this->jenis_sekolah->all();
        $provinces      = $this->province->getAttributes();
        $cities         = $this->city->getAttributes();
        $districts      = $this->district->getAttributes();
        $villages       = $this->village->getAttributes();
        $zonas          = $this->zona->all();
        $users          = $this->user->getAttributes();
        $users_special  = $this->user->all();
        $users_standar  = $this->user->findOrFail($user_id);
        $current_user   = Auth::User();

        foreach($jenis_sekolahs as $jenis_sekolah){
            array_set($jenis_sekolah, 'label', $jenis_sekolah->jenis_sekolah);
        }

        foreach($provinces as $province){
            array_set($province, 'label', $province->name);
        }

        foreach($cities as $city){
            array_set($city, 'label', $city->name);
        }

        foreach($districts as $district){
            array_set($district, 'label', $district->name);
        }

        foreach($villages as $village){
            array_set($village, 'label', $village->name);
        }

        foreach($zonas as $zona){
            array_set($zona, 'label', (string) $zona->id);
        }

        $role_check = Auth::User()->hasRole(['superadministrator','administrator']);

        if($role_check){
            $user_special = true;

            foreach($users_special as $user){
                array_set($user, 'label', $user->name);
            }

            $users = $users_special;
        }else{
            $user_special = false;

            array_set($users_standar, 'label', $users_standar->name);

            $users = $users_standar;
        }

        array_set($current_user, 'label', $current_user->name);

        $response['sekolah']        = $sekolah;
        $response['jenis_sekolahs'] = $jenis_sekolahs;
        $response['provinces']      = $provinces;
        $response['cities']         = $cities;
        $response['districts']      = $districts;
        $response['villages']       = $villages;
        $response['zonas']          = $zonas;
        $response['users']          = $users;
        $response['user_special']   = $user_special;
        $response['current_user']   = $current_user;
        $response['error']          = false;
        $response['message']        = 'Success';
        $response['status']         = true;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sekolah = $this->sekolah;

        $validator = Validator::make($request->all(), [
            'nama'              => 'required|max:255',
            'npsn'              => "required|max:255|unique:{$this->sekolah->getTable()},npsn,NULL,id,deleted_at,NULL",
            'jenis_sekolah_id'  => "required|exists:{$this->jenis_sekolah->getTable()},id",
            'alamat'            => 'required|max:255',
            'logo'              => 'required|max:255',
            'foto_gedung'       => 'required|max:255',
            'province_id'       => "required|exists:{$this->province->getTable()},id",
            'city_id'           => "required|exists:{$this->city->getTable()},id",
            'district_id'       => "required|exists:{$this->district->getTable()},id",
            'village_id'        => "required|exists:{$this->village->getTable()},id",
            'no_telp'           => 'required|digits_between:10,12',
            'email'             => 'required|email|max:255',
            'zona_id'           => "required|exists:{$this->zona->getTable()},id",
            'user_id'           => "required|exists:{$this->user->getTable()},id",
        ]);

        if ($validator->fails()) {
            $error      = true;
            $message    = $validator->errors()->first();
        } else {
            $sekolah->nama              = $request->input('nama');
            $sekolah->npsn              = $request->input('npsn');
            $sekolah->jenis_sekolah_id  = $request->input('jenis_sekolah_id');
            $sekolah->alamat            = $request->input('alamat');
            $sekolah->logo              = $request->input('logo');
            $sekolah->foto_gedung       = $request->input('foto_gedung');
            $sekolah->province_id       = $request->input('province_id');
            $sekolah->city_id           = $request->input('city_id');
            $sekolah->district_id       = $request->input('district_id');
            $sekolah->village_id        = $request->input('village_id');
            $sekolah->no_telp           = $request->input('no_telp');
            $sekolah->email             = $request->input('email');
            $sekolah->zona_id           = $request->input('zona_id');
            $sekolah->user_id           = $request->input('user_id');
            $sekolah->save();

            $error      = false;
            $message    = 'Success';
        }

        $response['error']      = $error;
        $response['message']    = $message;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sekolah = $this->sekolah->with(['jenis_sekolah', 'province', 'city', 'district', 'village', 'zona', 'user'])->findOrFail($id);

        $response['sekolah']      = $sekolah;
        $response['error']      = false;
        $response['message']    = 'Success';
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sekolah = $this->sekolah->findOrFail($id);

        array_set($sekolah->jenis_sekolah, 'label', $sekolah->jenis_sekolah->jenis_sekolah);
        array_set($sekolah->user, 'label', $sekolah->user->name);

        $response['sekolah'] = $sekolah;
        $response['user'] = $sekolah->user;
        $response['jenis_sekolah'] = $sekolah->jenis_sekolah;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = array();
        $message  = array();

        $sekolah = $this->sekolah->findOrFail($id);

            $validator = Validator::make($request->all(), [
                'label'               => 'required',
                'user_id'             => 'required|unique:sekolahs,user_id,'.$id,
                'jenis_sekolah_id'    => 'required',
                'npsn'                => 'required|unique:sekolahs,npsn,'.$id,
                'alamat'              => 'required',
                'logo'                => 'required',
                'foto_gedung'         => 'required',
                'province_id'         => 'required',
                'city_id'             => 'required',
                'district_id'         => 'required',
                'village_id'          => 'required',
                'no_telp    '         => 'required',
                'email'               => 'required',
                'zona_id'             => 'required',

            ]);

            if($validator->fails()){

                foreach($validator->messages()->getMessages() as $key => $error){
                    foreach($error AS $error_get) {
                        array_push($message, $error_get);
                    }
                }

                $check_user   = $this->sekolah->where('id','!=', $id)->where('user_id', $request->user_id);
                $check_npsn   = $this->sekolah->where('id','!=', $id)->where('npsn', $request->npsn);


                if($check_npsn->count() > 0 || $check_user->count() > 0){
                    $response['message'] = implode("\n",$message);

                } else {
                    $sekolah->label             = $request->input('label');
                $sekolah->jenis_sekolah_id  = $request->input('jenis_sekolah_id');
                $sekolah->npsn              = $request->input('npsn');
                $sekolah->alamat            = $request->input('alamat');
                $sekolah->logo              = $request->input('logo');
                $sekolah->foto_gedung       = $request->input('foto_gedung');
                $sekolah->province_id       = $request->input('province_id');
                $sekolah->city_id           = $request->input('city_id');
                $sekolah->district_id       = $request->input('district_id');
                $sekolah->village_id        = $request->input('village_id');
                $sekolah->no_telp           = $request->input('no_telp');
                $sekolah->email             = $request->input('email');
                $sekolah->zona_id           = $request->input('zona_id');
                $sekolah->user_id           = $request->input('user_id');
                    $sekolah->save();
                    $response['message'] = 'success';
            }

        } else {
            $sekolah->label             = $request->input('label');
                $sekolah->jenis_sekolah_id  = $request->input('jenis_sekolah_id');
                $sekolah->npsn              = $request->input('npsn');
                $sekolah->alamat            = $request->input('alamat');
                $sekolah->logo              = $request->input('logo');
                $sekolah->foto_gedung       = $request->input('foto_gedung');
                $sekolah->province_id       = $request->input('province_id');
                $sekolah->city_id           = $request->input('city_id');
                $sekolah->district_id       = $request->input('district_id');
                $sekolah->village_id        = $request->input('village_id');
                $sekolah->no_telp           = $request->input('no_telp');
                $sekolah->email             = $request->input('email');
                $sekolah->zona_id           = $request->input('zona_id');
                $sekolah->user_id           = $request->input('user_id');
            $sekolah->save();
            $response['message'] = 'success';
        }

        $response['status'] = true;
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sekolah = $this->sekolah->findOrFail($id);

        if ($sekolah->delete()) {
            $response['message']    = 'Success';
            $response['success']    = true;
            $response['status']     = true;
        } else {
            $response['message']    = 'Failed';
            $response['success']    = false;
            $response['status']     = false;
        }

        return json_encode($response);
    }
}
