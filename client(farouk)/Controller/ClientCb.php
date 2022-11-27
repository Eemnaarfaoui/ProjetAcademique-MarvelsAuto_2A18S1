<?php
include '../config.php';
include '../Model/Clientb.php';

class ClientC
{
    public function listClients()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteClient($id)
    {
        $sql = "DELETE FROM user WHERE idc = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addClient($client)
    {
        $sql = "INSERT INTO user  
        VALUES (NULL, :n,:p, :e,:m,:t,:idr)";
        $db = config::getConnexion();
        try {
           
            $query = $db->prepare($sql);
            $query->execute([
                'n' => $client->getnom(),
                'p' => $client->getprenom(),
                'e' => $client->getemail(),
                'm' => $client->getmdp(),
                't' => $client->gettelephone(),
                'idr' => $client->getidrole()

            ]);
               
            
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateClient($client, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE user SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    mdp = :mdp,
                    telephone = :telephone
                    idrole = :idrole
                WHERE idc= :idc'
            );
            $query->execute([
                'idc' => $id,
                'nom' => $client->getnom(),
                'prenom' => $client->getprenom(),
                'email' => $client->getemail(),
                'mdp' => $client->getmdp(),
                'telephone' => $client->gettelephone(),
                'idrole' => $client->getidrole()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showClient($id)
    {
        $sql = "SELECT * from user where idc = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $client = $query->fetch();
            return $client;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}