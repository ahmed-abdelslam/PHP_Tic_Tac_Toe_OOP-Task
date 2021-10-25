<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

    <?php 
      include 'init.php';
    ?>

    <h1 class="text-center mt-2">Tic Tac Toe in PHP!</h1>

    <div class="container mt-5">
        <div class="row">

            <?php 
                for ($i = 0; $i < 9; $i++) {
            ?>

            <div class="col-4 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      
                        <?php if ($_SESSION['game_obj']->boxes[$i]->getSign() == '') { ?>
                          
                        <a href="/update.php?box_index=<?php echo $i;?>&sign=X">
                          <h5 class="card-title text-center">Choose </h5>
                        </a>
                        <?php 
                          }
                          else {
                        ?>
                        <h5 class="card-title text-center"><?php echo $_SESSION['game_obj']->boxes[$i]->getSign(); ?> </h5>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php 
                  }
            ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>