<?php
namespace App\Repository;


use App\Model\UserModel;
use App\Services\Dbconnect;


class UserRepository {
    private \mysqli $db;

    public function __construct() {
        $this->db = (new Dbconnect())->dbConnect();
    }

    public function add(UserModel $user): bool {
        $passwordHash = password_hash($user->password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user->username, $user->email, $passwordHash);
        return $stmt->execute();
    }

    public function checkUser(UserModel $userModel): array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $userModel->username);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            return ['status' => 'failed', 'message' => 'Użytkownik nie istnieje.'];
        }

        if (!password_verify($userModel->password, $user['password'])) {
            return ['status' => 'failed', 'message' => 'Nieprawidłowe hasło.'];
        }
        // var_dump('zalogowano'); exit;
        // $_SESSION['user_id'] = $user['id'];
        // $_SESSION['username'] = $user['username'];

        return ['status' => 'success', 'message' => 'Zalogowano.', 'user' => ['id' => $user['id'], 'email' => $user['email']]];
    }  
}
