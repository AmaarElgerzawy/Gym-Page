let filters , items,
  button_up = document.getElementById("button-up"),
  button_cat = document.getElementById("button-cat"),
  form_up = document.getElementById("form-up"),
  form_cat = document.getElementById("form-cat");

window.onload = () => {
  try {
    form_cat.style.display = "none";
    form_up.style.display = "none";
  } catch {}
  filters = Array.from(document.querySelectorAll("#tables"));
  items = Array.from(document.querySelectorAll(".item"));
  filters.forEach(filter => {
    filter.onclick = () => {
      items.forEach(item => {
        if ((filter.innerHTML).trim() == "Show ALL") {
          item.style.display = "inline-block";
        } else if (item.classList.contains(filter.innerHTML.trim())) {
          item.style.display = "inline-block";
        } else {
          item.style.display = "none";
        }
      })
  }
  });
}
try {
  button_up.onclick = function (e) {
    e.preventDefault();
    form_up.style.display = "inline-block";
    form_cat.style.display = "none";
  }
  button_cat.onclick = function (e) {
    e.preventDefault();
    form_cat.style.display = "inline-block";
    form_up.style.display = "none";
  };
} catch {}