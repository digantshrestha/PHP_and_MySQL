<?php

    include("SQL_Config.php");
    $sql = new SQL_Config();
    $sql->setConn('localhost','root','database1234','pizzaDB');
    $sql->connect();

    $email = $title = $ingredients = '';
    // if(isset($_GET['submit'])){
    //     echo($_GET['email']);
    //     echo($_GET['title']);
    //     echo($_GET['ingredients']);
    // }

    // if(isset($_POST['submit'])){
    //     // $email = htmlspecialchars($_POST['email']);
    //     // $title = htmlspecialchars($_POST['title']);
    //     // $ingredients = htmlspecialchars($_POST['ingredients']);

    //     $email = htmlspecialchars($_POST['email']);
    //     $title = htmlspecialchars($_POST['title']);
    //     $ingredients = htmlspecialchars($_POST['ingredients']);
    // }

    // checking if all the input fields are filled or empty
    $error=['email'=>'', 'title'=>'', 'ingredients'=>''];
    if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $error['email'] = "Enter email";
        }else{
            // $email = htmlspecialchars($_POST['email']);
            
            // filters and more validations
            $email = htmlspecialchars($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error['email'] = "Please enter valid email";
            }
        }
    
        if(empty($_POST['title'])){
            $error['title'] = "Enter title";
        }else{
            $title = htmlspecialchars($_POST['title']);
        }
    
        if(empty($_POST['ingredients'])){
            $error['ingredients'] = "Enter ingredients";
        }else{
            $ingredients = htmlspecialchars($_POST['ingredients']);
        }

        // array filter
        // this filter returns true if the array is not empty

        if(array_filter($error)){
            echo "There is an error";
        }else{
            // mysqli_real_escape_string -> used to prevent maliceous sql code
            $email = mysqli_real_escape_string($sql->connection(),$_POST['email']);
            $title = mysqli_real_escape_string($sql->connection(),$_POST['title']);
            $ingredients = mysqli_real_escape_string($sql->connection(),$_POST['ingredients']);

            //create insert query
            $query = "INSERT INTO pizzas(title, email, ingredients) VALUES(
                '$title', '$email', '$ingredients')";
            
            if(mysqli_query($sql->connection(), $query)){
                header("Location: index.php");//redirecting to other page
            }else{
                echo "Query error ". mysqli_error($sql->connection());
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include("templates/header.php"); ?>
    
    <section class="container form-section">
        <h4>Add a Pizza</h4>
        <form class="my-form" action="add.php" method="POST">
            <div class="form-group">                        
                <input class="form-control" type="text" name="email" value="<?php echo $email; ?>" placeholder="Email...">
                <div class="error">
                    <p><?php echo $error['email']; ?></p>
                </div> 
            </div>

            <div class="form-group">
                <input class="form-control" type="text" name="title" value="<?php echo $title; ?>" placeholder="Pizza Title...">
                <div class="error">
                    <p><?php echo $error['title']; ?></p>
                </div> 
            </div>

            <div class="form-group">
                <input class="form-control" type="text" name="ingredients" value="<?php echo $ingredients; ?>" placeholder="Ingredients...">
                <div class="error">
                    <p><?php echo $error['ingredients']; ?></p>
                </div> 
            </div>

            <input class="btn" type="submit" name="submit" value="Submit">


        </form>
    </section>

    <?php if(isset($_POST['submit'])): ?>
        <div class="form-values">
            <h5>You Entered</h5>
            <ul class="list-group container">
                <li class="list-group-item"><?php echo $email; ?></li>
                <li class="list-group-item"><?php echo $title; ?></li>
                <li class="list-group-item"><?php echo $ingredients; ?></li>
            </ul>
        </div>
    <?php endif; ?>

    <?php include("templates/footer.php"); ?>
</html>