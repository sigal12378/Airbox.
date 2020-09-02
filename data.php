<?php session_start() ?>
<?php include('actions/dbh.php'); ?>
<?php include('helpers/Messages.php'); ?>
<?php if(!isset($_SESSION['user_data']) || !$_SESSION['user_data']['admin']) {
  Messages::setMsg("You must be admin to edit orders", 'error');
  header('Location: /');
  exit();
}

$dbh = DB::getInstance();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>haloogfhdfghdfhdo </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/orders.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/assets/js/index.js"></script>
    <!-- MESSAGES SCRIPT -->
    <?= Messages::getAlertsScript() ?>

  </head>

<body id="page-top">
    <nav class="navbar navbar-light navbar-expand-md navbar-expand-lg navbar-custom fixed-top" id="mainNav"
        style="background-image: url(&quot;assets/img/intro-bg.jpg&quot;);">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="/">AIRBOX</a>
                <button
                data-toggle="collapse" class="navbar-toggler navbar-toggler-right" data-target="#navbarResponsive"
                type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
                value="Menu"><i class="fa fa-bars"></i>
                </button>
    </nav>

    <?php if(isset($_GET['id'])): ?>
      <?php
        $dbh->query("SELECT * FROM orders WHERE id = :id");
        $dbh->bind(':id', $_GET['id']);
        $dbh->execute();
        $row = $dbh->singleAns();
      ?>

      <?php if($row): ?>
        <section id="haloooo" class="content-section">
            <div class="container">
                <div class="row">
                  <div class="col-12 text-center">
                    <h2 class="mx-auto"> SUMMARY </h2>
                  </div>
                  <div class="col-12 col-lg-6">
                    <div class="w-100"></div>
                    <p>
                      <h3> Sender: </h3> <div class="w-100"></div>
                      <span> <?= $row['sender'] ?> </span> <div class="w-100"></div>
                      <span> <?= $row['pickupaddress'] ?> </span> <div class="w-100"></div>
                      <span> <?= $row['phone'] ?> </span>
                    </p>
                    <div class="w-100"></div>

                    <p>
                      <h3> Recipient: </h3> <div class="w-100"></div>
                      <span> <?= $row['recipient'] ?> </span> <div class="w-100"></div>
                      <span> <?= $row['dropoffaddress'] ?> </span> <div class="w-100"></div>
                                      <span> <?= $row['recipient'] ?> </span>
                    </p>
                    <div class="w-100"></div>

                    <p>
                      <h3> Package Details: </h3> <div class="w-100"></div>
                      <span>
                        <?php switch ($row['size']) {
                          case 1:
                            echo 'Small Package up to 4X4X4<br>Max 0.5<br><span style="color: yellow">Price: $25.0</span>';
                            break;
                          case 2:
                            echo 'Medium Package up to 5X5X5<br>Max 1.0<br><span style="color: yellow">Price: $50.0</span>';
                            break;
                          case 3:
                            echo 'Large Package up to 7X7X7<br>Max 1.5<br><span style="color: yellow">Price: $75.0</span>';
                            break;
                          default:
                            echo '?';
                            break;
                        } ?>
                      </span> <div class="w-100"></div>
                    </p>
                  </div>
                  <div class="col-12 col-lg-6">
                    <form action="/actions/order/update.php" method="get">
                      <input type="hidden" name="action" value="update">
                      <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                      <div class="row">
                        <div class="col-9">
                          <select class="form-control my-2" name="status">
                            <option value="1" <?php if($row['status'] == 1) echo 'selected' ?>>Registered</option>
                            <option value="2" <?php if($row['status'] == 2) echo 'selected' ?>>Picked up</option>
                            <option value="3" <?php if($row['status'] == 3) echo 'selected' ?>>Sent</option>
                            <option value="4" <?php if($row['status'] == 4) echo 'selected' ?>>Dropped off</option>
                          </select>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <button class="btn btn-primary btn-block my-auto" type="submit">Set Status</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <a role="button" href="/actions/order/update.php?id=<?= $_GET['id'] ?>&action=delete" class="btn btn-danger btn-block">Remove</a>
                  </div>
                </div>
            </div>
        </section>
      <?php else: ?>
        <?php
          Messages::setMsg("No item with given id was found", 'error');
          header('Location: /orders.php');
          exit();
        ?>
      <?php endif ?>

    <?php else: ?>
      <?php
        $dbh->query("SELECT * FROM orders");
        $dbh->execute();
        $rows = $dbh->resultSet();
      ?>
      <section id="content" class="content-section">
          <div class="container">
              <div class="row">
                <input type="text" id="filterinput" class="form-control" placeholder="Filter by pickup location" onkeyup="filterResults()">
                <table id="table" class="table table-striped table-dark">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Sender</th>
                      <th scope="col">Pickup address</th>
                      <th scope="col">Recipient</th>
                      <th scope="col">Dropoff address</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($rows as $key => $value): ?>
                      <tr onclick="window.location.href = '/orders.php?id=<?= $value['id'] ?>'">
                        <th scope="row"><?= $value['id'] ?></th>
                        <td><?= $value['sender'] ?></td>
                        <td class="filter"><?= $value['pickupaddress'] ?></td>
                        <td><?= $value['recipient'] ?></td>
                        <td><?= $value['dropoffaddress'] ?></td>
                        <td>
                          <?php if($value['status'] == 1) echo 'Registered' ?>
                          <?php if($value['status'] == 2) echo 'Picked up' ?>
                          <?php if($value['status'] == 3) echo 'Sent' ?>
                          <?php if($value['status'] == 4) echo 'Dropped off' ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </section>

    <?php endif ?>

    <section id="about" class="content-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>About AirboX</h2>

                    <p>we provide inovative and fast delivery using air drones. no more waiting for the delivery man
                        stuck in traffic<br />
                        no more waiting hours at home for delivery. AirBox will pickup and deliver your package on your
                        convinient time and will fly to the destination in no time<br /> our service is unique and
                        unparallel in the market</p>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/grayscale.js"></script>
    <script src="assets/js/orders.js"></script>
</body>

</html>
