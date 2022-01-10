let today = new Date();
let dd = String(today.getDate()).padStart(2, "0");
let mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
let yyyy = today.getFullYear();

today = dd + "/" + mm + "/" + yyyy;
let text = "Xin chào, hôm nay là ngày " + today;

const change = () => {
  document.getElementById("input").value = text;
};
