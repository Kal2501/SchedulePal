const activePage = window.location.pathname;
const navLinks = document.querySelectorAll(".nav-links a");
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
