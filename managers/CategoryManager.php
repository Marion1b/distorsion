<?php



class CategoryManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];

        foreach ($result as $item) {
            $category = new Category($item["name"]);
            $category->setId($item["category_id"]);
            $categories[] = $category;
        }

        return $categories;
    }

    public function findOne(int $id): ?Category
    {
        $query = $this->db->prepare('SELECT * FROM categories WHERE category_id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $category = new Category($result["name"]);
            $category->setId($result["category_id"]);

            return $category;
        }

        return null;
    }

    public function findBySalon(int $salonId): array
    {
        $query = $this->db->prepare('SELECT categories.name FROM categories 
    JOIN salons ON salons.category_id=categories.category_id 
    WHERE salons.salons_id=:salonId');
        $parameters = [
            "salonId" => $salonId
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function findOneName(string $name): ?Category
    {
        $query = $this->db->prepare('SELECT * FROM categories WHERE name=:name');
        $parameters = [
            "name" => $name
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $category = new Category($result["name"]);
            $category->setId($result["category_id"]);

            return $category;
        }

        return null;
    }
}
