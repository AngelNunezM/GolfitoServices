// Close alert message when the close button is clicked
document.getElementById("close-alert")?.addEventListener("click", function() {
    document.getElementById("alert-message").remove();
});