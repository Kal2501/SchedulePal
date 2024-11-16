const activePage = window.location.pathname;
const navLinks = document.querySelectorAll(".nav-links a");
const hamburger = document.querySelector(".hamburger");
const navmenu = document.querySelector(".nav-links");
hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navmenu.classList.toggle("active");
});
navLinks.forEach((link) => {
  //   console.log(link.href, "href");
  //   console.log(activePage, "activePage");
  //   console.log(link.href.split("/"));
  if (activePage.startsWith(`/${link.href.split("/")[3]}`)) {
    console.log("berhasil");
    console.log(link, "link");
    link.classList.add("active");
  }
});
