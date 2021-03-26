<?php 
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        // Register User
        public function register($data){
            $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
            // Bind Values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function login($email, $password){
            $this->db->query('SELECT * FROM users WHERE email= :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hash_password = $row->password;
            if(password_verify($password, $hash_password)){
                return $row;
            } else {
                return false;
            }
        }


        //Find user by email
        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM users WHERE  email = :email");

            // Bind Values
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check roow
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }
        //Get user by Id
        public function getUserByid($id){
            $this->db->query("SELECT * FROM users WHERE id = :id");

            // Bind Values
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            // Check roow
           return $row;
        }
    }


?>