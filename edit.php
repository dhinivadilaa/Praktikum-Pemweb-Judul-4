<?php
include "session.php";

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
    }
}
?>

<?php include "layout/header.php"; ?>

<h2 class="text-xl font-semibold mb-4">Edit Kontak</h2>

<?php if ($error): ?>
<p class="text-red-600"><?= $error ?></p>
<?php endif; ?>

<form method="POST" class="space-y-3">
    <input type="text" name="name" value="<?= $contact['name']; ?>" class="w-full border p-2" required>
    <input type="text" name="phone" value="<?= $contact['phone']; ?>" class="w-full border p-2" required>
    <input type="email" name="email" value="<?= $contact['email']; ?>" class="w-full border p-2" required>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>

<?php include "layout/footer.php"; ?>
