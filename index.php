<?php include "session.php"; ?>
<?php include "layout/header.php"; ?>

<a href="add.php" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Tambah Kontak
</a>

<table class="w-full border">
    <tr class="bg-gray-200">
        <th class="border px-4 py-2">Nama</th>
        <th class="border px-4 py-2">Telepon</th>
        <th class="border px-4 py-2">Email</th>
        <th class="border px-4 py-2">Aksi</th>
    </tr>

    <?php foreach ($_SESSION['contacts'] as $c): ?>
    <tr>
        <td class="border px-4 py-2"><?= htmlspecialchars($c['name']); ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($c['phone']); ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($c['email']); ?></td>
        <td class="border px-4 py-2">
            <a href="edit.php?id=<?= $c['id']; ?>" class="text-blue-600">Edit</a> |
            <a href="delete.php?id=<?= $c['id']; ?>" class="text-red-600">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include "layout/footer.php"; ?>
