function realy() {
    var message = "\nEnter \"delete\" to confirm!";
    var default_1 = "Please Check";
    var result = prompt(message, default_1);
    if (result != "delete") {
        alert("Cancel to delete!");
        return false;
    }
}