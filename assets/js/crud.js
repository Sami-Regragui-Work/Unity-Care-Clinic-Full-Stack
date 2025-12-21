import "/node_modules/jquery/dist/jquery.min.js";

function reRunCrud() {
    const contentArticle = $("#dynamic-content");
    const modalArticle = $("#hidden-modal");
    const form = modalArticle.find("form");
    const tableName = form.data("table");

    function closeModal() {
        modalArticle.removeClass("flex");
        modalArticle.addClass("hidden");
        $("body").removeClass("body--no-scroll");
    }

    function addSubmit(e) {
        e.preventDefault();

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
    }

    contentArticle.on("click", "[data-role='table-add']", openModal);
    modalArticle.on("submit", addSubmit);
}

reRunCrud();

export { reRunCrud };
