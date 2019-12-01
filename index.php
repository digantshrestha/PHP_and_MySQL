<?php

    include("SQL_Config.php");

    $sql = new SQL_Config();
    $sql->setConn('localhost','root','database1234','pizzaDB');
    $sql->setQuery('SELECT id, title, ingredients, email, created_at FROM pizzas ORDER BY created_at');
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("templates/header.php"); ?>

    <div class="container pizza-list">
        <div class="row">
        <?php foreach($sql->process() as $p): ?>

            <div class="col-md-6 box">
                <div class="card">
                    <div class="card-body clearfix">
                        <h6 class="card-title"><?php echo $p['title']; ?></h6>
                        <div class="card-text"><?php echo $p['ingredients']; ?></div>
                        <small class="float-left date">Created At : <?php echo $p['created_at']; ?></small>
                        <a href="#" class="btn btn-sm more float-right">More Info</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
        </div>
    </div>

    <?php include("templates/footer.php"); ?>
</html>