document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.querySelector('.addButton');
    const formContainer = document.querySelector('.form-container');

    function showForm() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    addButton.addEventListener('click', showForm);
    // Add event listener to the close button
    var closeBtn = document.getElementsByClassName("close")[0];
    closeBtn.addEventListener("click", function () {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    });

});

function confirmSuppression() {
    return confirm("Voulez vous vraiment supprimer?");
}

function toggleForm(id) {
    var form = document.getElementById("stateForm");
    var hiddenId = document.getElementById("ticketId");
    hiddenId.value = id;
    form.style.display = (form.style.display === "none") ? "block" : "none";
}

function toggleFormAssign(id){
    var form = document.getElementById("assignerTicket");
    var hiddenId = document.getElementById("ticketIdAssign");

    hiddenId.value = id;
    form.style.display = (form.style.display === "none") ? "block" : "none";
}

function closeForm() {
    document.getElementById("stateForm").style.display = "none";
    document.getElementById("assignerTicket").style.display = "none";
}