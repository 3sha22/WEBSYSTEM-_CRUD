document.addEventListener("click", function (e) {

    if (e.target.classList.contains("delete-btn")) {

        const row = e.target.closest("tr");

        if (confirm("Are you sure you want to delete this member?")) {
            row.remove();
        }

    }

});