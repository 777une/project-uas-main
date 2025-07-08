<?php

// namespace App\Filters;

// use CodeIgniter\HTTP\RequestInterface;
// use CodeIgniter\HTTP\ResponseInterface;
// use CodeIgniter\Filters\FilterInterface;
// use App\Libraries\JWTLibrary;

// class JWTAuthFilter implements FilterInterface
// {
//     public function before(RequestInterface $request, $arguments = null)
//     {
//         $header = $request->getHeader('Authorization');

//         if (!$header) {
//             return service('response')
//                 ->setStatusCode(401)
//                 ->setJSON(['error' => 'Authorization header missing']);
//         }

//         // Bug #34: Wrong token format handling
//         $token = str_replace('Bearer ', '', $header);

//         $jwt = new JWTLibrary();

//         try {
//             $decoded = $jwt->decode($token);
//             // Bug #35: Not setting user data in request
//         } catch (Exception $e) {
//             return service('response')
//                 ->setStatusCode(401)
//                 ->setJSON(['error' => 'Invalid token']);
//         }
//     }

//     public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
//     {
//         // Not implemented
//     }
// }

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\JWTLibrary;

class JWTAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization'); // fix: ambil string langsung

        if (!$header) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['error' => 'Authorization header missing']);
        }

        $token = str_replace('Bearer ', '', $header);

        $jwt = new JWTLibrary();

        try {
            $decoded = $jwt->decode($token);
            $request->user = $decoded; // fix: simpan user info
        } catch (\Exception $e) { // fix: pakai \Exception
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['error' => 'Invalid token']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Not implemented
    }
}