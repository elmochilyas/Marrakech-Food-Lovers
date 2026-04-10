<?php

class Recipe
{
    private int $id;
    private int $userId;
    private ?int $categoryId;
    private string $title;
    private string $ingredients;
    private string $instructions;
    private ?int $cookTime;
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getIngredients(): string
    {
        return $this->ingredients;
    }

    public function getInstructions(): string
    {
        return $this->instructions;
    }

    public function getCookTime(): ?int
    {
        return $this->cookTime;
    }



    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setIngredients(string $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    public function setInstructions(string $instructions): void
    {
        $this->instructions = $instructions;
    }


    public function setCookTime(?int $cookTime): void
    {
        $this->cookTime = $cookTime;
    }


    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getAll(): array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT r.*, u.username, u.email 
                FROM recipes r
                LEFT JOIN users u ON r.user_id = u.id
                ORDER BY r.created_at DESC
            ");
            $stmt->execute();

            $recipes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $recipe = new Recipe($this->db);
                $recipe->setId($row['id']);
                $recipe->setUserId($row['user_id']);
                $recipe->setCategoryId($row['category_id']);
                $recipe->setTitle($row['title']);
                $recipe->setIngredients($row['ingredients']);
                $recipe->setInstructions($row['instructions']);
                $recipe->setCookTime($row['cook_time']);
                $recipe->setCreatedAt($row['created_at']);
                $recipe->setUsername($row['username'] ?? 'Unknown');
                $recipes[] = $recipe;
            }

            return $recipes;
        } catch (PDOException $e) {
            error_log("Database error in getAll: " . $e->getMessage());
            return [];
        }
    }

    private ?string $username = null;

    public function getUsername(): string
    {
        return $this->username ?? '';
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getByUser(int $userId): array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM recipes
                WHERE user_id = ?
                ORDER BY created_at DESC
            ");
            $stmt->execute([$userId]);

            $recipes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $recipe = new Recipe($this->db);
                $recipe->setId($row['id']);
                $recipe->setUserId($row['user_id']);
                $recipe->setCategoryId($row['category_id']);
                $recipe->setTitle($row['title']);
                $recipe->setIngredients($row['ingredients']);
                $recipe->setInstructions($row['instructions']);
                $recipe->setCookTime($row['cook_time']);
                $recipe->setCreatedAt($row['created_at']);
                $recipes[] = $recipe;
            }

            return $recipes;
        } catch (PDOException $e) {
            error_log("Database error in getByUser: " . $e->getMessage());
            return [];
        }
    }

    public function getById(int $id): ?Recipe
    {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM recipes
                WHERE id = ?
                LIMIT 1
            ");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            $recipe = new Recipe($this->db);
            $recipe->setId($row['id']);
            $recipe->setUserId($row['user_id']);
            $recipe->setCategoryId($row['category_id']);
            $recipe->setTitle($row['title']);
            $recipe->setIngredients($row['ingredients']);
            $recipe->setInstructions($row['instructions']);
            $recipe->setCookTime($row['cook_time']);
            $recipe->setCreatedAt($row['created_at']);

            return $recipe;
        } catch (PDOException $e) {
            error_log("Database error in getById: " . $e->getMessage());
            return null;
        }
    }

    public function create(int $userId, string $title, string $ingredients, string $instructions, ?int $prepTime, ?int $cookTime, ?int $portions, ?int $categoryId = null): ?Recipe
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO recipes (user_id, title, ingredients, instructions, prep_time, cook_time, portions, category_id, created_at)
                VALUES (:user_id, :title, :ingredients, :instructions, :prep_time, :cook_time, :portions, :category_id, NOW())
            ");

            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
            $stmt->bindParam(':instructions', $instructions, PDO::PARAM_STR);
            $stmt->bindParam(':cook_time', $cookTime, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $newId = (int) $this->db->lastInsertId();
                return $this->getById($newId);
            }

            return null;
        } catch (PDOException $e) {
            error_log("Database error in create: " . $e->getMessage());
            return null;
        }
    }

    public function update(int $id, int $userId, string $title, string $ingredients, string $instructions, ?int $prepTime, ?int $cookTime, ?int $portions, ?int $categoryId = null): bool
    {
        try {
            $stmt = $this->db->prepare("
                UPDATE recipes 
                SET title = :title, 
                    ingredients = :ingredients, 
                    instructions = :instructions,
                    cook_time = :cook_time,
                    category_id = :category_id
                WHERE id = :id AND user_id = :user_id
            ");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
            $stmt->bindParam(':instructions', $instructions, PDO::PARAM_STR);
            $stmt->bindParam(':cook_time', $cookTime, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error in update: " . $e->getMessage());
            return false;
        }
    }

    public function delete(int $id, int $userId): bool
    {
        try {
            $stmt = $this->db->prepare("
                DELETE FROM recipes 
                WHERE id = :id AND user_id = :user_id
            ");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error in delete: " . $e->getMessage());
            return false;
        }
    }
}
