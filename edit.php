<?php

    include("SQL_Config.php");
    $sql = new SQL_Config();
    $sql->setConn('localhost','root','database1234','pizzaDB');
    $sql->connect();

    // $email = $title = $ingredients = '';
    // $error=['email'=>'', 'title'=>'', 'ingredients'=>''];
    if(isset($_POST['submit'])){
        $email = htmlspecialchars($_POST['email']);
        $title = htmlspecialchars($_POST['title']);
        $ingredients = htmlspecialchars($_POST['ingredients']);

        $sql->queryCheck($title, $email, $ingredients);
        $update_id = $_POST['update_id'];
        $title = $sql->getTitle();
        $email = $sql->getEmail();
        $ingredients = $sql->getIngredients();

        $sql->setQuery("UPDATE pizzas SET title = '$title', email = '$email', ingredients = '$ingredients' WHERE id = $update_id");
        $sql->setSQL();
    }

    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($sql->connection(), $_GET['id']);

        $sql->setQuery("SELECT * FROM pizzas WHERE id = $id");
        $pizza=$sql->getSingleSQL();
    }

?>

<?php include("templates/header.php"); ?>

    <section class="container form-section">
        <h4>Add a Pizza</h4>
        <form class="my-form" action="edit.php" method="POST">
            <div class="form-group">                        
                <input class="form-control" type="text" name="email" value="<?php echo $pizza['email']; ?>">
            </div>

            <div class="form-group">
                <input class="form-control" type="text" name="title" value="<?php echo $pizza['title']; ?>">
            </div>

            <div class="form-group">
                <input class="form-control" type="text" name="ingredients" value="<?php echo $pizza['ingredients']; ?>">
            </div>

            <input type="hidden" name='update_id' value="<?php echo $pizza['id']; ?>">
            <input class="btn btn-default btn-brand" type="submit" name="submit" value="Submit">
        </form>
    </section>
    
<?php include("templates/footer.php"); ?>