import "/node_modules/jquery/dist/jquery.min.js";

function reRunCrud() {
    const contentArticle = $("#dynamic-content");
    const modalArticle = $("#hidden-modal");
    const form = modalArticle.find("form");
    const tableName = form.data("table");
    const searchInput = $("#search");

    function closeModal() {
        modalArticle.removeClass("flex");
        modalArticle.addClass("hidden");
        $("body").removeClass("body--no-scroll");
        form[0].reset();
        searchInput.removeAttr("disabled");
    }

    function addSubmit(e) {
        e.preventDefault();
        console.log("submit");
        const formContent =
            form.serialize() + `&table=${encodeURIComponent(tableName)}`;

        $.ajax({
            url: "assets/php/action/addRow.php",
            method: "POST",
            dataType: "json",
            data: formContent,
            success(res) {
                closeModal();

                const $table = contentArticle.find("table");
                const $tbody = $table.find("tbody");
                $tbody.append(res.row);
            },
            error: (xhr, stat, err) => {
                console.error(
                    "couldn't add the row",
                    xhr.responseText || err || stat
                );
            },
        });
    }

    function openModal() {
        console.log("modal is open");
        modalArticle.removeClass("hidden");
        modalArticle.addClass("flex");
        $("body").addClass("body--no-scroll");
        searchInput.prop("disabled", true);
    }

    contentArticle.on("click", "[data-role='table-add']", openModal);
    form.on("submit", addSubmit);
    modalArticle.on("click", "[data-add-cancel]", closeModal);
}

// reRunCrud();

export { reRunCrud };
