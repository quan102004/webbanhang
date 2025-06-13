<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/utils/JWTHandler.php');
class AccountController
{
    private $accountModel;
    private $db;

    private $jwtHandler;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
        $this->jwtHandler = new JWTHandler();
    }
    public function register()
    {
        include_once 'app/views/account/register.php';
    }
    public function login()
    {
        include_once 'app/views/account/login.php';
    }
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $role = $_POST['role'] ?? 'user';

            $errors = [];
            if (empty($username))
                $errors['username'] = "Vui lòng nhập username!";
            if (empty($fullName))
                $errors['fullname'] = "Vui lòng nhập fullname!";
            if (empty($password))
                $errors['password'] = "Vui lòng nhập password!";
            if ($password != $confirmPassword)
                $errors['confirmPass'] = "Mật khẩu và
xác nhận chưa khớp!";
            //kiểm tra username đã được đăng ký chưa? 
            $account = $this->accountModel->getAccountByUsername($username);
            if ($account) {
                $errors['account'] = "Tai khoan nay da co nguoi dang ky!";
            }
            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $password);
                if ($result) {
                    header('Location: /webbanhang/account/login');
                }
            }
        }
    }
    public function logout()
    {

        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /webbanhang/product');
        exit;
    }    public function checkLogin()
    {
        // Xử lý form POST từ form HTML
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $user = $this->accountModel->getAccountByUsername($username);
            if ($user && password_verify($password, $user->password)) {
                // Đăng nhập thành công - thiết lập session
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;
                
                // Chuyển hướng đến trang sản phẩm
                header('Location: /webbanhang/product');
                exit;
            } else {
                // Đăng nhập thất bại - hiển thị lỗi trên form
                $error = "Tên đăng nhập hoặc mật khẩu không đúng";
                include_once 'app/views/account/login.php';
                exit;
            }
        }
        // Xử lý yêu cầu API JSON
        else if (!empty(file_get_contents("php://input"))) {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);
            $username = $data['username'] ?? '';
            $password = $data['password'] ?? '';
            $user = $this->accountModel->getAccountByUsername($username);
            if ($user && password_verify($password, $user->password)) {
                $token = $this->jwtHandler->encode([
                    'id' => $user->id,
                    'username' => $user->username
                ]);
                echo json_encode(['token' => $token]);
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Invalid credentials']);
            }
        }
    }
}
?>