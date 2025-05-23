<?php
$active = $pageConfig['navbar_active'] ?? null;
?>

<div class="navbar">
    <a href="/rat/index.php" class="<?php echo $active === 1 ? 'active' : '' ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.25 12L11.2045 3.04545C11.6438 2.60611 12.3562 2.60611 12.7955 3.04545L21.75 12M4.5 9.74995V19.875C4.5 20.4963 5.00368 21 5.625 21H9.75V16.125C9.75 15.5036 10.2537 15 10.875 15H13.125C13.7463 15 14.25 15.5036 14.25 16.125V21H18.375C18.9963 21 19.5 20.4963 19.5 19.875V9.74995M8.25 21H16.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <a href="/rat/notifications/index.php" class="<?php echo $active === 2 ? 'active' : '' ?>">
        <span class="count"></span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.8569 17.0817C16.7514 16.857 18.5783 16.4116 20.3111 15.7719C18.8743 14.177 17.9998 12.0656 17.9998 9.75V9.04919C17.9999 9.03281 18 9.01641 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9L5.9998 9.75C5.9998 12.0656 5.12527 14.177 3.68848 15.7719C5.4214 16.4116 7.24843 16.857 9.14314 17.0818M14.8569 17.0817C13.92 17.1928 12.9666 17.25 11.9998 17.25C11.0332 17.25 10.0799 17.1929 9.14314 17.0818M14.8569 17.0817C14.9498 17.3711 15 17.6797 15 18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18C9 17.6797 9.05019 17.3712 9.14314 17.0818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <a href="/rat/profile/index.php" class="<?php echo $active === 3 ? 'active' : '' ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.7501 6C15.7501 8.07107 14.0712 9.75 12.0001 9.75C9.92902 9.75 8.25009 8.07107 8.25009 6C8.25009 3.92893 9.92902 2.25 12.0001 2.25C14.0712 2.25 15.7501 3.92893 15.7501 6Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M4.50122 20.1182C4.57153 16.0369 7.90196 12.75 12.0001 12.75C16.0983 12.75 19.4288 16.0371 19.499 20.1185C17.2162 21.166 14.6765 21.75 12.0004 21.75C9.32408 21.75 6.78418 21.1659 4.50122 20.1182Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <!-- <a href="/rat/settings/index.php" class="<?php echo $active === 4 ? 'active' : '' ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.59377 3.94017C9.68418 3.39771 10.1535 3.00012 10.7035 3.00012H13.2974C13.8474 3.00012 14.3167 3.39771 14.4071 3.94017L14.6206 5.22122C14.683 5.59527 14.9329 5.90683 15.2647 6.09048C15.3389 6.13154 15.4122 6.17396 15.4846 6.21769C15.8097 6.41396 16.205 6.47499 16.5606 6.34178L17.7774 5.8859C18.2924 5.69297 18.8714 5.90063 19.1464 6.3769L20.4434 8.62333C20.7183 9.0996 20.6087 9.70485 20.1841 10.0544L19.1798 10.8812C18.8873 11.122 18.7423 11.4938 18.7493 11.8727C18.7501 11.915 18.7504 11.9575 18.7504 12.0001C18.7504 12.0427 18.7501 12.0852 18.7493 12.1276C18.7423 12.5064 18.8873 12.8782 19.1798 13.119L20.1841 13.9458C20.6087 14.2954 20.7183 14.9006 20.4434 15.3769L19.1464 17.6233C18.8714 18.0996 18.2924 18.3073 17.7774 18.1143L16.5606 17.6585C16.205 17.5252 15.8097 17.5863 15.4847 17.7825C15.4122 17.8263 15.3389 17.8687 15.2647 17.9098C14.9329 18.0934 14.683 18.405 14.6206 18.779L14.4071 20.0601C14.3167 20.6025 13.8474 21.0001 13.2974 21.0001H10.7035C10.1535 21.0001 9.68418 20.6025 9.59377 20.0601L9.38026 18.779C9.31792 18.405 9.06795 18.0934 8.73618 17.9098C8.66201 17.8687 8.58869 17.8263 8.51626 17.7826C8.19122 17.5863 7.79589 17.5253 7.44033 17.6585L6.22346 18.1143C5.70847 18.3073 5.12948 18.0996 4.8545 17.6233L3.55752 15.3769C3.28255 14.9006 3.3922 14.2954 3.81678 13.9459L4.82114 13.119C5.11364 12.8782 5.25864 12.5064 5.25163 12.1276C5.25084 12.0852 5.25045 12.0427 5.25045 12.0001C5.25045 11.9575 5.25084 11.9151 5.25163 11.8727C5.25864 11.4939 5.11364 11.122 4.82114 10.8812L3.81678 10.0544C3.3922 9.70487 3.28255 9.09961 3.55752 8.62335L4.8545 6.37691C5.12948 5.90065 5.70847 5.69298 6.22346 5.88591L7.44031 6.34179C7.79588 6.475 8.19121 6.41397 8.51624 6.2177C8.58868 6.17396 8.662 6.13154 8.73618 6.09048C9.06795 5.90683 9.31792 5.59527 9.38026 5.22122L9.59377 3.94017Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M15.0002 12C15.0002 13.6569 13.6571 15 12.0002 15C10.3434 15 9.00022 13.6569 9.00022 12C9.00022 10.3432 10.3434 9.00004 12.0002 9.00004C13.6571 9.00004 15.0002 10.3432 15.0002 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a> -->
</div>

<script>
    const notifications_count_span = document.querySelector("a[href='/rat/notifications/index.php'] span.count");
    const when_notifications_update = (notifications) => {
        const unread_count = notifications.filter(notification => !notification.is_read).length;
        if (unread_count) {
            notifications_count_span.innerText = unread_count;
            notifications_count_span.classList.add("active");
        } else {
            notifications_count_span.innerText = "";
            notifications_count_span.classList.remove("active");
        }
    }
    init_notifications();
    notification_listeners.add_listener(when_notifications_update);
</script>