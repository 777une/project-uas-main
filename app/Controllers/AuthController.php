<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
// use App\Libraries\JWTLibrary;
helper('jwt');

class AuthController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';
    protected $jwt;
    
    public function __construct()
    {
        $this->jwt = new JWTLibrary();
    }

    public function register()
    {
        $data = $this->request->getPost();

        // Bug #6: No input validation (menambahkan validasi input)
        if (!isset($data['name'], $data['email'], $data['password'])) {
            return $this->failValidationError('Missing required fields');
        }
        $userModel = new UserModel();

        // Bug #7: Password not hashed (password di hash)
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            // 'password' => $data['password']
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ];

        $userId = $userModel->insert($userData);

        if ($userId) {
            unset($userData['password']); // Jangan kembalikan password
            return $this->respond([
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => $userData // Bug #8: Returning password in response
            ]);
        }

        return $this->failServerError('Registration failed');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Bug #9: No input validation (validasi sederhana)
        if (!$email || !$password) {
            return $this->failValidationError('Email and password required');
        }
        
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // Bug #10: Plain text password comparison (periksa password hash)
        if ($user && password_verify($password, $user['password'])) {
            $payload = [
                'user_id' => $user['id'],
                'email' => $user['email'],
                'exp' => time() + 3600
            ];

            // $token = $this->jwt->encode($payload);
            $token = createJWT($payload); // fungsi dari helper
            unset($user['password']);

            return $this->respond([
                'status' => 'success',
                'token' => $token,
                'user' => $user
            ]);
        }

        return $this->failUnauthorized('Invalid credentials');
    }

    public function refresh()
    {
        helper('jwt');

        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return $this->failUnauthorized('Authorization header missing');
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = decodeJWT($token);

            // Buat token baru dengan expired time baru
            $newPayload = [
                'user_id' => $decoded->user_id,
                'email'   => $decoded->email,
                'exp'     => time() + 3600 // 1 jam lagi
            ];

            $newToken = createJWT($newPayload);

            return $this->respond([
                'status' => 'success',
                'token'  => $newToken
            ]);
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid or expired token');
        }
    }
}