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