let x = document.cookie.split(";")
document.getElementById("final").addEventListener("click", function (e) {
  for (let i = 0; i < x.length; i++) {
    if (x[i].split("=")[0] == "activecode") {
      thediv = document.createElement("div");
      txt = document.createTextNode("done");
      thediv.append(txt);
      thediv.className = "thediv";
      document.body.append(thediv);
      shadow.classList.toggle("block");
      setTimeout(function () {
        shadow.classList.toggle("block");
      }, 3000);
    }
  }
});

