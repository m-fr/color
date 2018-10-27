function load(name) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("content").innerHTML = this.responseText;
        }
    };
    xhr.open("POST", "/content.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("c=" + name);
}
function show() {
    document.getElementById("sidenav").style.display = "block";
}
function hide() {
    document.getElementById("sidenav").style.display = "none";
}