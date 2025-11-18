<?php
include "session.php";

if (is_logged_in()) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (isset(USERS[$username]) && USERS[$username] === $password) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login </title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-white p-8 rounded-xl shadow-2xl border border-gray-200">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Login</h2>
        
        <p class="text-sm text-center text-gray-500 mb-6">
            
        </p>

        <?php if ($error): ?>
        <p class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?= $error ?>
        </p>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
            </div>
            
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition duration-150 ease-in-out shadow-lg">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>