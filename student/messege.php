<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Messege</title>
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body{
            background-image:url("images/msg.jpg");
            background-repeat: no-repeat;
        }
        .wrapper
{
    height:600px;
    width:500px
    background-color:black;
    opacity:.9;
    color:white;
    margin:-20px auto;
    padding: 10px;
}
.form-control
{
    height:47px;
    width:77%;
}
.msg{
  height: 450px;
  
  overflow-y:scroll;
}
.btn-info{
    background-Color: #02c5b6;

}
.chat
{
    display:flex;
    flex-fow:row wrap;
}
.user .chatbox
{
    height:50px;
    width: 400px;
    padding: 13px 10px;
    background-Color:red;
    border-radius:10px;
    order: -1;
}
.admin .chatbox
{
    height:50px;
    width: 400px;
    padding: 13px 10px;
    background-Color: #423471;
    border-radius:10px;
    
}
</style>
        
<body>
<?php
    if(isset($_POST['submit']))
    {
        mysqli_query($db, "INSERT into `library`.`messege` VALUE ('', '$_SESSION[login_user]', '$_POST[messege]', 'no', 'student');");

        $res=mysqli_query($db, "SELECT * from messege where username='$_SESSION[login_user]' ;");
    }
    else
    {
        $res=mysqli_query($db, "SELECT * from messege where username='$_SESSION[login_user]' ;");
    }
    mysqli_query($db,"UPDATE messege set status='yes' where sender='admin' and username='$_SESSION[login_user]';");
    ?>
<div class="wrapper">
    <div style="height: 70px width:100%; background-color: #2eac8b; text-align:center; clor:white; ">
    <h3 style="margin-top:-5px; padding-top: 10px;">Admin</h3>
</div>
<div class="msg">
    <br>
    <div class="chat user">
        <div style="float:left; padding-top:5px;">
        &nbsp
        <img src="images/p.jpg>
        &nbsp
        <?php
                        echo "<img class='img-circle profile_img' height=40 width=40 src='images/".$_SESSION['pic']."'>";
                        
                      ?>&nbsp 
</div>
<div style="float:left;" class="chatbox">
<p>Hello! This is a Student.</p>

</div>
</div>
<br>
<div class="chat admin">
        <div style="float:left; padding-top:5px;">
        &nbsp
        <img  style="height: 40px; width: 40px; border-radius: 50%;"src="images/p.jpg">
        &nbsp
</div>
                       <div style="float:left;"class="chatbox">
<p>Hello! This is a Admin.</p>
</div>
</div>

 
</div>


<div style="height: 100px; padding-top: 10px;">
<form action="" method="post">
    <input type="text" name="msg" class="form-control" required="" placeholder="Write Messege......." style="float: left"> &nbsp
    <button class="btn btn-info btn-lg"><span class="glyphicon glyphicon-send"></span>Send</button>
</form>

</div>
            </div>
</body>
</html>