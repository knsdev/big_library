let toggleEditButton = document.getElementById("toggle-edit");
let createButton = document.getElementById("create-button");
let updateButtons = document.getElementsByClassName("update-button");
let deleteButtons = document.getElementsByClassName("delete-button");

const localStorageKey = "big_library_is_editing";

let localStorageIsEditing = localStorage.getItem(localStorageKey);
let isEditing = localStorageIsEditing == null || localStorageIsEditing == "1";
apply_edit_or_view_mode();

toggleEditButton.addEventListener("click", () => {
  isEditing = !isEditing;
  localStorage.setItem(localStorageKey, isEditing ? "1" : "0");
  apply_edit_or_view_mode();
});

function set_class(classList, classToSet, enabled) {
  if (enabled) {
    if (!classList.contains(classToSet)) classList.add(classToSet);
  } else {
    classList.remove(classToSet);
  }
}

function apply_edit_or_view_mode() {
  if (createButton) {
    set_class(createButton.classList, "btn-invisible", !isEditing);
  }

  for (let btn of updateButtons) {
    set_class(btn.classList, "btn-invisible", !isEditing);
  }

  for (let btn of deleteButtons) {
    set_class(btn.classList, "btn-invisible", !isEditing);
  }

  if (isEditing) {
    toggleEditButton.innerHTML = `<i class="bi bi-pencil"></i>`;
  } else {
    toggleEditButton.innerHTML = `<i class="bi bi-eye"></i>`;
  }

  set_class(toggleEditButton.classList, "btn-outline-primary", isEditing);
  set_class(toggleEditButton.classList, "btn-outline-secondary", !isEditing);
}
