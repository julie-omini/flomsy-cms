<?php
class Members {
    private $CMS;
    function __construct($CMS){
        $this->CMS = $CMS;
    }

    public function get($id) {
        $req = $this->CMS->DataBase->execute('SELECT * FROM members WHERE ID = ?', [$id])->fetch();

        return $req;
    }

    public function Register($email, $pseudo, $password, $nom = null, $prenom = null, $adress = null, $city = null, $postal = null, $phone = null){
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            return false;
        }
        $Date = date('H:i:s d-m-Y');
        $hashpassword = hash('sha512', $this->CMS->Config->server->privatekey.$password);  
        $AccountCreate = $this->CMS->DataBase->execute("INSERT INTO members (email, pseudo, password, nom, prenom, adress, postal, city, phone, createat) VALUES (:email, :pseudo, :password, :nom, :prenom, :adress, :postal, :city, :phone, :createat)", [":email" => $email, ":pseudo" => $pseudo, ":password" => $hashpassword, 
            ":nom" => $nom, ":prenom" => $prenom, ":adress" => $adress, 
            ":city" => $city, ":postal" => $postal, ":phone" => $phone,
            ":createat" => $Date
        ])->Success;
        if ($AccountCreate === true){
            $EmailConfirmation = $this->CMS->DataBase->execute("INSERT INTO confirmation (email, code, createat) VALUES (:email, :code, :createat)", [":email" => $email, ":code" => $this->CMS->Function->RandomCode(), ":createat" => $Date
            ])->Success;
            return ($AccountCreate && $EmailConfirmation);
        } else {
            return false;
        }
    }

    public function Login($email, $password){
        $ip = $_SERVER['REMOTE_ADDR'];
        $hashpassword = hash('sha512', $this->CMS->Config->server->privatekey.$password);
        $Date = date('H:i:s d-m-Y');
        $logs = ["date" => $Date, "ip" => $ip, "Message" => ""];
        $Connection = $this->CMS->DataBase->execute("SELECT * FROM members WHERE email = :email", [":email" => $email]);
        $parse = $Connection->fetch();
        if ($parse !== false) {
            if ($parse->password === $hashpassword){
                $logs["Message"] = "Connexion réussi";
                $_SESSION["IsConnected"] = true;
                $_SESSION["Role"] = (int)$parse->role;
                foreach ($parse as $key => $value) {
                    if (!in_array($key, ["id", "password"])){
                        $_SESSION[$key] = $value;
                    }
                }
                $AccountCreate = $this->CMS->DataBase->execute("INSERT INTO lastconnect (email, logs) VALUES (:email, :logs)", [":email" => $email, ":logs" => json_encode($logs, true)])->Success;
                return true;
            } else {
                $logs["Message"] = "Tentative de connexion au compte";
                $AccountCreate = $this->CMS->DataBase->execute("INSERT INTO lastconnect (email, logs) VALUES (:email, :logs)", [":email" => $email, ":logs" => json_encode($logs, true)])->Success;
                return false;
            }
        } else {
            return false;
        }        
    }

    public function Confirmed($email, $code) {
        $Request = $this->CMS->DataBase->execute("SELECT * FROM confirmation WHERE email = :email and code = :code" , [":email" => $email, ":code" => $code])->fetch();
        if ($Request === false){
           return false;
        } else {
            $idmember = $this->CMS->DataBase->execute("SELECT * FROM members WHERE email = :email", [":email" => $email])->fetch("id");      
            $Update = $this->CMS->DataBase->execute("UPDATE members SET confirmed = :confirmed where email = :email and id = :id", [":confirmed" => true, ":email" => $email, ":id" => $idmember])->Success;
            $Delete = $this->CMS->DataBase->execute("DELETE FROM confirmation WHERE id = :id and email = :email and code = :code", [":id" => $Request->id, ":email" => $email, ":code" => $code])->Success;
            return ($Update && $Delete);
        }
    }

    public function IsConfirmed($email){
        $Request = $this->CMS->DataBase->execute("SELECT * FROM members WHERE email = :email", [":email" => $email]);
        return $Request->fetch("confirmed") === "1";
    }
    public function SetPicture($Picture){

    }
}