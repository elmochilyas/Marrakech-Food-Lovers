<?php

class Category
{
    private int $id;
    private string $name;

    private PDO $db;

    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAll(): array
    {
        try {
            $stmt = $this->db->query("
                SELECT id, name 
                FROM categories 
                ORDER BY name ASC
            ");

            $categories = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $category = new Category($this->db);
                $category->setId($row['id']);
                $category->setName($row['name']);
                $categories[] = $category;
            }

            return $categories;
        } catch (PDOException $e) {
            error_log("Database error in getAll: " . $e->getMessage());
            return [];
        }
    }

    public function getById(int $id): ?Category
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, name 
                FROM categories 
                WHERE id = ?
                LIMIT 1
            ");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            $category = new Category($this->db);
            $category->setId($row['id']);
            $category->setName($row['name']);

            return $category;
        } catch (PDOException $e) {
            error_log("Database error in getById: " . $e->getMessage());
            return null;
        }
    }
}
