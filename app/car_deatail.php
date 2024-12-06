<?php
include('../theme/header.php');
include('../lib/crud.php');

$car_id = $_GET['id'];
$car = get_car($car_id);
?>

<div class="container my-5">
    <h1 class="text-center mb-4"><?php echo $car['make'] . ' ' . $car['model']; ?></h1>
    <div class="row">
        <div class="col-md-6">
            <img src="../data/car_images/<?php echo $car['id']; ?>.jpg" class="img-fluid" alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
        </div>
        <div class="col-md-6">
            <h3><strong>Price:</strong> $<?php echo number_format($car['price']); ?></h3>
            <p><strong>Year:</strong> <?php echo $car['year']; ?></p>
            <p><strong>Description:</strong> <?php echo $car['description']; ?></p>
            <a class="btn btn-primary" href="create_car.php">Create New Listing</a>
        </div>
    </div>
</div>

<?php include('../theme/footer.php'); ?>
