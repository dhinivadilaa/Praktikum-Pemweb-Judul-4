<?php
include "session.php";
require_login();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name  = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);

    if (empty($name) || empty($phone) || empty($email)) {
        $error = "Semua field wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } elseif (!preg_match("/^[0-9]+$/", $phone)) {
        $error = "Nomor telepon hanya boleh angka!";
    } else {
  
        $maxId = 0;
        foreach ($_SESSION['contacts'] as $c) {
            if ($c['id'] > $maxId) {
                $maxId = $c['id'];
            }
        }
        $newId = $maxId + 1;

        $_SESSION['contacts'][] = [
            "id" => $newId,
            "name" => $name,
            "phone" => $phone,
            "email" => $email
        ];
        header("Location: index.php");
    }
}
?>

<?php include "layout/header.php"; ?>

<h2 class="text-2xl font-semibold mb-6 text-gray-700">Tambah Kontak Baru</h2>

<?php if ($error): ?>
<p class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    <?= $error ?>
</p>
<?php endif; ?>

<form method="POST" class="space-y-4 bg-gray-50 p-6 rounded-lg shadow-inner">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" id="name" name="name" placeholder="Nama Lengkap" class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
    </div>
    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
        <input type="text" id="phone" name="phone" placeholder="Nomor Telepon (Hanya Angka)" class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" placeholder="Alamat Email" class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
    </div>

    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-150 ease-in-out shadow-md">Simpan Kontak</button>
    <a href="index.php" class="ml-4 text-gray-600 hover:text-gray-800 font-medium">Batal</a>
</form>

<?php include "layout/footer.php"; ?>