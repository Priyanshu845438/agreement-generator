document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
        const inputs = form.querySelectorAll("input[required]");
        let valid = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                valid = false;
                input.style.border = "2px solid red";
            } else {
                input.style.border = "1px solid #ccc";
            }
        });

        if (!valid) {
            event.preventDefault();
            alert("Please fill in all required fields.");
        }
    });

    // Table Sorting
    document.querySelectorAll("th").forEach(header => {
        header.addEventListener("click", function () {
            const table = header.closest("table");
            const index = Array.from(header.parentNode.children).indexOf(header);
            const rows = Array.from(table.querySelectorAll("tr:nth-child(n+2)"));

            const sortedRows = rows.sort((rowA, rowB) => {
                const cellA = rowA.children[index].innerText.toLowerCase();
                const cellB = rowB.children[index].innerText.toLowerCase();
                return cellA.localeCompare(cellB);
            });

            table.tBodies[0].append(...sortedRows);
        });
    });
});
