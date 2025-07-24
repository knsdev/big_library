<?php
require_once __DIR__ . '/modal.php';

function limit_string_length($input_string, $max_length)
{
  $output_string = $input_string;

  if (strlen($input_string) > $max_length) {
    $output_string = substr($input_string, 0, $max_length - 3);
    $output_string .= "...";
  }

  return $output_string;
}

function create_media_card_layout($rows, $showLinkToPublisher)
{
  $layout = "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 justify-content-center justify-content-md-start'>";

  foreach ($rows as $row) {
    $id = $row['id'];
    $title = $row['title'];
    $image = $row['image'];
    // $isbn_code = $row['isbn_code'];
    // $short_description = $row['short_description'];
    $type = $row['type'];
    $author_first_name = $row['author_first_name'];
    $author_last_name = $row['author_last_name'];
    $publisher_name = $row['publisher_name'];
    // $publisher_address = $row['publisher_address'];
    // $publish_date = $row['publish_date'];
    $status = ($row['status']) ? "Available" : "Reserved";

    $card_text_max_length = 30;

    $title = limit_string_length($title, $card_text_max_length);
    $author_full_name = limit_string_length($author_first_name . " " . $author_last_name, $card_text_max_length);

    $publisher_name_url_encoded = htmlspecialchars(urlencode($publisher_name));
    $publisher_name_shorter = limit_string_length($publisher_name, $card_text_max_length);

    $publisher_html = ($showLinkToPublisher) ?
      "<a href='publisher.php?publisher_name=$publisher_name_url_encoded'><p class='card-text mb-2'>$publisher_name_shorter</p></a>"
      : "<p class='card-text mb-2'>$publisher_name_shorter</p>";

    $editButtons = (isset($_SESSION['admin'])) ? "<a href='./medium_update.php?id=$id' class='update-button btn-invisible btn btn-success'>Update</a>
                    <button type='button' class='delete-button btn-invisible btn btn-danger'>Delete</button>" : "";

    $layout .= "<div class='col' style='width: fit-content'>
                  <div class='card mb-3 shadow-sm' style='width: 18rem'>
                    <img src='$image' class='card-img-top' alt=''>
                    <div class='card-body'>
                      <h5 class='card-title mb-2'>$title</h5>
                      <p class='card-text mb-2'>$type</p>
                      <p class='card-text mb-2'>$author_full_name</p>
                      $publisher_html
                      <p class='card-text mb-2'>$status</p>
                      <div class='d-flex gap-2 justify-content-start align-items-start'>
                        <a href='./medium_details.php?id=$id' class='btn btn-primary'>Details</a>
                        $editButtons
                      </div>
                    </div>
                  </div>
                </div>";
  }

  $layout .= "</div>";
  $layout .= create_modal_layout();

  return $layout;
}
