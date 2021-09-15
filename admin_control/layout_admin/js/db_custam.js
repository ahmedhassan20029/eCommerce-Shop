window.onload = function() {
    // start function show and hidden settings addmin in page dashboard.php
    var user_db = document.getElementById('user_db'),
        setting_admin = document.getElementById('setting_admin');
    user_db.onclick = function() {
        setting_admin.classList.toggle('toggle');
    }
    // end function show and hidden settings addmin in page dashboard.php
}