<?php
    include("SQL_Config.php");
    $sql = new SQL_Config();
    $sql->setConn('localhost','root','database1234','pizzaDB');
    $sql->connect();

    if(isset($_POST['delete'])){
        $delete_id = mysqli_real_escape_string($sql->connection(), $_POST['delete_id']);

        $sql->setQuery("DELETE FROM pizzas WHERE id = $delete_id");

        $sql->setSQL();
    }

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
            <div class="card-body clearfix">
                <h3><?php echo $pizza['title']; ?></h3>                
                <p>Created By: <?php echo $pizza['email']; ?></p>
                <p><?php echo $pizza['ingredients']; ?></p>
                <p><?php echo Date($pizza['created_at']); ?></p> 
                <a class="btn btn-default float-left long-btn btn-brand" href="edit.php?id=<?php echo $pizza['id']; ?>">Edit</a>

                <form action="details.php" method="POST" class="float-right">
                    <input type="hidden" name="delete_id" value="<?php echo $pizza['id']; ?>">
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger long-btn">
                </form>
            </div>
        </div>           
    </div>
    <?php include("templates/footer.php"); ?>
</body>
</html>