let imgs = Array.from(document.querySelectorAll(".container img")),
  slidecount = imgs.length;
currentActive = 1;
(prev = document.getElementById("Prev")),
  (next = document.getElementById("next")),
  (counter = document.getElementById("counter")),
  (ul = document.createElement("ul"));
ul.setAttribute("id", "theUl");

for (let i = 1; i <= slidecount; i++) {
  li = document.createElement("li");
  li.setAttribute("data-index", i);
  li.textContent = i;
  ul.appendChild(li);
}
document.getElementById("bulits").appendChild(ul);

let boll = Array.from(document.getElementsByTagName("li"));
for (let i = 0; i < boll.length; i++) {
  boll[i].onclick = function () {
    currentActive = this.getAttribute("data-index");
    theCheeker();
  };
}
theCheeker();
prev.onclick = prevele;
next.onclick = nextele;

function prevele() {
  if (prev.classList.contains("disabled")) {
    return false;
  } else {
    currentActive--;
    theCheeker();
  }
}
function nextele() {
  if (next.classList.contains("disabled")) {
    return false;
  } else {
    currentActive++;
    theCheeker();
  }
}
function theCheeker() {
  counter.textContent = "slide " + currentActive + " of the " + slidecount;
  removeActive();
  imgs[currentActive - 1].classList.add("active");
  ul.children[currentActive - 1].classList.add("active");
}
function removeActive() {
  imgs.forEach(function (img) {
    img.classList.remove("active");
  });
  let boll = Array.from(document.getElementsByTagName("li"));
  boll.forEach(function (li) {
    li.classList.remove("active");
  });
  if (currentActive == 1) {
    prev.classList.add("disabled");
  } else {
    prev.classList.remove("disabled");
  }
  if (currentActive == slidecount) {
    next.classList.add("disabled");
  } else {
    next.classList.remove("disabled");
  }
}
