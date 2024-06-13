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
        $query = $this->db->prepare('SELECT salons.name FROM salons
    JOIN categories ON categories.category_id=salons.salon_id 
    WHERE categories.category_id=:category_id');
        $parameters = [
            "category_id" => $categoryId
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // public function findAllMessagesFromSalon($id): array
    // {

    //     $userManager = new UserManager();
    //     $salonManager = new SalonManager();

    //     $query = $this->db->prepare('SELECT * FROM salons
    //     JOIN messages ON salons.salon_id = messages.salon_id 
    //     WHERE salons.salon_id = :id');
    //     $parameters = [
    //         "id" => $id
    //     ];
    //     $query->execute($parameters);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $messages = [];


    //     //private string $content, private User $author, private Salon $salon, private DateTime $createdAt = new DateTime())
    //     foreach ($results as $message) {

    //     $userManager->findOne($message['user_id'])

    //         $message = new Message($message["name"]);
    //         $message->setId($id);
    //         array_push($messages, $message);
    //     }

    //     return $messages;
    // }
}
