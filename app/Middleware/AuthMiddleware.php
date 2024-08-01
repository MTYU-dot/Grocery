<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class AuthMiddleware
{
  public function __invoke(Request $request, Response $response, $next)
  {
    // Contoh: Cek apakah pengguna sudah login
    if (!isset($_SESSION['user'])) {
      // Jika belum login, redirect ke halaman login
      return $response->withRedirect('/formLogin');
    }

    // Jika sudah login, lanjutkan ke handler rute selanjutnya
    $response = $next($request, $response);
    return $response;
  }
}
