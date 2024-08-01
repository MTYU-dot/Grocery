<?php
include '../config.php';

if (isset($_POST['tambah'])) {
  $product_name = $_POST['product_name'];
  $category_id = $_POST['category_id'];
  $description = $_POST['description'];
  $price_per_kg = $_POST['price_per_kg'];
  $stock = $_POST['stock'];

  // Direktori tempat menyimpan gambar
  $targetDir = "../../img/products/";

  // Informasi tentang file gambar yang diunggah
  $file_tmp = $_FILES['image']['tmp_name'];
  $file_type = $_FILES['image']['type'];

  // Validasi tipe file gambar yang diizinkan
  if ($file_type == 'image/jpeg') {
      $source = imagecreatefromjpeg($file_tmp);
  } elseif ($file_type == 'image/png') {
      $source = imagecreatefrompng($file_tmp);
  } elseif ($file_type == 'image/gif') {
      $source = imagecreatefromgif($file_tmp);
  } else {
      echo "Please select only jpg, png and gif image";
      exit();
  }

  // Dimensi gambar asli
  list($width, $height) = getimagesize($file_tmp);

  // Dimensi baru untuk gambar yang diresize (misalnya 1/4 dari ukuran asli)
  // Tetapkan dimensi yang diinginkan
  $nwidth = 800; // Lebar maksimum yang diinginkan
  $nheight = 600; // Tinggi maksimum yang diinginkan


  // Buat gambar baru yang diresize
  $newimage = imagecreatetruecolor($nwidth, $nheight);
  imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

  // Nama file unik berdasarkan timestamp
  // Dapatkan ekstensi file yang diunggah
  $file_ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

  // Buat nama file baru dengan format timestamp dan ekstensi yang sama
  $file_name = date("Ymd_His") . '_' . uniqid() . '.' . $file_ext;


  // Simpan gambar yang sudah diresize ke direktori target
  if ($file_type == 'image/jpeg') {
      imagejpeg($newimage, $targetDir . $file_name);
  } elseif ($file_type == 'image/png') {
      imagepng($newimage, $targetDir . $file_name);
  } elseif ($file_type == 'image/gif') {
      imagegif($newimage, $targetDir . $file_name);
  }


  $sql = "INSERT INTO products (product_name, category_id, image, description, price_per_kg, stock)
        VALUES ('$product_name', '$category_id', '$file_name', '$description', '$price_per_kg', '$stock')";
  $query = mysqli_query($conn, $sql);

  // Execute the statement
  if ($query) {
    header('Location: products.php?status=sukses');
  } else {
    header('Location: products.php?status=error');
  }
} else {
  die("Akses ditolak");
}
