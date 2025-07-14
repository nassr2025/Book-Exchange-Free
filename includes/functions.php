<?php

// تنظيف النصوص
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// إعادة التوجيه
function redirect($url) {
    header("Location: $url");
    exit();
}

// التحقق من البريد
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}