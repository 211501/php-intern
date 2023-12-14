<?php
// Hàm mã hóa số id thành một chuỗi ngẫu nhiên
function encodeId($id) {
    // Logic mã hóa ở đây, ví dụ sử dụng base64_encode
    return base64_encode($id);
}

// Hàm giải mã chuỗi ngẫu nhiên thành số id
function decodeId($encodedId) {
    // Logic giải mã ở đây, ví dụ sử dụng base64_decode
    return base64_decode($encodedId);
}

function hashedSHA256($id) {
    return $hashedIdSHA256 = hash('sha256', $id);
}
?>


