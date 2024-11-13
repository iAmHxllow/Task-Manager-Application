// Open and Close Sidebar Functionality
const openAndCloseSidebarBtn = document.getElementById("open-and-close-sidebar");
const flexContainer = document.getElementsByClassName("flex-container")[0];
const main = document.getElementsByTagName("main")[0];

console.log(openAndCloseSidebarBtn);

openAndCloseSidebarBtn.addEventListener("click", function () {
  if (flexContainer.classList.toggle("hide")) {
    main.style.marginLeft = "0";
    this.style.rotate = "180deg"
  } else {
    main.style.marginLeft = "270px";
    this.style.rotate = "0deg";
  }
})

// Open and Close Share Button Functionality 
document.addEventListener("DOMContentLoaded", function() {
  const shareIcon = document.getElementById("share-icon");
  const shareContainer = document.getElementById("share-container");
  let isShareContainerVisible = false;

  shareIcon.addEventListener("click", function() {
      if (isShareContainerVisible) {
          shareContainer.style.display = "none";
      } else {
          shareContainer.style.display = "flex";
      }
      isShareContainerVisible = !isShareContainerVisible;
  });
});

//Can Edit Function for collab page
document.getElementById('can_edit_checkbox').addEventListener('change', function () {
  document.getElementById('can_edit').value = this.checked ? 1 : 0;
});