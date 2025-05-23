<?php
require_once "../../auth-guards.php";
if (auth_required_guard("rat", "/rat/login")) exit;


require_once "../../db/models/Customer.php";

$user = new Customer();
$user->fill([
    "id" => $_SESSION['auth']['id']
]);

try {
    $user->get_by_id();
} catch (PDOException $e) {
    die("Failed to get user due to error: " . $e->getMessage());
}

$avatar = $user->avatar ? "/uploads/" . $user->avatar : "/uploads/default-images/default-avatar.png";

$pageConfig = [
    "title" => "My Profile",
    "navbar_active" => 3,
    "styles" => ["./profile.css"]
];

require_once "../includes/header.php";
require_once "../includes/titlebar.php";
?>

<main>
    <img src="<?= $avatar ?>" alt="" class="avatar">
    <h1><?= $user->fname ?> <?= $user->lname ?></h1>
    <div class="lines">
        <div class="line">
            <span class="title">Email</span>
            <a href="mailto:<?= $user->email ?>" class="content"><?= $user->email ?></a>
        </div>
        <div class="line">
            <span class="title">Phone</span>
            <a href="tel:<?= $user->phone ?>" class="content"><?= $user->phone ?></a>
        </div>
        <div class="line">
            <span class="title">Joined at</span>
            <p class="content"><?= $user->created_at->format("M d, Y") ?></p>
        </div>
        <?php if ($user->updated_at->format("M d, Y, h:i A") !== $user->created_at->format("M d, Y, h:i A")): ?>
            <div class="line">
                <span class="title">Last updated at</span>
                <p class="content"><?= $user->updated_at->format("M d, Y, h:i A") ?></p>
            </div>
        <?php endif; ?>
    </div>
    <a href="./update" class="btn">Update Profile</a>
    <button onclick="logout()" class="btn secondary">Logout</button>
    <form class="download_user_data" action="./download_user_data_process.php" method="post">
        <button type="submit" class="btn outlined">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down-to-line-icon lucide-arrow-down-to-line">
                <path d="M12 17V3" />
                <path d="m6 11 6 6 6-6" />
                <path d="M19 21H5" />
            </svg>
            <span>Download User Data</span>
        </button>
    </form>
    <script>
        const logout = () => {
            if (<?= isset($_SESSION['workout_session']) ? 'true' : 'false' ?>) {
                alert("You have an active workout session. Please end it before logging out.");
            } else {
                window.location.href = "../logout.php";
            }
        }
    </script>
    <?php if (!$user->avatar): ?>
        <p class="paragraph" style="text-align: center;font-size: 10px;margin-top:20px;color: var(--color-zinc-500)">Default
            avatar image is <br />downloaded from <a href="https://www.freepik.com" target="_blank"
                referrerpolicy="no-reffer" style="text-decoration: underline;">www.freepik.com</a>.</p>
    <?php endif; ?>
</main>

<?php require_once "../includes/navbar.php" ?>
<?php require_once "../includes/footer.php" ?>