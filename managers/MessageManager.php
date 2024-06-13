<?php




class MessageManager extends AbstractManager {
    
    public function __construct(){
        
        parent::__construct();
        
        
        
        
    }
    
    
    
    
    public function findLatest() : array {
        
        
        $um = new UserManager();
        $sm = new SalonManager();
        
        
        $query = $this->db->prepare('SELECT * FROM messages ORDER BY created_at LIMIT 8');
        
        $query->execute();
        
        $postsList = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $postsTable = [];
        
        foreach($postsList as $post){
            
            
            $salon = $sm->findByPost($post["message_id"]);
            $user = $um->findOne($post["user_id"]);
            
            $newMessage = new Message($post["content"], $user, $salon, $user, DateTime::createFromFormat('Y-m-d H:i:s', $post["datetime"]));
            $newMessage->setId($post['message_id']);
            
            $postsTable[] = $newMessage;
            
            
        }
        
        
        return $postsTable;
        
    }
    
    public function findAll() : array {
        
        
        $um = new UserManager();
        $sm = new SalonManager();
        
        
        $query = $this->db->prepare('SELECT * FROM messages');
        
        $query->execute();
        
        $postsList = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $postsTable = [];
        
        foreach($postsList as $post){
            
            
            $salon = $sm->findOne($post["salon_id"]);
            $user = $um->findOne($post["user_id"]);
            
            $newMessage = new Message($post["content"], $user, $salon, DateTime::createFromFormat('Y-m-d H:i:s', $post["datetime"]));
            $newMessage->setId($post['message_id']);
            
            $postsTable[] = $newMessage;
            
            
        }
        
        
        return $postsTable;
        
    }
    
    public function findOne(int $id) : ? Message
    {
        $um = new UserManager();
        $sm = new SalonManager();

        $query = $this->db->prepare('SELECT * FROM message WHERE message_id=:id');

        $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $salon = $sm->findOne($result["salon_id"]);
            $user = $um->findOne($result["user_id"]);
            $message = new Message($result["content"], $user, $salon, DateTime::createFromFormat('Y-m-d H:i:s', $result["datetime"]));
            $message->setId($result["message_id"]);
            

            return $message;
        }

        return null;
    }
    
    
    public function findBySalon (int $salonId) : array
    {
        $um = new UserManager();
        $sm = new SalonManager();

        $query = $this->db->prepare('SELECT messages.* FROM messages JOIN salons ON salons.salon_id=messages.salon_id WHERE salons.salon_id=:salon_id');
        $parameters = [
            "salon_id" => $salonId
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $posts = [];

        foreach($result as $item)
        {
            $salon = $sm->findOne($item["salon_id"]);
            $user = $um->findOne($item["user_id"]);
            $post = new Message($item["content"], $user, $salon, DateTime::createFromFormat('Y-m-d H:i:s', $item["datetime"]));
            $post->setId($item["message_id"]);
            
            $posts[] = $post;
        }

        return $posts;
    }
    
    
    public function deleteMessage(int $message) : void
        {
        
        $parameters = [
            'id' => $message
                    ];
                    
        $query = $this->db->prepare("DELETE FROM messages WHERE message_id=:id");
 
        $query->execute($parameters);
        
        
        }
        
        public function modifyMessage(Message $message)
    {
        
        $parameters = [
            
            'message_id' => $message->getId(),
            'content' => $message->getContent(),
            'user_id' => $message->getAuthor()->getId(),
            'salon_id' => $message->getSalon()->getId(),
            'datetime' => $message->getCreatedAt(),
            
            
            
            ];
            
            
        
        $query = $this->db->prepare("UPDATE messages
        SET content=:content, user_id=:user_id, salon_id=:salon_id, datetime=:datetime
        WHERE message_id=:message_id");
        
        $query->execute($parameters);
        
        
        
    }
    
    public function createMessage(Message $message) : void
        {
            

        $query = $this->db->prepare('INSERT INTO messages (message_id, content, user_id, salon_id, datetime) VALUES (:message_id, :content, :user_id, :salon_id, :datetime)');
        
       $parameters = [
            
            'message_id' => $message->getId(),
            'content' => $message->getContent(),
            'user_id' => $message->getAuthor()->getId(),
            'salon_id' => $message->getSalon()->getId(),
            'datetime' => $message->getCreatedAt(),
            
            
            
            ];
            
            $query->execute($parameters);
          
        
    
    
        }
    
}




?>