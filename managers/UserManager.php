<?php


class UserManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByEmail(string $email) : ? User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email=:email');

        $parameters = [
            "email" => $email
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $user = new User($result["name"], $result["email"], $result["password"], $result["role"]);
            $user->setId($result["user_id"]);

            return $user;
        }

        return null;
    }

    public function findOne(int $id) : ? User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id=:id');

        $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $user = new User($result["name"], $result["email"], $result["password"], $result["role"]);
            $user->setId($result["user_id"]);

            return $user;
        }

        return null;
    }

    public function createUser(User $user) : void
    {
        
        $parameters = [
            "name" => $user->getName(),
            "password" => $user->getPassword(),
            "email" => $user->getEmail(),
            "role" => $user->getRole(),
            
        ];
        
        

        $query = $this->db->prepare('INSERT INTO users (email, name, password, role) VALUES (:email, :name, :password, :role)');
        

        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());

    }
    
    public function findAll() : array {
        
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $usersList = $query->fetchAll(PDO::FETCH_ASSOC);
        $usersTable = [];
        
        foreach($usersList as $user){
            
            $newUser = new User($user["name"], $user["email"], $user["password"], $user["role"]);
            $newUser->setId($user['user_id']);
            array_push($usersTable, $newUser);
            
            
        }
        
        
        return $usersTable;
        
    }
    
    public function deleteUser(int $user){
        
        
        
        
        $parameters = [
            'id' => $user
                    ];



        $query = $this->db->prepare("DELETE FROM users WHERE id=:id");
 

        $query->execute($parameters);
        
        
    }
    
    public function ModifyUser(User $user)
    {
        
        $parameters = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
            
            
            ];
            
            var_dump($parameters);
        
        $query = $this->db->prepare("UPDATE users
        SET name=:name, password=:password, email=:email, role=:role
        WHERE id =:id");
        
        $query->execute($parameters);
        
    }
    
    
}


?>