<?php
function get_all_cars() {
    return json_decode(file_get_contents('../data/cars.json'), true);
}

function get_car($id) {
    $cars = get_all_cars();
    foreach ($cars as $car) {
        if ($car['id'] == $id) {
            return $car;
        }
    }
    return null;
}

function create_car($make, $model, $year, $price, $description) {
    $cars = get_all_cars();
    $new_id = count($cars) + 1;
    $new_car = ['id' => $new_id, 'make' => $make, 'model' => $model, 'year' => $year, 'price' => $price, 'description' => $description];
    $cars[] = $new_car;
    file_put_contents('../data/cars.json', json_encode($cars, JSON_PRETTY_PRINT));
}

function edit_car($id, $make, $model, $year, $price, $description) {
    $cars = get_all_cars();
    foreach ($cars as &$car) {
        if ($car['id'] == $id) {
            $car['make'] = $make;
            $car['model'] = $model;
            $car['year'] = $year;
            $car['price'] = $price;
            $car['description'] = $description;
            break;
        }
    }
    file_put_contents('../data/cars.json', json_encode($cars,
