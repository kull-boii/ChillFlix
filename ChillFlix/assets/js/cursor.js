// aim is to create custom cursor styles

// selecting the cursor
let cursor = document.querySelector(".cursor");

// grabbing all links in the page
let links = document.querySelectorAll("a");

window.addEventListener("mousemove", moveCursor);

function moveCursor(e) {
  cursor.style.top = e.pageY + "px";
  cursor.style.left = e.pageX + "px";
}

// iterating over links to add an cool transition when we hover over them
links.forEach((link) => {
  link.addEventListener("mouseleave", () => {
    cursor.classList.remove("link-grow");
  });
  link.addEventListener("mouseover", () => {
    cursor.classList.add("link-grow");
  });
});

let headings = document.querySelectorAll("h3.head-season > span");

headings.forEach((heading) => {
  heading.addEventListener("mouseleave", () => {
    cursor.classList.remove("link-grow");
  });

  heading.addEventListener("mouseover", () => {
    cursor.classList.add("link-grow");
  });
});
