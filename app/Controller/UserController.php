<?php

namespace App\Controller;


use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Psr\Container\ContainerInterface;

class UserController
{
  protected $db;
  protected $view;
  protected $flash;

  // Constructor untuk dependency injection
  public function __construct(ContainerInterface $container)
  {
    // Ambil dependensi dari container dan simpan sebagai properti kelas
    $this->db = $container->get('db');
    $this->view = $container->get('view');
    $this->flash = $container->get('flash');
  }

  public function formLogin(Request $request, Response $response, $args)
  {
    $messages = $this->flash->getMessages();
    return $this->view->render($response, 'login/login.html', [
      'messages' => $messages
    ]);
  }

  public function formRegister(Request $request, Response $response, $args)
  {
    $messages = $this->flash->getMessages();
    return $this->view->render($response, 'login/register.html', [
      'messages' => $messages
    ]);
  }


  public function login(Request $request, Response $response, $args)
  {
    // Ambil data dari body request
    $data = $request->getParsedBody();
    $username = isset($data['username']) ? $data['username'] : '';
    $password = isset($data['password']) ? $data['password'] : '';


    // Proses autentikasi login disini, misalnya cek ke database
    $user = $this->db->get('users', '*', ['username' => $username]);

    if ($user && password_verify($password, $user['password'])) {
      // Password cocok, proses login berhasil
      $_SESSION['user'] = [
        $_SESSION['user_id'] = $user['user_id'],
        'username' => $user['username'],
        'role_id' => $user['role_id'],
      ];

      $this->flash->addMessage('success', 'Login berhasil.');
      return $response->withRedirect('/index'); // Redirect ke halaman setelah login berhasil
    } else {
      // Password tidak cocok
      $this->flash->addMessage('error', 'Invalid username or password.');
      return $response->withRedirect('/formLogin');
    }
  }

  public function register(Request $request, Response $response, $args)
  {
    $data = $request->getParsedBody();
    $username = $data['username'];
    $email = $data['email'];
    $profile = 'profile.jpg';
    $password = $data['password'];
    $confirm_password = $data['confirm_password'];
    $role_id = 2; // Default role_id untuk user
    $created_at = date('Y-m-d H:i:s'); // Waktu saat ini

    // Validasi bahwa password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
      $this->flash->addMessage('error', 'Passwords do not match!');
    } else {
      // Validasi username unik
      $existingUsername = $this->db->get('users', 'username', ['username' => $username]);
      if ($existingUsername) {
        $this->flash->addMessage('error', 'Username already exists!');
      } else {
        // Validasi email unik
        $existingEmail = $this->db->get('users', 'email', ['email' => $email]);
        if ($existingEmail) {
          $this->flash->addMessage('error', 'Email already exists!');
        } else {
          // Hash password
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);

          // Insert ke database menggunakan Medoo
          try {
            $db = $this->db;
            $db->insert('users', [
              'username' => $username,
              'email' => $email,
              'password' => $hashed_password,
              'profile' => $profile,
              'role_id' => $role_id,
              'created_at' => $created_at
            ]);

            $this->flash->addMessage('success', 'Registration successful! You can now log in.');
            return $response->withRedirect('/formLogin'); // Redirect ke halaman login setelah registrasi berhasil
          } catch (\Exception $e) {
            $this->flash->addMessage('error', 'Registration failed: ' . $e->getMessage());
          }
        }
      }
    }

    // Kembali ke halaman registrasi dengan pesan error
    return $response->withRedirect('/formRegister');
  }

  public function logout(Request $request, Response $response, $args)
  {
    // Hapus data session
    session_unset();
    session_destroy();

    // Redirect ke halaman login atau halaman utama
    return $response->withRedirect('/index');
  }

  public function accountSetting(Request $request, Response $response, $args)
  {
    $user_id = $_SESSION['user_id'];
    $user = $this->db->get('users', '*', ['user_id' => $user_id]);

    if (!$user) {
      // Handle jika data pengguna tidak ditemukan, misalnya dengan melempar exception atau menampilkan pesan kesalahan
      throw new \Exception('Data pengguna tidak ditemukan.');
    }

    $messages = $this->flash->getMessages();
    // Render halaman profil
    return $this->view->render($response, 'user/setting.html', [
      'user' => $user,
      'messages' => $messages
    ]);
  }


  public function editProfile(Request $request, Response $response, $args)
  {
    $user_id = $args['id'];

    if ($request->isPost()) {

      $data = $request->getParsedBody();

      $existingUser = $this->db->select('users', '*', [
        'email' => $data['email'],
        'user_id[!]' => $user_id // pengecualian untuk user yang sedang diedit
      ]);

      if (!empty($existingUser)) {
        // Email sudah digunakan oleh user lain, kembalikan pesan kesalahan
        $this->flash->addMessage('error', 'Email sudah digunakan oleh user lain.');
        return $response->withRedirect('/accountSetting'); // Kembali ke halaman pengaturan akun
      }

      // Update data dalam database
      $this->db->update('users', [
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'gender' => $data['gender'],
        'tanggal_lahir' => $data['tanggal_lahir'],
        'no_telp' => $data['no_telp'],
        'alamat' => $data['alamat'],
        'updated_at' => date('Y-m-d H:i:s'), // update waktu saat ini
      ], ['user_id' => $user_id]);

      $this->flash->addMessage('success', 'Profil berhasil diedit.');

      return $response->withRedirect('/accountSetting');
    }

    return $response->withStatus(400)->write('Invalid request method');
  }

  public function uploadProfilePicture(Request $request, Response $response, $args)
  {
    if (!isset($_SESSION['user'])) {
      return $response->withRedirect('/formLogin');
    }

    $uploadedFiles = $request->getUploadedFiles();
    $user_id = $_SESSION['user_id'];

    // Tangani file upload
    if (isset($uploadedFiles['profile'])) {
      $profilePicture = $uploadedFiles['profile'];
      if ($profilePicture->getError() === UPLOAD_ERR_OK) {
        $filename = $this->moveUploadedFile('images/user/', $profilePicture);
        // Simpan path foto ke database
        $this->db->update('users', ['profile' => $filename], ['user_id' => $user_id]);
        // Update session
        // $_SESSION['user']['profile'] = $filename;
        $this->flash->addMessage('success', 'Profile picture updated successfully.');
      } else {
        $this->flash->addMessage('error', 'Error uploading profile picture.');
      }
    } else {
      $this->flash->addMessage('error', 'No file uploaded.');
    }

    return $response->withRedirect('/accountSetting',);
  }

  private function moveUploadedFile($directory, UploadedFile $uploadedFile)
  {
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
  }
}
