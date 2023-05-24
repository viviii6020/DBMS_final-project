function check() {
    var message = "\nEnter \"participate\" to confirm!";
    var default_1 = "After confirming, you cant regret anymore";
    var result = prompt(message, default_1);
    if (result != "participate") {
        alert("Cancel to participate!");
        return false;
    }
}