<?php
	include '../config.php';
	include_once '../Model/Service.php';
	class ServiceC {
		function afficherService(){
			$sql="SELECT * FROM services";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function supprimerService($id){
			$sql="DELETE FROM services WHERE id=:id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id', $id);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

        function ajouterservices($services){

            $sql = "INSERT INTO services (nameServ,price, idDep) VALUES (:nameServ, :price,:idDep)";
         $db = config::getConnexion();                 
         try{
             $query = $db->prepare($sql);
             $query->execute([
				 'nameServ'=> $services->getNameServices(),
                 'price'=> $services->getServicePrice(),
				 'idDep'=>$services->getIdDep()
             ]);
             header("Location: ../view/formAjoutService.php");
     } catch (PDOExeption $e){
         $e->getMessage();
     }
     
         }
		function recupererService($id){
			$sql="SELECT * from services where id=$id";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$services=$query->fetch();
				return $services;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function modifierService($nameServ, $price,$idDep){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					"UPDATE services SET 
					    nameServ = :nameServ, 
						price = :price,
						idDep= :idDep 
					WHERE id = :id"
				);
				$query->execute([
					'nameServ' => $nameServ,
                    'price' => $price,
					'idDep'=>$idDep,
					'id' => $id
				]);
				header("Location: ../view/dashboard.php");
				echo $query->rowCount() . " records UPDATED successfully <br>";

			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}

	}
?>