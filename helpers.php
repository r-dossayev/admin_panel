<?php



if (!function_exists('fileValidator')) {
    function fileValidator($file): string
    {

        $errors = '';
        $fileSize = $file['size'];
        $fileType = $file['type'];
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if ($fileSize > 1000000) {
            $errors .= 'File size must be less than 1MB';
        }
        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors .= 'File type must be jpg, jpeg, png or gif';
        }
        return $errors;
    }
}
if (!function_exists('attachFile')) {
    function attachFile($file): string
    {
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileExtension;
        $fileDestination = './uploads/' . $fileName;
        move_uploaded_file($file['tmp_name'], $fileDestination);
        return $fileName;
    }
}
if (!function_exists('checkField')) {
    function checkField($field): string
    {
        $errors = '';
        // check isset
        if (!isset($field)) {
            $errors .= 'Field is required';
        }
        return $errors;
    }
}

if (!function_exists('checkEmail')) {
    function checkEmail($email): string
    {
        $errors = '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors .= 'Email is not valid';
        }
        return $errors;
    }
}








