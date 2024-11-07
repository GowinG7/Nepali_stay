<?php

// Define constants for image paths
define('SITE_URL', 'http://127.0.0.1/nepali_stay/');
define('ABOUT_IMG_PATH', SITE_URL . 'images/about/');
define('CAROUSEL_IMG_PATH', SITE_URL . 'images/carousel/');
define('FACILITIES_IMG_PATH', SITE_URL . 'images/facilities/');


//backend uplaod process needs this data
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Nepali_stay/images/');
define('ABOUT_FOLDER', 'about/');
define('CAROUSEL_FOLDER', 'carousel/');
define('FACILITES_FOLDER', 'facilities/');
// Function to check if the user is logged in
function adminLogin() {
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "<script>
            window.location.href= 'index.php';
        </script>";
        exit; // Redirect and exit script
    }
}

// Function to redirect to a specific URL
function redirect($url) {
    echo "<script>
        window.location.href='$url';
    </script>";
    exit;
}

// Function to display alerts
function alert($type, $msg) {
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
    <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert"> <!-- Fixed role attribute -->
        <strong class="me-3">$msg</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    alert;
}

// Function to upload images
function uploadImage($image, $folder) {
    $valid_mime = ['image/jpeg', 'image/png','image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // Invalid image mime or format
    } else if (($image['size'] / (1024 * 1024)) > 2) { // Check size
        return 'inv_size'; // Invalid image size greater than 2mb
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext"; // Generate random name
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        // Ensure the target directory exists
        if (!is_dir(UPLOAD_IMAGE_PATH . $folder)) {
            mkdir(UPLOAD_IMAGE_PATH . $folder, 0755, true); // Create the directory if it doesn't exist
        }

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname; // Image upload success
        } else {
            return 'upd_failed'; // Upload failed
        }
    }
}

// Function to delete images
function deleteImage($image, $folder) {
    if (unlink(UPLOAD_IMAGE_PATH . $folder . $image)) {
        return true; // Image deleted successfully
    } else {
        return false; // Image deletion failed
    }
}

// Function to upload user images
function uploadUserImage($image) {
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // Invalid image mime or format
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".jpeg"; // Ensure correct format

        $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;

        // Create image based on extension
        if ($ext == 'png' || $ext == 'PNG') {
            $img = imagecreatefrompng($image['tmp_name']);
        } else if ($ext == 'webp' || $ext == 'WEBP') {
            $img = imagecreatefromwebp($image['tmp_name']);
        } else {
            $img = imagecreatefromjpeg($image['tmp_name']);
        }

        if (imagejpeg($img, $img_path, 75)) { // 75 is image quality
            return $rname; // Image upload success
        } else {
            return 'upd_failed'; // Upload failed
        }
    }
}

//for facility image upload
function uploadSVGImage($image, $folder) {
        $valid_mime = ['image/svg+xml'];
        $img_mime = $image['type'];

        if (!in_array($img_mime, $valid_mime)) {
            return 'inv_img'; // Invalid image mime or format
        } else if (($image['size'] / (1024 * 1024)) > 1) { // Check size
            return 'inv_size'; // Invalid image size greater than 1mb
        } else {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_' . random_int(11111, 99999) . ".$ext"; // Generate random name
            $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

            // Ensure the target directory exists
            if (!is_dir(UPLOAD_IMAGE_PATH . $folder)) {
                mkdir(UPLOAD_IMAGE_PATH . $folder, 0755, true); // Create the directory if it doesn't exist
            }

            if (move_uploaded_file($image['tmp_name'], $img_path)) {
                return $rname; // Image upload success
            } else {
                return 'upd_failed'; // Upload failed
            }
        }
    }

?>
