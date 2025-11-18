<?php
include "session.php";
require_login();

$id = $_GET["id"];
$contact = null;

foreach ($_SESSION['contacts'] as $c) {
    if ($c['id'] == $id) {
        $contact = $c;
        break;
    }
}

if (!$contact) {
    die("Kontak tidak ditemukan!");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);

    if (empty($name) || empty($phone) || empty($email)) {
        $error = "Semua field wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid!";
    } elseif (!preg_match("/^[0-9]+$/", $phone)) {
        $error = "Nomor telepon hanya angka!";
    } else {
        foreach ($_SESSION['contacts'] as &$c) {
            if ($c['id'] == $id) {
                $c['name'] = $name;
                $c['phone'] = $phone;
                $c['email'] = $email;
                break;
            }
        }
        header("Location: index.php");
        exit;
    }
}
?>

<?php include "layout/header.php"; ?>

<h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-4">Edit Kontak: <?= htmlspecialchars($contact['name']); ?></h2>

<?php if ($error): ?>
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
    <strong class="font-bold">Error!</strong>
    <span class="block sm:inline"><?= $error ?></span>
</div>
<?php endif; ?>

<form method="POST" class="space-y-6 bg-green-50 p-8 rounded-xl shadow-lg border border-green-200">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($contact['name']); ?>" class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-green-600 focus:border-green-600 shadow-sm transition duration-150" required>
    </div>
    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($contact['phone']); ?>" class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-green-600 focus:border-green-600 shadow-sm transition duration-150" required>
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($contact['email']); ?>" class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-green-600 focus:border-green-600 shadow-sm transition duration-150" required>
    </div>

    <div class="pt-2 flex space-x-4">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-150 ease-in-out shadow-lg transform hover:-translate-y-0.5 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Perbarui Kontak
        </button>
        <a href="index.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-3 rounded-lg transition duration-150 ease-in-out shadow-md flex items-center">
            Batal
        </a>
    </div>
</form>

<?php include "layout/footer.php"; ?>