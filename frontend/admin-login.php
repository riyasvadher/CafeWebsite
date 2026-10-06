<?php
session_start();

$adminUsername = 'admin';
$adminPassword = 'admin123';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = trim($_POST['username'] ?? '');
	$password = $_POST['password'] ?? '';

	if ($username === $adminUsername && $password === $adminPassword) {
		$_SESSION['is_admin'] = true;
		header('Location: admin-index.php');
		exit;
	}

	$errorMessage = 'Invalid username or password.';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Login | Café Bliss</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
	<main class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
		<div class="card shadow-sm" style="max-width: 420px; width: 100%;">
			<div class="card-body p-4">
				<h1 class="h3 text-center mb-4">Admin Login</h1>

				<?php if ($errorMessage !== ''): ?>
					<div class="alert alert-danger" role="alert">
						<?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?>
					</div>
				<?php endif; ?>

				<form method="post" action="admin-login.php">
					<div class="mb-3">
						<label for="username" class="form-label">Username</label>
						<input type="text" class="form-control" id="username" name="username" required autofocus>
					</div>
					<div class="mb-4">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<button type="submit" class="btn btn-primary w-100">Log In</button>
				</form>
			</div>
		</div>
	</main>
</body>

</html>
