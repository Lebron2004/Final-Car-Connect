<?php
include('../theme/header.php');
include('../lib/crud.php');

$cars = get_all_cars();
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Welcome to Car Connection</h1>
    <div class="row">
        <?php foreach ($cars as $car): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="car-item p-3">
                    <img src="../data/car_images/<?php echo $car['id']; ?>.jpg" alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
                    <h3><?php echo $car['make'] . ' ' . $car['model']; ?></h3>
                    <p><strong>Price:</strong> $<?php echo number_format($car['price']); ?></p>
                    <a class="btn btn-primary" href="car_detail.php?id=<?php echo $car['id']; ?>">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('../theme/footer.php'); ?>
