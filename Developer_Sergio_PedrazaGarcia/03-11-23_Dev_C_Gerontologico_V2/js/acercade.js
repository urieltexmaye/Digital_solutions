const boton1 = document.getElementById("boton1");
const boton2 = document.getElementById("boton2");
const info1 = document.getElementById("info1");
const info2 = document.getElementById("info2");

boton1.addEventListener("click", function() {
  info1.style.display = "block";
  info2.style.display = "none";
});

boton2.addEventListener("click", function() {
  info1.style.display = "none";
  info2.style.display = "block";
});
