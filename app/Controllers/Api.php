<?php

namespace App\Controllers;

use \Firebase\JWT\JWT;

use App\Controllers\Auth;

use CodeIgniter\RESTful\ResourceController;

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class Api extends ResourceController
{
    protected $modelName = 'App\Models\Member';
    protected $format    = 'json';
    protected $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }

    public function index()
    {
        $privateKey = $this->auth->privateKey();
        $token = null;
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $authHeader);
        $token = $arr[1];

        if ($token) {
            try {
                $decode = JWt::decode($token, $privateKey, array('HS256'));
                if ($decode) {
                    $output = [
                        'message' => 'Akses di Izinkan'
                    ];
                    return $this->respond($this->model->findAll(), 200);
                }
            } catch (\Exception $e) {
                $output = [
                    'message' => 'Akses di Larang',
                    "error" => $e->getMessage()
                ];

                return $this->respond($output, 401);
            }
        }
    }

    public function create()
    {
        $privateKey = $this->auth->privateKey();
        $token = null;
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $authHeader);
        $token = $arr[1];

        if ($token) {
            try {
                $decode = JWt::decode($token, $privateKey, array('HS256'));
                if ($decode) {
                    $data = $this->request->getRawInput();
                    $output = [
                        'message' => 'Akses di Izinkan'
                    ];
                    $this->model->save([
                        'nama' => $data['nama'],
                        'umur' => $data['umur'],
                        'alamat' => $data['alamat']
                    ]);
                    return $this->respond($data, 200);
                }
            } catch (\Exception $e) {
                $output = [
                    'message' => 'Akses di Larang',
                    "error" => $e->getMessage()
                ];

                return $this->respond($output, 401);
            }
        }
    }

    public function update($id = null)
    {
        $privateKey = $this->auth->privateKey();
        $token = null;
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $authHeader);
        $token = $arr[1];

        if ($token) {
            try {
                $decode = JWt::decode($token, $privateKey, array('HS256'));
                if ($decode) {
                    $data = $this->request->getRawInput();
                    $output = [
                        'message' => 'Akses di Izinkan'
                    ];
                    $this->model->save([
                        'id' => $id,
                        'nama' => $data['nama'],
                        'umur' => $data['umur'],
                        'alamat' => $data['alamat']
                    ]);
                    return $this->respond($data, 200);
                }
            } catch (\Exception $e) {
                $output = [
                    'message' => 'Akses di Larang',
                    "error" => $e->getMessage()
                ];

                return $this->respond($output, 401);
            }
        }
    }

    public function delete($id = null)
    {
        $privateKey = $this->auth->privateKey();
        $token = null;
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $authHeader);
        $token = $arr[1];

        if ($token) {
            try {
                $decode = JWt::decode($token, $privateKey, array('HS256'));
                if ($decode) {
                    $output = [
                        'message' => 'Data Berhasil diHapus'
                    ];
                    $this->model->delete($id);
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                    'message' => 'Akses di Larang',
                    "error" => $e->getMessage()
                ];

                return $this->respond($output, 401);
            }
        }
    }

    // ...
}
