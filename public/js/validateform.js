function validateForm() {
    var absensi = document.getElementById("absensi").value;
    var foto = document.getElementById("foto").value;
    var notulensi = document.getElementById("notulensi").value;

    if (absensi == "" && foto == "" && notulensi == "") {
        demo.showSwal('alert')
        return false;
    } else {
        return true
    }
}
