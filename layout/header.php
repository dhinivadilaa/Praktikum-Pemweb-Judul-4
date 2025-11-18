<?php

$current_page = basename($_SERVER['PHP_SELF']);

function active_class($page, $current) {
    return $page === $current
        ? 'bg-green-700 text-white font-semibold'
        : 'hover:bg-green-700 hover:text-white text-white';
}

function get_page_title($current) {
    switch ($current) {
        case 'index.php': return 'Daftar Kontak';
        case 'add.php': return 'Tambah Kontak Baru';
        case 'edit.php': return 'Edit Kontak';
        default: return 'Beranda';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Manajemen Kontak | <?= get_page_title($current_page) ?></title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { font-family: 'Inter', sans-serif; }
</style>
</head>

<body class="bg-gray-50 min-h-screen">

    <header class="w-full bg-green-600 hover:bg-green-700 text-white shadow-lg transition duration-150">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">
                Sistem Manajemen Kontak
            </h1>

            <nav class="flex space-x-4">

                <a href="index.php"
                   class="px-4 py-2 rounded-lg transition duration-150 <?= active_class('index.php', $current_page) ?>">
                    Beranda
                </a>

                <a href="add.php"
                   class="px-4 py-2 rounded-lg transition duration-150 <?= active_class('add.php', $current_page) ?>">
                    Tambah Kontak
                </a>

                <?php if (is_logged_in()): ?>
                    <span class="px-3 py-2 text-white/80">
                      Hello <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
                    </span>

                    <a href="logout.php"
                       class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition duration-150">
                        Keluar
                    </a>
                <?php endif; ?>

            </nav>
        </div>
    </header>
    
    <main class="p-8">
        <div class="bg-white p-8 shadow-2xl rounded-xl max-w-5xl mx-auto">
