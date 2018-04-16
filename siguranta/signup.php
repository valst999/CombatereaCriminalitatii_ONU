<?php

    session_start();
    $_SESSION['message'] = '';

    $mysqli = new mysqli('192.185.4.123', 'raducu', 'yHzl7)dp9tCv', 'raducu_test');
 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
       
      if ($_POST['password'] == $_POST['confirmpassword']) {


       $username = $mysqli->real_escape_string($_POST['username']);
       $email = $mysqli->real_escape_string($_POST['email']);
       $password = md5($_POST['password']);
       $avatar_path = $mysqli->real_escape_string('images/'.$_FILES['avatar']['name']);

       if (preg_match("!image!", $_FILES['avatar']['type'])) {

         if (copy($_FILES['avatar']['tmp_name'], $avatar_path)) {

            $_SESSION['username'] = $username;
            $_SESSION['avatar'] = $avatar_path;

            $sql = "INSERT INTO user (username, email, password, avatar) "
                   . "VALUES ('$username', '$email', '$password', '$avatar_path')";

            if ($mysqli->query($sql) != true) {

               $_SESSION['message'] = 'Bravo Geani! Ai reusit!';

            }

         }


       }
       

      }
       

    }
   

?>

<!DOCTYPE html>

<html>
<head>
    <title>Inregistrare</title>
    <link rel="icon" href="internet.png">

    <style type="text/css">

        *{  
  margin:0;
  padding:0;
}


.module{
  position:relative;
  top:10%;    
  height:65%;
  width:450px;
  margin-left:auto;
  margin-right:auto;
  padding-left: 10%;
  padding-right: 10%;
  background-color: rgba(0, 0, 46, 0.7);
}

body{
  color: #fff;
  background-color:#f0f0f0;
  font-family:helvetica;
   background: url(img13.png) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.body-content{
  position:relative;
  top: 150px;
  height:1000px;
  width:800px;
  margin-left:auto;
  margin-right:auto; 
  background: transparent;
  -webkit-transform: skew(353deg);
}
input[type="text"],
input[type="password"],
input[type="email"]
{
  height:30px;
  width:100%;;
  display: inline-block;
  vertical-align: middle;
  height: 34px;
  padding: 0 10px;
  margin-top: 3px;
  margin-bottom: 10px;
  font-size: 15px;
  line-height: 20px;
  border: 2px solid rgba(255, 255, 255, 1);
  background-color: rgba(0, 0, 0, 0.5);
  color: rgba(255, 255, 255, 0.7);
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  border-radius: 2px;
  -webkit-transform: skew(353deg);
}

.buton {
            margin: 50px auto;
            display: block;
            width: 260px;
            height: 50px;
            border: 3px solid white;
            background-color: rgba(255,255,255,0);
            color: white;
            font-family: sans-serif;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 1000ms, color 1000ms;
            -webkit-transform: skew(353deg);
}

.buton:hover {
                    background-color: rgb(255, 0, 0);
                color: #222;
                cursor: pointer;
                transition: background-color 1000ms, color 1000ms;
}

#user {
    position : absolute;
    z-index: 1;
    margin-left : 50%;
      left: 0; 
     right: 0; 
     margin-left: auto; 
     margin-right: auto; 
     
    

}
        div#load_screen {
            background : #000;
            opacity : 1;
            position : fixed;
            z-index : 10;
            top : 0px;
            left : 0px;
            width : 100%;
            height : 100%;
        }

        div#load_screen > div#loading {
            color : #FFF;
            width : 300px;
            height : 24px;
            margin : 300px auto;
        }

        #loadingicon {
            width: 50px;
            height: 50px;
            border: 5px solid #ffffff;
            border-top-color: #ff6a00;
            border-radius: 100%;
            animation: round 1s linear infinite;
        }
                @keyframes round {
            from {transform: rotate(0deg)}
            to {transform: rotate(360deg)}
        } 
        
        #mesajeserver {
         position : absolute;
         z-index: 3;
         margin-left : 50%;
         left: 0; 
         right: 0; 
         margin-top : 5%;
         margin-left: auto; 
         margin-right: auto; 
         width:820px;

        }

        #innermesaje {
            background-color: rgba(0, 0, 46, 0.8);
            -webkit-transform: skew(353deg);
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
        window.addEventListener("load", function () {
            var load_screen = document.getElementById("load_screen");
            $(document).ready(function () {
                $("#load_screen").fadeTo(600, 0);
                function remove () {
                    $("#load_screen").remove();
                }
                window.setTimeout(remove, 600 );
            })
        })

    </script>

    <script>

      function myFunction() {
       
      }
      return false;

    </script>

</head>


<div id="load_screen"><div id="loading"><center><h1>Site-ul se incarca</h1><div id="loadingicon"></div></center></div></div>
<div id="mesajeserver"><center><div id="innermesaje"><?=$_SESSION['message'] ?></div></center></div>
<div class="body-content">
    <img id="user" src="internet1.png" height="180" width="180"></img>
    <div class="module">
        <p>
            <br>
            <br>
        </p>
        <p>
            <br>
            <br>
        </p>
        <p>
            <br>
            <br>
        </p>
        <form class="form" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="text" placeholder="Utilizator" name="username" required />
            <input type="email" placeholder="Email" name="email" required />
            <input type="password" placeholder="Parola" name="password" autocomplete="new-password" required />
            <input type="password" placeholder="Confirmare Parola" name="confirmpassword" autocomplete="new-password" required />
            <p>
                <br>
                <br>
            </p>
            <div class="avatar"><label>Selecteaza imaginea ta : </label><input type="file" name="avatar" accept="image/*" required /></div>
            <input type="submit" onclick="myFunction()" value="Inregistreaza-te" name="register" class="buton" />
        </form>

        <button class="buton" onclick="window.location.href = 'signin.php'">
            <p>Esti deja inregistrat?</p>
        </button>
    </div>
    
</div>
</html>
