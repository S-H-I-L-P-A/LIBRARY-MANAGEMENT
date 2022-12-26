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
            background-image: url("images/msg.jpg");
            background-repeat: no-repeat;
        }
        .left_box
        {
            height: 600px;
            width: 500px;
            float: left;
            background-color: #8ecdd2;
            margin-top: -20px;
        }
        .right_box
        {
            height:  600px;
            width: 970px;
            background-color: #8ecdd2;
            margin-left: 380px;
            margin-top: -20px;
            padding: 10px;
            
       
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
    background-Color:#821b69;
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
.left_box2
{
    height: 600px;
    width: 300px;
    background-color: #537890;
    border-radius: 20px;
    float: right;
    margin-right: 30px;
}
.left_box input
{
    width: 150px;
    height: 50px;
    background-color: #537890;
    padding: 10px;
    margin: 10px;
    border-radius: 10px;
}
.right_box2
{
    height: 600px;
    width: 660px;
    margin-top:  -20px; 
    padding: 20px;
    border-radius: 20px;
    background-color: #937890;
    float:  left;
    color:  white;
}
.list
{
    height: 500px;
    width: 300px;
    background-color: #537890;
    float: right;
    color:  white;
    padding: 10px;
    overflow-y: scroll;
    overflow-x: hidden;
}
tr:hover
{
    background-color: #1e3f54;
    cursor: pointer;
}
</style>
        
<body style="width: 1348px; height: 595px;">
<?php
    $sql=mysqli_query($db,"SELECT student.pic,messege.username FROM student INNER JOIN messege ON student.username=messege.username group by username ORDER BY status;");
?>
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
    ?>
<div class="wrapper">
    <div style="height: 70px width:100%; background-color: #2eac8b; text-align:center; clor:white; ">
    <h3 style="margin-top:-5px; padding-top: 10px;">Admin</h3>
</div>
<div class="msg">
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        if($row['sender']=='student')
        {
    ?>
    <!------------student------------>
    <br><div class="chat user">
        <div style="float:left; padding-top:5px;">
        &nbsp
        <img src="images/p.jpg>
        &nbsp
        <?php
                        echo "<img class='img-circle profile_img' height=40 width=40 src='images/".$_SESSION['pic']."'>";
                        
                      ?>&nbsp 
</div>
<div style="float: left;" class="chatbox">
    <?php
    echo $row['messege'];
    ?>
<p>Hello! This is a Student.</p>

</div>
</div>

<?php
        }
        else
        {
        ?>
        <div class="left-box">
            <div class="left-box2">
                <div style="color: #fff;">
                    <form method="post" enctype="multipart/form-data">
                        <input type="text" name="username" id="uname">
                        <button type="submit" name="submit" class="btn btn-default" >SHOW</button>
                    </form>
                </div>
                <div class="list">
                    <?php
                        echo "<table id='table' class='table' >";
                        while ($res1=mysqli_fetch_assoc($sql1))
                        {
                        echo "<tr>";
                         echo "<td width=65>"; echo "<img class='img-circle profile_img' height=60 width=60 src='images/".$res1['pic']."'> ";  echo "</td>";

                         echo "<td style='padding-top: 30px;'>"; echo $res1['username']; echo "</td>";
                        echo "</tr>";
                        }
                        echo "</table>";
                    ?>
                </div>

            </div>
        </div>
        <div class="right-box">
            <div class="right_box2">

            </div>
        </div>
<!------------admin------------>
<br><div class="chat admin">
        <div style="float:left; padding-top:5px;">
        &nbsp
        <img  style="height: 40px; width: 40px; border-radius: 50%;" src="images/p.jpg">
        &nbsp
</div>
                       <div style="float:left;"class="chatbox">
                       <?php
    echo $row['messege'];
    ?>
<p>Hello! This is a Admin.</p>
</div>
</div>
<?php
    }
}
    ?>
</div>


<div style="height: 100px; padding-top: 10px;">
<form action="" method="post">
    <input type="text" name="messege" class="form-control" required="" placeholder="Write Messege......." style="float: left"> &nbsp
    <button class="btn btn-info btn-lg" type="submit" name="submit"><span class="glyphicon glyphicon-send"></span>&nbsp Send</button>
</form>

</div>
            </div>
        <script>
            var table = document.getElementById('table'),eIndex;
            for(var i=0; i< table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                    rIndex = this.rowIndex;
                    document.getElementById("uname").value = this.cells[1].innerHTML;
                }
            }
        </script>    
</body>
</html>