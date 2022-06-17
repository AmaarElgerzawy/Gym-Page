let headerLi = Array.from(document.querySelectorAll(".list > li ")),
headerLiicon = Array.from(document.querySelectorAll(".list > li h3 i ")),
headerfreepaid = Array.from(document.querySelectorAll(".servise li h6")),
headerfreepaidicon = Array.from(document.querySelectorAll(".servise li h6 > i")),
  list = document.getElementById("list"),
  arrlist = Array.from(document.querySelectorAll(".list li h3"))
bars = document.getElementById("small")


for (let i = 0; i < headerLi.length; i++) {
  headerLi[i].addEventListener("click", function (e) {
    try {
      if (e.target.nextElementSibling.classList.contains("headerliShow")) {
        if (headerfreepaid.includes(e.target) || headerfreepaidicon.includes(e.target)) {
        } else {
          for (let i = 0; i < headerLi.length; i++) {
            headerLi[i].children[1].classList.remove("headerliShow");
          }
        }
      } else {
        if (headerfreepaid.includes(e.target) || headerfreepaidicon.includes(e.target)) {
        } else {
          for (let i = 0; i < headerLi.length; i++) {
            headerLi[i].children[1].classList.remove("headerliShow");
          }
        }
        if (e.target.tagName == "H3" && e.target.nextElementSibling.classList.contains("inside")) {
          e.target.nextElementSibling.classList.toggle("headerliShow");
        }
      }
    } catch {}
  })
}

for (let i = 0; i < headerfreepaid.length; i++) {
  headerfreepaid[i].addEventListener("click", function (e) {
    headerfreepaid[i].nextElementSibling.classList.toggle("headerfreepaidShow");
  })
}

window.onclick = function (e) {
  closehead(e);
};

bars.onclick = () => {
  list.classList.toggle("show");
}

function closehead(e) {
  if (e.target.tagName == "H3" && e.target.nextElementSibling.classList.contains("inside")) {
    
  } else {
    if (headerfreepaid.includes(e.target) || headerfreepaidicon.includes(e.target)) {
    } else {
      for (let i = 0; i < headerLi.length; i++) {
        headerLi[i].children[1].classList.remove("headerliShow");
      }
    }
  }
  if (e.target != list && e.target != bars && !arrlist.includes(e.target)) {
    if (e.target.tagName == "H6") {} else {
      list.classList.remove("show");
    }
  }
}
