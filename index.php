<?php 
include "session.php"; 
require_login();
?> 
<?php include "layout/header.php"; ?>

<div class="flex justify-between items-center mb-6 border-b pb-4">
    <h2 class="text-3xl font-bold text-gray-800">Daftar Kontak</h2>
    <a href="add.php" class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition duration-150 ease-in-out shadow-md">
        + Tambah Kontak
    </a>
</div>


<div class="overflow-x-auto shadow-xl rounded-xl border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-green-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Telepon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-green-800 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php
            $contacts = $_SESSION['contacts'] ?? [];
            if (!empty($contacts)):
            ?>
                <?php foreach ($contacts as $c): ?>
                <tr class="hover:bg-green-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900"><?= htmlspecialchars($c['name']); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($c['phone']); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($c['email']); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        <a href="edit.php?id=<?= $c['id']; ?>" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out mr-3">Edit</a> 
                        <a href="delete.php?id=<?= $c['id']; ?>" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out" onclick="return confirm('Yakin ingin menghapus kontak ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data kontak.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "layout/footer.php"; ?>