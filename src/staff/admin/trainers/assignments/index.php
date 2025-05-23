<?php
session_start();

require_once "../../../../auth-guards.php";
auth_required_guard("admin", "/staff/login");

$id = $_GET['id'] ?? null;

require_once "../../../../alerts/functions.php";
require_once "../../../../db/models/Trainer.php";
require_once "../../../../db/models/Customer.php";


$sidebarActive = 4;
$pageStyles = ["../../admin.css"];

$trainer = new Trainer();
try {
    $trainer->id = $id;
    $trainer->get_by_id();
} catch (Exception $e) {
    redirect_with_error_alert("Failed to fetch trainer: " . $e->getMessage(), "/staff/admin/trainers/view/index.php?id=$id");
    exit;
}
$_SESSION['trainer'] = serialize($trainer);


$customers = null;
$customerModel = new Customer();
try {
    $customers = $customerModel->get_all_by_trainer($trainer->id);
} catch (Exception $e) {
    redirect_with_error_alert("Failed to fetch customers assigned: " . $e->getMessage(), "/staff/admin/trainers/view/index.php?id=$id");
    exit;
}

$menuBarConfig = [
    "title" => $trainer->fname . " " . $trainer->lname . " Assignments",
    "showBack" => true,
    "goBackTo" => "/staff/admin/trainers/view/index.php?id=" . $trainer->id,
];

require_once "../../pageconfig.php";
require_once "../../../includes/header.php";
require_once "../../../includes/sidebar.php";
?>

<main>
    <div class="staff-base-container">
        <?php require_once "../../../includes/menubar.php"; ?>
        <div style="margin: 20px; display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">

            <div class="trainer-view-profile alt">
                <div style="grid-row: 1; grid-column: 1; align-self: start; justify-self: start; text-align: left; padding: 15px;">
                <?php if (!empty($trainer->avatar)): ?>
                    <img src="../../../../uploads/<?= $trainer->avatar ?>" alt="Trainer Avatar"  class="trainer-view-avatar">
                <?php else: ?>
                    <img src="../../../../uploads/default-images/default-avatar.png" alt="Default Avatar" class="trainer-view-avatar">
                <?php endif; ?>
                </div>
                <div style="grid-row: 2; grid-column: 1; align-self: end; justify-self: center; text-align: center;">
                    <h1 style="margin: 10px; font-size: 28px;"><?= $trainer->fname . " " . $trainer->lname ?></h1>
                </div>
            </div>

            <form action="remove_customer.php" method="POST" 
            style="grid-column: 2; align-self: start; justify-self: end; text-align: right; width:100%;">
                <input type="hidden" name="trainer_id" value="<?= $trainer->id ?>">
                <h1 style="margin-bottom: 20px;">Customers Assigned</h1>
                <?php if (!empty($customers)): ?>
                    <div style="width:100%;">
                        <?php foreach ($customers as $customer): ?>
                            <div class="trainer-assignment-list-item">
                                <h3 style="grid-column: 1; justify-self: start;"><?= $customer->fname . " " . $customer->lname ?></h3>
                                <div style="grid-column: 2;">
                                <button type="submit" class="staff-btn-outline trainer-assignment-list-remove"
                                    name="customer_id" value="<?= $customer->id ?>">
                                    Remove
                                </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No customers assigned.</p>
                <?php endif; ?>
            </form>
            

        </div>
    </div>
</main>

<?php require_once "../../../includes/footer.php"; ?>
