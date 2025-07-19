function setup_delete_buttons_to_open_modal(idMap) {
  let deleteButtons = document.getElementsByClassName("delete-button");

  for (let i = 0; i < deleteButtons.length; i++) {
    deleteButtons[i].addEventListener("click", () => {
      let id = idMap[i];
      // console.log(`delete button ${i} clicked. id = ${id}`);

      let modal = document.getElementById("mainModal");

      modalDeleteBtn = modal.getElementsByClassName("modal-delete-button")[0];
      modalDeleteBtn.setAttribute("href", `./delete_medium.php?id=${id}`);

      let titleElement = document.getElementById("mainModalLabel");
      titleElement.innerHTML = "Delete?";

      let modalBody = document.getElementsByClassName("modal-body")[0];
      modalBody.innerHTML = "You're about to delete this medium. Proceed?";

      let bsModal = new bootstrap.Modal(modal);
      bsModal.show();
    });
  }
}
