<?php

session_start();

require_once "../../../../alerts/functions.php";
require_once "../../../../db/models/Equipment.php";
require_once "../../../../uploads.php";

if($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect_with_error_alert("Method not allowed", "/staff/eq/equipments");
    exit;
}
if (!isset($_SESSION['equipment'])) {
    redirect_with_error_alert("Session variables not set", "/staff/eq/equipments");
    exit;
}

$equipment_id = $_POST['equipment_id'];
$name = $_POST['equipment_name'];
$description = $_POST['equipment_description'];
$type = $_POST['equipment_category'];
$quantity = isset($_POST['equipment_quantity']) ? (int) $_POST['equipment_quantity'] : null;
$status = $_POST['equipment_status'];
$last_maintenance = $_POST['equipment_last_maintenance'] ?? null;

// Validation
$errors = [];

if (empty($name)) $errors[] = "Name is required.";
if (empty($description)) $errors[] = "Description is required.";
if (empty($type)) $errors[] = "Category is required.";


if ($quantity === null || !is_numeric($quantity)) {
    $errors[] = "Quantity is required and must be a number.";
}

if (empty($status) || !in_array($status, ['available', 'not available'])) {
    $errors[] = "Status is required and must be either 'available' or 'not available'.";
}

if (!empty($last_maintenance)) {
    try {
        $last_maintenance = new DateTime($last_maintenance);
        $now = new DateTime();
        if ($last_maintenance > $now) {
            $errors[] = "Last maintenance date cannot be in the future.";
        }
    } catch (Exception $e) {
        $errors[] = "Invalid last maintenance date format.";
    }
}

// image upload
$image = $_FILES['equipment_image']['name'] ? $_FILES['equipment_image'] : null;
if ($image) {
    try {
        $image = upload_file("staff-equipment-images", $image);
    } catch (\Throwable $th) {
        redirect_with_error_alert("Failed to upload image due to an error: " . $th->getMessage(), "/staff/eq/equipments/edit?id=" . $id);
        exit;
    }
}

$equipment = unserialize($_SESSION['equipment']);

// check for existing image and delete if found
if ($equipment->image && $image) {
    $old_image = $equipment->image;
    try {
        delete_file($old_image);
    } catch (\Throwable $th) {
        $_SESSION['error'] = "Failed to delete existing image due to an error: " . $th->getMessage();
    }
    $equipment->image = $image;
}

$equipment->name = $name;
$equipment->description = $description;
$equipment->type = $type;
$equipment->quantity = $quantity;
$equipment->status = $status;
$equipment->image = $image ?? $equipment->image;
$equipment->last_maintenance = $last_maintenance ?? $equipment->last_maintenance;

$_SESSION['equipment'] = serialize($equipment);

if(!empty($errors)) {
    $error_message = implode(" ", $errors);
    redirect_with_error_alert($error_message, "/staff/eq/equipments/edit?id=" . $id);
    exit;
}

try {
    $equipment->save($image);
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        redirect_with_error_alert("Failed to edit equipment due to an error: Equipment with the same name already exists", "/staff/eq/equipments/edit?id=" . $equipment_id);
    }
    redirect_with_error_alert("Failed to update equipment due to an error: " . $e->getMessage(), "/staff/eq/equipments/edit?id=" . $equipment_id);
    exit;
}

unset($_SESSION['equipment']);
unset($_SESSION['equipment_id']);

redirect_with_success_alert("Equipment updated successfully", "/staff/eq/equipments/view?id=" . $equipment_id);
?>
