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
            $sql->queryCheck($title, $email, $ingredients);
            
            $title = $sql->getTitle();
            $email = $sql->getEmail();
            $ingredients = $sql->getIngredients();

            //create insert query
            $query = "INSERT INTO pizzas(title, email, ingredients) VALUES(
                '$title', '$email', '$ingredients')";

            $sql->setQuery($query);
            $sql->setSQL();                
            
            // if(mysqli_query($sql->connection(), $query)){
            //     header("Location: index.php");//redirecting to other page
            // }else{
            //     echo "Query error ". mysqli_error($sql->connection());
            // }
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

            <input class="btn btn-brand" type="submit" name="submit" value="Submit">


        </form>
    </section>

    <?php include("templates/footer.php"); ?>
</html>