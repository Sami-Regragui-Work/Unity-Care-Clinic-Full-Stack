import { reRunCrud } from "./crud.js";
import "/node_modules/jquery/dist/jquery.min.js";

const sidebar = $("#sidebar");
const contentArticle = $("#dynamic-content");
const modalArticle = $("#hidden-modal");

const sections = {
    dashboard: {
        url: "assets/php/dashboard.php",
        hasTable: false,
    },
    patients: {
        url: "assets/php/dynamicTable.php",
        hasTable: true,
    },
    doctors: {
        url: "assets/php/dynamicTable.php",
        hasTable: true,
    },
    departments: {
        url: "assets/php/dynamicTable.php",
        hasTable: true,
    },
};

function loadSection(sectionName) {
    const sectionObj = sections[sectionName] || sections.dashboard;

    const content = {}; // dataObj for ajax
    if (sectionObj.hasTable) content.tableName = sectionName;

    $.ajax({
        url: sectionObj.url,
        method: "GET",
        dataType: "json",
        data: content,
        success: (res) => {
            contentArticle.html(res.content);
            res.modal ? modalArticle.html(res.modal) : modalArticle.empty();

            const url = new URL(window.location.href);
            url.searchParams.set("section", sectionName);
            window.history.pushState({}, "", url.toString());

            reRunCrud();
        },
        error: (xhr, _, err) => {
            //xhr, status, error
            console.error("couldn't load section", xhr.responseText || err);
        },
    });
}

function navigate(e) {
    e.preventDefault();
    const anchor = $(this);
    const sectionName = anchor.data("section");
    if (sectionName) loadSection(sectionName);
}

function sidebarStart() {
    sidebar.on("click", "a[data-section]", navigate);
    const params = new URLSearchParams(window.location.search);
    loadSection(params.get("section") || "dashboard");
}

sidebarStart();
