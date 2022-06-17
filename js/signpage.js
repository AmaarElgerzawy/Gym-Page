let sign = document.getElementById("sign"),
  username = document.getElementById("username");
  email = document.getElementById("email"),
  pass = document.getElementById("passs"),
  repass = document.getElementById("repasss")
shadow = document.getElementsByClassName("shad")[0];


sign.addEventListener("click", function (e) {
  if (username.value == "" || username.value == "") {
    e.preventDefault();
    thediv = document.createElement("div");
    txt = document.createTextNode("Please Enter A valied User Name");
    thediv.append(txt);
    thediv.className = "thediv";
    document.body.append(thediv);
    shadow.classList.toggle("block");
    setTimeout(function () {
      thediv.style.display = "none";
      shadow.classList.toggle("block");
    }, 3000);
  } else {
    if (email.value == "" || email.value == " ") {
      e.preventDefault();
      thediv = document.createElement("div");
      txt = document.createTextNode("Please Enter A Valied Email");
      thediv.append(txt);
      thediv.className = "thediv";
      document.body.append(thediv);
      shadow.classList.toggle("block");
      setTimeout(function () {
        thediv.style.display = "none";
        shadow.classList.toggle("block"); 
      }, 3000);
    } else {
      if (pass.value !="" && repass.value !=" " && pass.value == repass.value) {
        thediv = document.createElement("div");
        txt = document.createTextNode("We Have Send The Active Code TO Your Email");
        thediv.append(txt);
        thediv.className = "thediv";
        document.body.append(thediv);
        shadow.classList.toggle("block");
      } else {
        e.preventDefault();
        thediv = document.createElement("div");
        txt = document.createTextNode("The Password Dose Not Match please tryagain");
        thediv.append(txt);
        thediv.className = "thediv";
        document.body.append(thediv);
        shadow.classList.toggle("block");
        setTimeout(function () {
          thediv.style.display = "none";
          shadow.classList.toggle("block");
        }, 3000);
      } 
    }
  }
})

window.onclick = function () {
  try {
    used = document.getElementById("used");
    used.style.display = "none"
  } catch {}
}




