import xlsx from "xlsx";
import { createIcons, icons } from "lucide";
import Tabulator from "tabulator-tables";

(function () {
    "use strict";
    //constant adding
    const gobalSuccessModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#gobalSuccessModal"));
    const todoModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#todo-modal"));
    const deleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#deleteModalPreview"));
    // Tabulator
    if ($("#todo-tabulator").length) {
        // Setup Tabulator
        let table = new Tabulator("#todo-tabulator", {
            ajaxURL: "todo/list",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    hozAlign: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "TODO NAME",
                    minWidth: 200,
                    responsive: 0,
                    field: "title",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div>
                            <div class="font-medium whitespace-nowrap">${
                                cell.getData().title
                            }</div>
                        </div>`;
                    },
                },
                ,
                {
                    title: "Description",
                    minWidth: 200,
                    field: "description",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "ACTIONS",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a =
                            $(`<div class="flex lg:justify-center items-center">
                            <a class="view flex items-center mr-3" href="javascript:;">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i> View Tasks
                            </a>
                            <a class="add-task flex items-center mr-3 text-success" href="javascript:;">
                                <i data-lucide="list-plus" class="w-4 h-4 mr-1"></i> Add Tasks
                            </a>
                            <a class="edit flex items-center mr-3" href="javascript:;">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit 
                            </a>
                            <a class="delete flex items-center text-danger" href="javascript:;">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                            </a>
                        </div>`);
                        $(a)
                            .find(".edit")
                            .on("click", function () {
                                alert("EDIT");
                            });

                        $(a)
                            .find(".view")
                            .on("click", function () {
                                alert("view");
                        });

                        $(a)
                            .find(".add-task")
                            .on("click", function () {
                                alert("add-task");
                        });

                        $(a)
                            .find(".delete")
                            .on("click", function () {
                                 $('#deleteId').val(cell.getData().id);
                                deleteModal.show();
                            });

                        return a[0];
                    },
                },

                // For print format
                {
                    title: "Title",
                    field: "title",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "Description",
                    field: "description",
                    visible: false,
                    print: true,
                    download: true,
                },
            ],
            renderComplete() {
                createIcons({
                    icons,
                    "stroke-width": 1.5,
                    nameAttr: "data-lucide",
                });
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = $("#todo-tabulator-html-filter-field").val();
            let type = $("#todo-tabulator-html-filter-type").val();
            let value = $("#todo-tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        $("#todo-tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        $("#todo-tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        $("#todo-tabulator-html-filter-reset").on("click", function (event) {
            $("#todo-tabulator-html-filter-field").val("name");
            $("#todo-tabulator-html-filter-type").val("like");
            $("#todo-tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Export
        $("#todo-tabulator-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        $("#todo-tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        $("#todo-tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        $("#todo-tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        $("#todo-tabulator-print").on("click", function (event) {
            table.print();
        });
    }
    //Todo Works
        async function register() {

            // Reset state
            $('#todo-form').find('.login__input').removeClass('border-danger')
            $('#todo-form').find('.login__input-error').html('')

            // Post form
            let myform = document.getElementById("todo-form");
            let formData = new FormData(myform);
            
            // Loading state
            $('#btn-submit').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
            tailwind.svgLoader()
            await helper.delay(1500)

            axios.post('todo/store',formData).then(res => {
                $('#title').val('');
                $('#btn-submit').html('Save')
                todoModal.hide();
                gobalSuccessModal.show();
                document.getElementById('gobalSuccessModal').addEventListener('shown.tw.modal', function(event){
                    $('#gobalSuccessModal .successModalTitle').html('Saved!');
                    $('#gobalSuccessModal .successModalDesc').html('Data Saved Successfully.');
                });
                setTimeout(function(){
                    gobalSuccessModal.hide();
                    window.location.reload();
                }, 2000);
            }).catch(err => {
                $('#todo-form').find('.login__input').removeClass('border-danger')
                $('#todo-form').find('.login__input-error').html('')
                $('#btn-submit').html('Save')
                if (err.response.data.message != 'Data saved') {
                    for (const [key, val] of Object.entries(err.response.data.errors)) {
                        $(`#${key}`).addClass('border-danger')
                        $(`#error-${key}`).html(val)
                    }
                } else {
                    $('#title').addClass('border-danger')
                    $('#error-title').html(err.response.data.message)
                }
            })
        }

        $('#todo-form').on('keyup', function(e) {
            if (e.keyCode === 13) {
                register()
            }
        })

        $('#btn-submit').on('click', function() {
            register()
        })
    
})();
