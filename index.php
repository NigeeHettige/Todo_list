<?php

    include ("connect.php");

    function setValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

    if(isset($_GET["id"])){
        $member_id = $_GET["id"];
       
        $query = "SELECT*from details WHERE id='$member_id'";
        $result = mysqli_query($con,$query);

        if($result){
            $row = mysqli_fetch_assoc($result);

            // print_r($row);

            $title = $row['title'];
            $description = $row['description'];
            $date = $row['date'];
            $priority = $row['priority'];
        }
        else{
            echo " Error fetching member details: ".mysqli_error($con);
            exit;
        }


    } 


    // Insert the details
    if(isset($_POST["submit"])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $priority = $_POST['priority'];
    
        echo $title;
    
        $query = "INSERT INTO `details`(`title`,`description`,`date`,`priority`) VALUES('$title','$description','$date','$priority')" ;
        $result = mysqli_query($con,$query);
    
        if($result){
            header("location:index.php");
            exit;
        }else{
            echo "Connection Error".mysqli_connect_error();
    }


    if(isset($_GET['id'])){
        $member_id = $_GET['id'];

        $query = "DELETE FROM details WHERE id='$member_id'";
        $result = mysqli_query($con,$query);

        if($result){
            header("Location: index.php");
            exit;
        } else {
            echo "Error in deleting : ".mysqli_connect_error();
        }
    }
    
    }


    if(isset($_POST["update"])){
        $member_id = $_POST["id"];

        $title = $_POST["title"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $priority = $_POST["priority"];
       
        $query = "UPDATE details SET title ='$title',description ='$description',date = '$date',priority ='$priority' WHERE id ='$member_id'";
        $result = mysqli_query($con,$query);

        if($result){
            header("location:index.php");
        }
        else{
            echo " Error fetching member details: ".mysqli_connect_error();
            exit;
        }

    } 


    


?>

<html>
<head>
    <title>TODO List</title>
    <style>
       
       
       <!DOCTYPE html>
<html>
<head>
    <title>TODO List</title>
    <style>
    <!DOCTYPE html>
<html>
<head>
    <title>TODO List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        form {
            width: 300px;
            margin: 20px auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            width: 100%;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: normal;
        }

        tr {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        td {
            border-bottom: 1px solid #ddd;
            display: block; /* Change display property to block */
            padding: 8px;
        }

        td:last-child {
            border-bottom: none;
        }

        td span {
            font-weight: bold;
            display: block;
        }

        td a {
            display: inline-block;
            margin-top: 5px;
            text-decoration: none;
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #333;
        }

        td a.update {
            background-color: #4CAF50;
            color: #fff;
            border-color: #4CAF50;
        }

        td a.delete {
            background-color: #f44336;
            color: #fff;
            border-color: #f44336;
        }
    </style>
<
<body>
    


<center><h1><?php if(isset($_GET["id"])){ echo "Update TODO List";} else {echo "TODO List";}?></h1></center>

<form action="index.php" method = "POST">

    <input type="hidden" name ="id"  value="<?php if(isset($_GET["id"])){ echo $_GET['id'];}?>">

    
    <label for="title">Title</label>
    <input type="text" name = "title" value="<?php if(isset($_GET["id"])){ echo $title;} else {setValue("title");}?>">
    
    <br>

    
    <label for="description">Description</label>
    <input type="text" name = "description" value="<?php if(isset($_GET["id"])){ echo $description;} else {setValue("description");}?>">
    
    <br>

    
    <label for="date">Due Date</label>
    <input type="date" name = "date" value="<?php if(isset($_GET["id"])){ echo $date;} else {setValue("date");}?>">
   
    <br>

   
    <label for="Priority">Priority</label>
    <select name="priority" id="" >
        <option value="high" >High</option>
        <option value="medium">Medium</option>
        <option value="low">Low</option>
    </select>
    <br><br>

    

    
    <input type="submit" name="<?php if(isset($_GET["id"])) { echo "update";}else {echo "submit";}?>" value="<?php if(isset($_GET["id"])) { echo "update";}else {echo "submit";}?>">
    






</form>

<table>
    <tbody>
        <?php
            $query = "Select*FROM details";
            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_assoc($result)){?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php echo $row['date'];?></td>
                    <td><?php echo $row['priority'];?></td>
                    <td><a href="index.php?id=<?php echo $row['id'];?>">Update</a>
                        <a href="delete.php?id=<?php echo $row['id'];?>">Delete</a>
                    </td>
                </tr>

            <?php
            }
            ?>
        
       
        
    </tbody>

</table>
</body>
</html>