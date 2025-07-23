<?php

enum ImageFileUploadResult
{
  case NoFileUploaded;
  case UnknownError;
  case InvalidFile;
  case Success;
}

/**
 * Handles the uploaded image file from a form and returns the new filename
 *
 * @param array $param the array you get from FILES['form-input-name']
 * @param string $folderName the name of the folder for uploaded images without '/'
 * 
 * @return array [0] filename string | null , [1] enum ImageFileUploadResult
 */
function image_file_upload($param, $folderName)
{
  // echo '<pre>';
  // var_dump($param);
  // echo '</pre>';

  $upload_error = $param['error'];
  $original_name = $param['name'];
  $tmp_name = $param['tmp_name'];

  if ($upload_error == 4) {
    return [null, ImageFileUploadResult::NoFileUploaded];
  } else if ($upload_error != 0) {
    return [null, ImageFileUploadResult::UnknownError];
  } else {
    if (!getimagesize($tmp_name)) {
      return [null, ImageFileUploadResult::InvalidFile];
    }

    $filename = uniqid("img_");
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
    $destination = "$folderName/" . $filename . "." . $ext;

    if (!is_dir("$folderName")) {
      mkdir("$folderName");
    }

    if (!move_uploaded_file($tmp_name, $destination)) {
      return [null, ImageFileUploadResult::InvalidFile];
    }

    return [$filename . "." . $ext, ImageFileUploadResult::Success];
  }
}

function imageFileDelete($img, $folderName)
{
  if ($img[0]) {
    unlink($folderName . '/' . $img[0]);
  }
}
