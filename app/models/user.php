<?php

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $passwordHash;
    private string $createdAt;

    private PDO $db;

    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPasswordHash(string $hash): void
    {
        $this->passwordHash = $hash;
    }

    public function setCreatedAt(string $timestamp): void
    {
        $this->createdAt = $timestamp;
    }

    public function findByEmail(string $email): ?User
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, username, email, password, created_at
                FROM users
                WHERE email = ?
                LIMIT 1
            ");

            $stmt->execute([$email]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            $user = new User($this->db);
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setPasswordHash($row['password']);
            $user->setCreatedAt($row['created_at']);

            return $user;
        } catch (PDOException $e) {
            error_log("Database error in findByEmail: " . $e->getMessage());
            return null;
        }
    }

    public function findById(int $id): ?User
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, username, email, password, created_at
                FROM users
                WHERE id = ?
                LIMIT 1
            ");

            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            $user = new User($this->db);
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setPasswordHash($row['password']);
            $user->setCreatedAt($row['created_at']);

            return $user;
        } catch (PDOException $e) {
            error_log("Database error in findById: " . $e->getMessage());
            return null;
        }
    }

    public function create(string $username, string $email, string $passwordHash): ?User
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO users (username, email, password, created_at)
                VALUES (:username, :email, :password, NOW())
            ");

            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $newId = (int) $this->db->lastInsertId();

                return $this->findById($newId);
            }

            return null;
        } catch (PDOException $e) {
            error_log("Database error in create: " . $e->getMessage());
            
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                error_log("Email already exists: " . $email);
            }

            return null;
        }
    }

    public function verifyPassword(string $plainPassword, string $hash): bool
    {
        return password_verify($plainPassword, $hash);
    }
}
?>