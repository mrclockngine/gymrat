<?php
// File path: src/trainer/customers/profile/delete-log/index.php
require_once "../../../../auth-guards.php";
if (auth_required_guard("trainer", "/trainer/login")) exit;

require_once "../../../../db/models/TrainerLogRecord.php";
require_once "../../../../alerts/functions.php";

// Get log ID and customer ID from URL
$logId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$customerId = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;

// If IDs are missing, redirect back
if (!$logId || !$customerId) {
    redirect_with_error_alert("Invalid log record ID", "../add-log/?id=$customerId");
}

// Get the log record
$logRecord = new TrainerLogRecord();
$logRecord->id = $logId;

try {
    $logRecord->get_by_id();
    
    // Check if this log belongs to the current trainer
    $trainer_id = $_SESSION['auth']['id'];
    if ($logRecord->trainer_id != $trainer_id) {
        redirect_with_error_alert("You can only delete your own log records", "../add-log/?id=$customerId");
    }
    
    // Double check the customer ID
    if ($logRecord->customer_id != $customerId) {
        redirect_with_error_alert("Invalid log record for this customer", "../add-log/?id=$customerId");
    }
} catch (Exception $e) {
    redirect_with_error_alert("Log record not found", "../add-log/?id=$customerId");
}

// Get customer details
require_once "../../../../db/Database.php";
$conn = Database::get_conn();
$sql = "SELECT id, fname, lname FROM customers WHERE id = :customer_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':customer_id', $customerId);
$stmt->execute();
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$customer) {
    redirect_with_error_alert("Customer not found", "../");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Delete the log record
        $logRecord->delete();
        
        // Redirect with success message
        redirect_with_success_alert("Log record deleted successfully", "../add-log/?id=$customerId");
    } catch (Exception $e) {
        redirect_with_error_alert("Error deleting log record: " . $e->getMessage(), "../add-log/?id=$customerId");
    }
}

$pageConfig = [
    "title" => "Delete Progress Log",
    "styles" => [
        "./delete-log.css"
    ],
    "navbar_active" => 1,
    "titlebar" => [
        "back_url" => "../add-log/?id=" . $customerId,
        "title" => "DELETE PROGRESS LOG"
    ]
];

require_once "../../../includes/header.php";
require_once "../../../includes/titlebar.php";
?>

<main class="add-log-page">
    <div class="customer-info">
        <h2>Customer: <?= htmlspecialchars($customer['fname'] . ' ' . $customer['lname']) ?></h2>
    </div>

    <div class="confirmation-card">
        <h2>Delete Progress Log</h2>
        <p>Are you sure you want to delete this progress log?</p>
        
        <div class="log-preview">
            <div class="log-item <?= $logRecord->performance_type === 'well_done' ? 'well-done' : 'try-harder' ?>">
                <div class="log-message">
                    <?= htmlspecialchars($logRecord->message) ?>
                </div>

                <div class="log-footer">
                    <span class="log-date"><?= $logRecord->created_at->format('M d, Y') ?></span>

                    <span class="performance-badge <?= $logRecord->performance_type === 'well_done' ? 'well-done' : 'try-harder' ?>">
                        <?= $logRecord->get_perfomance_type_text() ?>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="action-buttons">
            <form method="POST">
                <button type="submit" style="width: 100%;" class="btn">Delete</button>
            </form>
        </div>
    </div>
</main>

<!-- Styles moved to delete-log.css -->

<?php require_once "../../../includes/navbar.php" ?>
<?php require_once "../../../includes/footer.php" ?>

<!-- Removed inline styles since they are now in the CSS file -->