<?php
// Enable error reporting for development (disable for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'Router.php';

$router = new Router(); // Now auto-detects base path

include_once 'top.php';

// --- Define routes cleanly using inline functions ---

$router->route('/', function() use ($dApp) {
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true && !empty($dApp)) {
        header("Location: /$dApp");
        exit();
    } else {
        require 'default.php';
    }
});
$router->route('/', function() {
    require 'landing.php';
});

$router->route('/login', function() {
    require 'pool/auth/login.php';
});

$router->route('/signup', function() {
    require 'pool/auth/signup.php';
});

$router->route('/profile', function() {
    require 'apps/lib/ui/views/profile/profile.php';
});

// --- Profile setup page ---
$router->route('/profile_setup', function() {
    require 'pool/auth/profile.php';
});

$router->route('/home', function() {
    require 'apps/lib/ui/views/profile/profile.php';
});

$router->route('/log_api', function() {
    require 'pool/api/logsAPI.php';
});

$router->route('/forgot_pass', function() {
    require 'pool/auth/forgot_password.php';
});

$router->route('/reset_pass', function() {
    require 'pool/auth/reset_pass.php';
});

$router->route('/invite', function() {
    require 'pool/auth/invite.php';
});

$router->route('/logout', function() {
    require 'pool/auth/logout.php';
});

// --- Work App Sections ---
$router->route('/mbid', function() {
    require 'work/api/autowork.php';
});

$router->route('/atw', function() {
    require 'apps/autowork/api/atw.php';
});

$router->route('/aw', function() {
    require 'apps/autowork/api/atwork.php';
});

$router->route('/elite', function() {
    require 'apps/autowork/ui/views/elite.php';
});

$router->route('/aw_t', function() {
    require 'apps/autowork/api/aw_tests.php';
});

$router->route('/mybids', function() {
    require 'apps/autowork/api/bids_history.php';
});

$router->route('/aw_bid', function() {
    require 'apps/autowork/api/atwork_bid.php';
});

$router->route('/atwdb', function() {
    require 'apps/autowork/api/dbAPI.php';
});

$router->route('/aw/home', function() {
    require 'apps/autowork/ui/views/home.php';
});

$router->route('/addg', function() {
    require 'apps/autowork/api/autowork.php';
});

$router->route('/apps/work/services/elite', function() {
    require 'apps/work/ui/views/services/home/elite.php';
});

$router->route('/apps/work/services/history', function() {
    require 'apps/work/ui/views/services/home/bids.php';
});

$router->route('/apps/work/services/home', function() {
    require 'apps/work/ui/views/services/home/home.php';
});

$router->route('/work', function() {
    require 'apps/autowork/ui/views/home.php';
});

$router->route('/work/projects', function() {
    require 'apps/autowork/ui/views/projects.php';
});

$router->route('/topics', function() {
    require 'pool/auth/topics.php';
});

$router->route('/terms', function() {
    require 'pool/auth/terms.php';
});

$router->route('/help', function() {
    require 'pool/help/helpdesk.php';
});

$router->route('/privacy', function() {
    require 'pool/auth/privacy.php';
});

$router->route('/setup', function() {
    require 'pool/config/db_setup.php';
});

$router->route('/edu_db_setup', function() {
    require 'apps/edu/api/dbAPI.php';
});

$router->route('/per_db_setup', function() {
    require 'apps/personal/api/dbAPI.php';
});

$router->route('/work_db_setup', function() {
    require 'apps/work/api/dbAPI.php';
});

$router->route('/dev', function() {
    require 'pool/dev/vackup/versions.php';
});

$router->route('/backup', function() {
    require 'pool/config/backup.php';
});

$router->route('/main', function() {
    require 'default.php';
});

$router->route('/verification', function() {
    require 'pool/auth/verification.php';
});



// --- LAB and Blog sections ---
$router->route('/learn', function() {
    require 'apps/edu/ui/views/learn/app.php';
});



$router->route('/blog', function() {
    require 'apps/edu/ui/views/blogs/app.php';
});

$router->route('/blog/cms', function() {
    require 'apps/edu/ui/views/blogs/cms/list.php';
});

$router->route('/blog/cms/create', function() {
    require 'apps/edu/ui/views/blogs/cms/create.php';
});

$router->route('/blog/cms/edit', function() {
    require 'apps/edu/ui/views/blogs/cms/edit.php';
});

$router->route('/blog/cms/delete', function() {
    require 'apps/edu/ui/views/blogs/cms/delete.php';
});

$router->route('/issues', function() {
    require 'apps/edu/ui/views/blogs/app.php';
});

// --- LIB (Library App) ---
$router->route('/lib', function() {
    require 'apps/lib/ui/views/home/app.php';
});

$router->route('/ads', function() {
    require 'apps/lib/ui/views/home/ads.php';
});



$router->route('/settings', function() {
    require 'apps/lib/ui/views/settings/settings.php';
});

$router->route('/pricing', function() {
    require 'apps/edu/ui/views/subscription/pricing.php';
});

// --- APIs for Education App ---
$router->route('/edu_assets', function() {
    require 'apps/edu/ui/assets';
});

$router->route('/edu_note', function() {
    require 'apps/edu/api/noteAPI.php';
});

$router->route('/edu_blog', function() {
    require 'apps/edu/api/blogAPI.php';
});

$router->route('/edu_img_api', function() {
    require 'apps/edu/api/imgAPI.php';
});

$router->route('/edu_search_api', function() {
    require 'apps/edu/api/open_ai.php';
});

$router->route('/teach_api', function() {
    require 'apps/edu/api/teachAPI.php';
});

// --- APIs for Personal App ---
$router->route('/per_task', function() {
    require 'apps/personal/api/taskAPI.php';
});

$router->route('/personal_assets', function() {
    require 'apps/personal/ui/assets';
});

$router->route('/task', function() {
    require 'apps/personal/ui/views/home/task.php';
});



$router->route('/finance', function() {
    require 'apps/fincycle/index.php';
});



// --- Personal App Section ---
$router->route('/personal', function() {
    require 'apps/personal/ui/views/home/app.php';
});



// --- Handle the current request ---
$router->handleRequest($_SERVER['REQUEST_URI']);

