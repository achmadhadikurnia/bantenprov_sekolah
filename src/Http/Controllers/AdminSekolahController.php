<?php

namespace Bantenprov\Sekolah\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\Sekolah\Facades\SekolahFacade;

/* Models */
use Bantenprov\Sekolah\Models\Bantenprov\Sekolah\AdminSekolah;
use Bantenprov\Sekolah\Models\Bantenprov\Sekolah\Sekolah;
use App\User;

/* Etc */
use Validator;
use Auth;

/**
 * The ProdiSekolahController class.
 *
 * @package Bantenprov\Sekolah
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class AdminSekolahController extends Controller
{
    protected $admin_sekolah;
    protected $sekolah;
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->admin_sekolah    = new AdminSekolah;
        $this->sekolah          = new Sekolah;
        $this->user             = new User;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin_sekolah = $this->admin_sekolah->where('admin_sekolah_id', Auth::user()->id)->first();

        if(is_null($admin_sekolah) && $this->checkRole(['superadministrator']) === false){
            $response = [];
            return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
        }

        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);

            if($this->checkRole(['superadministrator'])){
                $query = $this->admin_sekolah->orderBy($sortCol, $sortDir);
            }else{
                $query = $this->admin_sekolah->where('sekolah_id', $admin_sekolah->sekolah_id)->orderBy($sortCol, $sortDir);
            }
        } else {
            if($this->checkRole(['superadministrator'])){
                $query = $this->admin_sekolah->orderBy('id', 'asc');
            }else{
                $query = $this->admin_sekolah->where('admin_sekolah_id', $admin_sekolah->sekolah_id)->orderBy('id', 'asc');
            }
        }

        if ($request->exists('filter')) {
            if($this->checkRole(['superadministrator'])){
                $query->where(function($q) use($request) {
                    $value = "%{$request->filter}%";

                    $q->where('sekolah_id', 'like', $value)
                        ->orWhere('admin_sekolah_id', 'like', $value);
                });
            }else{
                $query->where(function($q) use($request, $admin_sekolah) {
                    $value = "%{$request->filter}%";

                    $q->where('sekolah_id', $admin_sekolah->sekolah_id)->where('sekolah_id', 'like', $value);
                });
            }

        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;

        $response = $query->with(['admin_sekolah', 'sekolah', 'user'])->paginate($perPage);

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
        $admin_sekolahs = $this->admin_sekolah->with(['sekolah', 'user'])->get();

        $response['admin_sekolahs'] = $admin_sekolahs;
        $response['error']          = false;
        $response['message']        = 'Success';
        $response['status']         = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBySekolah($id)
    {
        $admin_sekolahs = $this->admin_sekolah->where('sekolah_id', '=', $id)->with(['sekolah', 'user'])->get();

        $response['admin_sekolahs'] = $admin_sekolahs;
        $response['message']        = 'Success';
        $response['error']          = false;
        $response['status']         = true;

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id            = isset(Auth::User()->id) ? Auth::User()->id : null;
        $admin_sekolah      = $this->admin_sekolah->getAttributes();
        $users              = $this->user->getAttributes();
        $users_special      = $this->user->all();
        $users_standar      = $this->user->findOrFail($user_id);
        $current_user       = Auth::User();
        $admins             = [];

        foreach($users_special as $user){
            if($user->hasRole(['superadministrator','administrator'])){
                array_set($user, 'label', $user->name);
                array_push($admins, $user);
            }
        }

        array_set($current_user, 'label', $current_user->name);

        $response['admin_sekolah']      = $admin_sekolah;
        $response['users']              = $admins;
        $response['user_special']       = true;
        $response['current_user']       = $current_user;
        $response['error']              = false;
        $response['message']            = 'Success';
        $response['status']             = true;

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
        if($this->checkRole(['superadministrator'])){
            $admin_sekolah = $this->admin_sekolah;

            $validator = Validator::make($request->all(), [
                'sekolah_id'            => "required|exists:{$this->sekolah->getTable()},id",
                'admin_sekolah_id'      => "required|unique:{$this->admin_sekolah->getTable()},admin_sekolah_id,NULL,id,deleted_at,NULL",
            ]);

            if ($validator->fails()) {
                $error      = true;
                $message    = $validator->errors()->first();
            } else {
                $admin_sekolah->sekolah_id          = $request->input('sekolah_id');
                $admin_sekolah->admin_sekolah_id    = $request->input('admin_sekolah_id');
                $admin_sekolah->user_id             = Auth::user()->id;
                $admin_sekolah->save();

                $error      = false;
                $message    = 'Success';
            }

            $response['admin_sekolah']  = $admin_sekolah;
            $response['error']          = $error;
            $response['message']        = $message;
            $response['status']         = true;

            return response()->json($response);
        }else{

            $response['error']          = true;
            $response['message']        = 'Maaf anda Tidak mempunyai hak akses untuk ini.';
            $response['status']         = true;

            return response()->json($response);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProdiSekolah  $prodi_sekolah
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin_sekolah = $this->admin_sekolah->with(['sekolah', 'admin_sekolah', 'user'])->findOrFail($id);

        $response['admin_sekolah']  = $admin_sekolah;
        $response['error']          = false;
        $response['message']        = 'Success';
        $response['status']         = true;

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
        $user_id            = isset(Auth::User()->id) ? Auth::User()->id : null;
        $admin_sekolah      = $this->admin_sekolah->with(['sekolah', 'admin_sekolah', 'user'])->findOrFail($id);
        $users              = $this->user->getAttributes();
        $users_special      = $this->user->all();
        $users_standar      = $this->user->findOrFail($user_id);
        $current_user       = Auth::User();
        $admins             = [];


        $role_check = Auth::User()->hasRole(['superadministrator','administrator']);

        if ($admin_sekolah->user !== null) {
            array_set($admin_sekolah->user, 'label', $admin_sekolah->user->name);
        }

        if ($admin_sekolah->admin_sekolah !== null) {
            array_set($admin_sekolah->admin_sekolah, 'label', $admin_sekolah->admin_sekolah->name);
        }

        foreach($users_special as $user){
            if($user->hasRole(['superadministrator','administrator'])){
                array_set($user, 'label', $user->name);
                array_push($admins, $user);
            }
        }

        array_set($current_user, 'label', $current_user->name);

        $response['admin_sekolah']      = $admin_sekolah;
        $response['users']              = $admins;
        $response['user_special']       = true;
        $response['current_user']       = $current_user;
        $response['error']              = false;
        $response['message']            = 'Success';
        $response['status']             = true;

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
        if($this->checkRole(['superadministrator'])){
            $admin_sekolah = $this->admin_sekolah->with(['sekolah', 'admin_sekolah', 'user'])->findOrFail($id);

            $validator = Validator::make($request->all(), [
                'sekolah_id'            => "required|exists:{$this->sekolah->getTable()},id",
                'admin_sekolah_id'      => "required|unique:{$this->admin_sekolah->getTable()},admin_sekolah_id,{$id},id,deleted_at,NULL",
            ]);

            if ($validator->fails()) {
                $error      = true;
                $message    = $validator->errors()->first();
            } else {
                $admin_sekolah->sekolah_id          = $request->input('sekolah_id');
                $admin_sekolah->admin_sekolah_id    = $request->input('admin_sekolah_id');
                $admin_sekolah->user_id             = Auth::user()->id;
                $admin_sekolah->save();

                $error      = false;
                $message    = 'Success';
            }

            $response['admin_sekolah']  = $admin_sekolah;
            $response['error']          = $error;
            $response['message']        = $message;
            $response['status']         = true;

            return response()->json($response);
        }else{
            $response['error']          = true;
            $response['message']        = 'Maaf anda Tidak mempunyai hak akses untuk ini.';
            $response['status']         = true;

            return response()->json($response);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkRole(['superadministrator'])){
            $admin_sekolah = $this->admin_sekolah->findOrFail($id);

            if ($admin_sekolah->delete()) {
                $response['message']    = 'Success';
                $response['success']    = true;
                $response['status']     = true;
            } else {
                $response['message']    = 'Failed';
                $response['success']    = false;
                $response['status']     = false;
            }

            return json_encode($response);
        }else{
            $response['message']    = 'Failed';
            $response['success']    = false;
            $response['status']     = false;
            return json_encode($response);
        }
    }

    protected function checkRole($role = array())
    {
        return Auth::user()->hasRole($role);
    }
}
