function openAddTherapistPopup() {
    var popup = document.getElementById("add-new-therapist");
    initialSelections.style.display = "none";
    popup.style.display = "block";
}

function openSearchPopup() {
    // var popup = window.location.href = "search_therapist_handler.php";
    var popup = document.getElementById("search-therapist");
    initialSelections.style.display = "none";
    popup.style.display = "block";
}