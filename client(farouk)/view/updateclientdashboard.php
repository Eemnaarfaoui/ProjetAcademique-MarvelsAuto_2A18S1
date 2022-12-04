<?php

include '../Controller/ClientC.php';

$error = "";

// create client
$client = null;

// create an instance of the controller
$clientC = new ClientC();
if (
    isset($_POST['id']) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mdp"]) &&
    isset($_POST["telephone"])
) {
    if (
        !empty($_POST['id']) &&
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mdp"]) &&
        !empty($_POST["telephone"])
    ) {
        $client = new Client(
            $_POST['id'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['mdp'],
            $_POST['telephone']
        );
        $clientC->updateClient($client, $_POST["id"]);
        echo "test";
        var_dump($_POST["id"]); 
        header('Location:dashboard1.php');
    } else
        $error = "Missing information";
}
?>
<?php
 //include_once '../Model/Client.php';
 include_once '../Controller/ClientC.php';
 $client=new ClientC();
$list=$client->listClients();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <title>Back with client</title>
</head>
<body>
<div id="error">
        <?php echo $error; ?>
    </div>
    
    <?php
    if (isset($_POST['id'])) {
        $client = $clientC->showClient($_POST['id']);

    ?>

<div class="inscription-form">
<form action="" method="POST" name='myForm' id='myForm' onsubmit ="return(validate());">
            
                    <input type="hidden" name="id" id="id" value="<?php echo $client['idc']; ?>">
                
                <p>Nom:</p>
                    <input type="text" placeholder="Nom" name="nom" id="nom" value="<?php echo $client['nom']; ?>" >
                    
                    <p>Prenom:</p>   
                      
                    <input type="text" placeholder="Prenom" name="prenom" id="prenom" value="<?php echo $client['prenom']; ?>" >
                   
                    <p>Email:</p>
                        <input type="text" placeholder="Email" name="email" value="<?php echo $client['email']; ?>" id="email">
                        
                        <p>Mot de passe:</p>
                        <input type="text" placeholder="Mot de passe" name="mdp" value="<?php echo $client['mdp']; ?>" id="mdp">
                       
                        <p>Numero de telephone:</p>
                        <input type="number" placeholder="Numero de telephone" name="telephone" id="telephone" value="<?php echo $client['telephone']; ?>">
                        
                        
                        <button type="submit" value="Update">Update</button>
                        
                        <button type="reset" value="Reset">Reset</button>
                   
         
        </form>
                        </div>
    <?php
    }
    
    ?>

<style>
.inscription-form {
    position: absolute;
    top: 50%;
    left: 55%;
    transform: translate(-50%, -50%);
    width: 350px;
  }
  .inscription-form h1 {
    font-size: 15px;
    text-align: center;
    text-transform: uppercase;
    margin: 40px 0;
  }
  .inscription-form p {
    font-size: 20px;
    margin: 15px 0;
  }
  .inscription-form input {
      font-size: 16px;
      padding: 15px 10px;
      width: 70%;
      border-radius: 5px ;
      border-color:rgb(36, 13, 13);
      outline: none;
    }
    .inscription-form button {
      font-size: 18px;
      font-weight: bold;
      margin: 20px 0;
      padding: 10px 15px;
      width:50% ;
      border: 0;
      border-radius: 5px;
      background-color:red;
      
    }
    .inscription-form button:hover {
      color:red ;
      background-color: black;
     
  
    }
    </style>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <span class="icon"><ion-icon name="albums-outline"></ion-icon></span>
                        <span class="title">Marvels Auto</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard1.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">client</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard2.php">
                        <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                        <span class="title">Role</span>
                    </a>
                </li>
             
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="help-circle-outline"></ion-icon></span>
                        <span class="title">Help</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Sing Out</span>
                    </a>
                </li>
                
            </ul>
        </div>


                                
                          

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


<script>
    //Menu Toggle
    let toggle = document.querySelector(".toggle");
    let navigation = document.querySelector('.navigation');
    let main= document.querySelector('.main');

    toggle.onclick = function(){
        navigation.classList.toggle("active");
        main.classList.toggle("active")
    }

    //adding hoverd class in selected div ! 
    let list =document.querySelectorAll(".navigation li");
    function activeLink(){
        list.forEach((item)=>
        item.classList.remove('hovered'));
        this.classList.add('hovered')
    }
    list.forEach((item)=> 
    item.addEventListener('mouseover',activeLink));
</script>
<script type = "text/javascript">
      
         var letters = /^[A-Za-z]+$/;
         var pass =/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/
         // Form validation code will come here.
         function validate() {
         
            if( document.myForm.nom.value == "" ) {
               alert( "Veuillez entrer votre nom!" );
             
               document.myForm.nom.focus() ;
               return false;
            }
            if( !document.myForm.nom.value.match(letters) ) {
               alert( "le nom doit contenir que des lettres!" );
           
               document.myForm.nom.focus() ;
               return false;
            }
            if( document.myForm.email.value == "" ) {
            alert( "Veuillez entrer votre email!" );
            document.myForm.EMail.focus() ;
            return false;
         }

            if( document.myForm.prenom.value == "" ) {
               alert( "veuillez entrer votre prenom!" );
               document.myForm.prenom.focus() ;
               return false;}
               
               if( !document.myForm.prenom.value.match(letters) ) {
               alert( "le prenom doit contenir que des lettres!" );
           
               document.myForm.prenom.focus() ;
               return false;
            }
            if( document.myForm.mdp.value == "" ) {
               alert( "veuillez entrer votre mdp!" );
               document.myForm.mdp.focus() ;
               return false;}
               if( !document.myForm.mdp.value.match(pass) ) {
               alert( "mot de pass doit contenir numero/majuscule/miniscule et au moins 8 caracteres" );
           
               document.myForm.mdp.focus() ;
               return false;
            }
               if( document.myForm.telephone.value == "" ) {
               alert( "veuillez entrer votre telephone!" );
               document.myForm.telephone.focus() ;
               return false;}  

            
           
            
         }
      
  </script>
</body>
</html>