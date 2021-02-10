<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Member;

use App\Models\User;

use \Firebase\JWT\JWT;

class Auth extends ResourceController
{
    protected $member;
    protected $user;

    public function __construct()
    {
        $this->member = new Member();
        $this->user = new User();
    }

    public function privateKey()
    {
        $privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
-----END RSA PRIVATE KEY-----
EOD;


        return $privateKey;
    }

    public function index()
    {
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));
        $query = $this->user->where(['username' => $username, 'password' => $password])->countAllResults();
        $data = $this->user->where(['username' => $username, 'password' => $password])->first();

        // dd($query);

        if ($query > 0) {
            $secretKey = $this->privateKey();
            $issuer_claim = "THE_CLAIM";
            $audience_claim = "THE_AUDIENCE";
            $isseudat_claim = time();
            $notbefore_claim = $isseudat_claim + 10;
            $expire_claim = $isseudat_claim + 3600;

            $token = [
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $isseudat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => [
                    'id' => $data['id'],
                    'username' => $data['username']
                ]
            ];

            $token = JWT::encode($token, $secretKey);

            $output = [
                'pesan' => 'Login Berhasil',
                'status' => 200,
                'token' => $token,
                'exp' => $expire_claim
            ];

            return $this->respond($output, 200);
        } else {
            $output = [
                'pesan' => 'Login Gagal',
                'status' => 401
            ];
            return $this->respond($output, 401);
        }
    }

    // ...
}
