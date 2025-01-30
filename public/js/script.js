const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const sidebarClose = document.querySelector(".collapse_sidebar");
const sidebarExpand = document.querySelector(".expand_sidebar");

// Ensure the sidebar is closed initially when the page loads
document.addEventListener("DOMContentLoaded", () => {
  sidebar.classList.add("close"); // Ensure the sidebar starts closed
  sidebar.classList.add("hoverable"); // Optional: Remove hoverable class if you don't want hover behavior initially
});

// Event listener for opening the sidebar
sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

// Event listener for closing the sidebar manually
sidebarClose.addEventListener("click", () => {
  sidebar.classList.add("close", "hoverable");
});

// Event listener for expanding the sidebar manually
sidebarExpand.addEventListener("click", () => {
  sidebar.classList.remove("close", "hoverable");
});

// Mouse enter event to reveal sidebar if hoverable
sidebar.addEventListener("mouseenter", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
  }
});

// Mouse leave event to hide sidebar if hoverable
sidebar.addEventListener("mouseleave", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
  }
});

// Dark/light mode toggle event
darkLight.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (body.classList.contains("dark")) {
    darkLight.classList.replace("bx-sun", "bx-moon");
  } else {
    darkLight.classList.replace("bx-moon", "bx-sun");
  }
});

// Submenu toggle event
submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
  });
});
