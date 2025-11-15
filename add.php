<?php
include "session.php";

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
        $newId = end($_SESSION['contacts'])['id'] + 1;

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

<h2 class="text-xl font-semibold mb-4">Tambah Kontak</h2>

<?php if ($error): ?>
<p class="text-red-600"><?= $error ?></p>
<?php endif; ?>

<form method="POST" class="space-y-3">
    <input type="text" name="name" placeholder="Nama" class="w-full border p-2" required>
    <input type="text" name="phone" placeholder="Telepon" class="w-full border p-2" required>
    <input type="email" name="email" placeholder="Email" class="w-full border p-2" required>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php include "layout/footer.php"; ?>
