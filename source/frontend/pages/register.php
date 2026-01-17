<?php

$error = "";
$success = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $full_name = trim($_POST["fullname"] ?? "");
    $password = $_POST["password"] ?? "";
    $comfirm_password = $_POST["confirm_password"] ?? "";

    if (empty($email) || empty($username) || empty($password)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ!";
    } elseif ($password !== $comfirm_password) {
        $error = "Mật khẩu xác nhận không khớp!";
    }

    if (empty($error)) {
        try {
            // Hash mật khẩu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Chuẩn bị câu lệnh
            $query = "INSERT INTO users (username, full_name, email, password) VALUES (:username, :full_name, :email, :password)";
            
            // Sử dụng biến kết nối PDO
            $stmt = $conn->prepare($query);
            
            // Thực thi
            $stmt->execute([
                ':username' => $username,
                ':full_name' => $full_name,
                ':email' => $email,
                ':password' => $hashed_password
            ]);

            $success = "Đăng ký thành công!";
            
            header("Location: index.php?page=login");
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "Username hoặc Email đã tồn tại!";
            } else {
                $error = "Lỗi hệ thống: " . $e->getMessage();
            }
        }
    }
}
?>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p style="color:green"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<main class="auth-minimal-wrapper">
    <div class="auth-minimal-inner">
        <div class="minimal-card-wrapper">
            <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                
                <div class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                    <img src="frontend/assets/image/logo.png" alt="Logo" class="img-fluid">
                </div>

                <div class="card-body p-sm-5">
                    <h2 class="fs-20 fw-bolder mb-4">Register</h2>
                    <h4 class="fs-13 fw-bold mb-2">Create TechShare Account</h4>
                    <p class="fs-12 fw-medium text-muted">Set up your personal information to start joining the community.</p>
                    
                    <form action="index.php?page=register" method="POST" class="w-100 mt-4 pt-2">
                        
                        <div class="mb-4">
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                        </div>
                        
                        <div class="mb-4">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        
                        <div class="mb-4">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        
                        <div class="mb-4 generate-pass">
                            <div class="input-group field">
                                <input type="password" name="password" class="form-control password" id="newPassword" placeholder="Password" required>
                                <div class="input-group-text c-pointer gen-pass" data-bs-toggle="tooltip" title="Generate Random Password">
                                    <i class="bi bi-hash"></i>
                                </div>
                                <div class="input-group-text border-start bg-gray-2 c-pointer show-pass" data-bs-toggle="tooltip" title="Show/Hide Password">
                                    <i class="bi bi-eye"></i>
                                </div>
                            </div>
                            <div class="progress-bar mt-2">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        
                        <div class="mt-4">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" name="newsletter" class="custom-control-input" id="receiveMail">
                                <label class="custom-control-label c-pointer text-muted" for="receiveMail" style="font-weight: 400 !important">Receive notifications from TechShare</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="termsCondition" required>
                                <label class="custom-control-label c-pointer text-muted" for="termsCondition" style="font-weight: 400 !important">I agree to the <a href="#">Terms & Services</a>.</label>
                            </div>
                        </div>
                        
                        <div class="mt-5">
                            <button type="submit" class="btn btn-lg btn-primary w-100">Register Now</button>
                        </div>
                    </form>
                    
                    <div class="mt-5 text-muted text-center">
                        <span>Already have an account?</span>
                        <a href="index.php?page=login" class="fw-bold">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>