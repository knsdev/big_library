<?php

function create_modal_layout()
{
  return "
    <div class='modal fade' id='mainModal' tabindex='-1' aria-labelledby='mainModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h1 class='modal-title fs-5' id='mainModalLabel'></h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'></div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <a href='' class='btn btn-danger modal-delete-button'>Delete</a>
          </div>
        </div>
      </div>
    </div>
  ";
}

function create_js_id_map($rows)
{
  echo 'let idMap = [';

  for ($i = 0; $i < count($rows); $i++) {
    $row = $rows[$i];

    if ($i != 0) {
      echo ', ';
    }

    echo $row['id'];
  }

  echo '];';
}
