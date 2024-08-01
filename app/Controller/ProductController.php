<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Psr\Container\ContainerInterface;


class ProductController
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


  public function index(Request $request, Response $response, $args)
  {
    $products = $this->db->select('products', [
      '[>]categories' => ['category_id' => 'category_id']
    ], [
      'products.product_id',
      'products.product_name',
      'products.category_id',
      'categories.category_name',
      'products.image',
      'products.description',
      'products.price_per_kg',
      'products.stock'
    ],);
    // Mengambil data kategori tanpa join
    $categories = $this->db->select('categories', '*');

    // Mengambil data users
    $user_id = $_SESSION['user_id'];
    $user = $this->db->get('users', '*', ['user_id' => $user_id]);

    // Get flash messages from previous request
    $messages = $this->flash->getMessages();
    // print_r($messages);


    return $this->view->render($response, 'user/home.html', [
      'products' => $products,
      'categories' => $categories,
      'user' => $user,
      'messages' => $messages,
    ]);
  }

  public function showProducts(Request $request, Response $response, $args)
  {
    $products = $this->db->select('products', [
      '[>]categories' => ['category_id' => 'category_id']
    ], [
      'products.product_id',
      'products.product_name',
      'products.category_id',
      'categories.category_name',
      'products.image',
      'products.description',
      'products.price_per_kg',
      'products.stock'
    ]);
    // Mengambil data kategori tanpa join
    $categories = $this->db->select('categories', '*');

    // Mengambil data users
    $user_id = $_SESSION['user_id'];
    $user = $this->db->get('users', '*', ['user_id' => $user_id]);

    // Get flash messages from previous request
    $messages = $this->flash->getMessages();



    return $this->view->render($response, 'admin/products.html', [
      'products' => $products,
      'categories' => $categories,
      'messages' => $messages,
      'user' => $user,
    ]);
  }

  public function add(Request $request, Response $response, $args)
  {
    if ($request->getMethod() === 'POST') {
      $uploadedFiles = $request->getUploadedFiles();
      $productImage = $uploadedFiles['image'];

      // Handle the file upload
      if ($productImage->getError() === UPLOAD_ERR_OK) {
        $filename = $this->moveUploadedFile(__DIR__ . '/../../public/images', $productImage);
      }

      // Get other form data
      $data = $request->getParsedBody();
      $data['image'] = $filename;

      // Insert data into database
      $this->db->insert('products', [
        'product_name' => $data['product_name'],
        'category_id' => $data['category_id'],
        'image' => $data['image'],
        'description' => $data['description'],
        'price_per_kg' => $data['price_per_kg'],
        'stock' => $data['stock']
      ]);

      $this->flash->addMessage('success', 'Produk berhasil ditambahkan.');
      // error_log('Flash message added: Produk berhasil ditambahkan.');

      return $response->withRedirect('/products');
    }

    return $response->withStatus(400)->write('Invalid request method');
  }

  public function edit(Request $request, Response $response, $args)
  {
    $productId = $args['id'];

    if ($request->isPost()) {
      $uploadedFiles = $request->getUploadedFiles();
      $productImage = $uploadedFiles['image'];

      // Ambil data produk lama
      $oldProduct = $this->db->get('products', '*', ['product_id' => $productId]);

      $filename = $oldProduct['image']; // Default to old image

      // Handle the file upload
      if ($productImage->getError() === UPLOAD_ERR_OK) {
        // Hapus gambar lama jika ada
        $oldImagePath = __DIR__ . '/../../public/images/' . $oldProduct['image'];
        if ($oldProduct['image'] && file_exists($oldImagePath)) {
          unlink($oldImagePath);
        }
        $filename = $this->moveUploadedFile(__DIR__ . '/../../public/images', $productImage);
      }

      // Get other form data
      $data = $request->getParsedBody();
      $data['image'] = $filename;

      // Update data dalam database
      $this->db->update('products', [
        'product_name' => $data['product_name'],
        'category_id' => $data['category_id'],
        'image' => $data['image'],
        'description' => $data['description'],
        'price_per_kg' => $data['price_per_kg'],
        'stock' => $data['stock']
      ], ['product_id' => $productId]);

      $this->flash->addMessage('success', 'Produk berhasil diedit.');
      error_log('Flash message added: Produk berhasil ditambahkan.');

      return $response->withRedirect('/products');
    }

    return $response->withStatus(400)->write('Invalid request method');
  }

  public function delete(Request $request, Response $response, $args)
  {
    $productId = $args['id'];

    // Ambil data produk lama
    $oldProduct = $this->db->get('products', '*', ['product_id' => $productId]);

    // Hapus gambar lama jika ada
    $oldImagePath = __DIR__ . '/../../public/images/' . $oldProduct['image'];
    if ($oldProduct['image'] && file_exists($oldImagePath)) {
      unlink($oldImagePath);
    }

    // Hapus data produk dari database
    $this->db->delete('products', ['product_id' => $productId]);

    return $response;
  }

  private function moveUploadedFile($directory, UploadedFile $uploadedFile)
  {
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
  }

  public function cart(Request $request, Response $response, $args)
  {



    return $this->view->render($response, 'user/cart.html', []);
  }
}
