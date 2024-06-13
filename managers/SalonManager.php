<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class SalonManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM salons');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $salons = [];

        foreach ($result as $item) {
            $salon = new Salon($item["name"]);
            $salon->setId($item["id"]);
        }

        return $salons;
    }

    public function findOne(int $id): ?Salon
    {
        $query = $this->db->prepare('SELECT * FROM salons WHERE salon_id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $salon = new Salon($result["name"]);
            $salon->setId($result["salon_id"]);

            return $salon;
        }

        return null;
    }

    public function findByCategory(int $categoryId): array
    {
        $query = $this->db->prepare('SELECT salons.* FROM salons
    JOIN categories ON categories.category_id=salons.category_id 
    WHERE salons.category_id=:category_id');
        $parameters = [
            "category_id" => $categoryId
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $salons = [];
        foreach ($result as $item) {

            $salon = new Salon($item["name"]);
            $salon->setId($item["salon_id"]);
            $salons[] = $salon;
        }

        return $salons;
    }
}
