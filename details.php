<?php
    include("SQL_Config.php");
    $sql = new SQL_Config();
    $sql->setConn('localhost','root','database1234','pizzaDB');
    $sql->connect();
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($sql->connection(), $_GET['id']);

        $sql->setQuery("SELECT * FROM pizzas WHERE id = $id");
        $pizza=$sql->getSingleSQL();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("templates/header.php"); ?>
    <div class="container text-center">
        <div class="card details">
            <div class="card-body">
                <h3><?php echo $pizza['title']; ?></h3>                
                <p>Created By: <?php echo $pizza['email']; ?></p>
                <p><?php echo $pizza['ingredients']; ?></p>
                <p><?php echo Date($pizza['created_at']); ?></p> 
            </div>
        </div>           
    </div>
    <?php include("templates/footer.php"); ?>
</body>
</html>