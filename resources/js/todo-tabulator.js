import xlsx from "xlsx";
import { createIcons, icons } from "lucide";
import Tabulator from "tabulator-tables";

(function () {
    "use strict";
    //constant adding
    const gobalSuccessModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#gobalSuccessModal"));
    const todoModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#todo-modal"));
    const todoEditModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#todo-edit-modal"));
    const deleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#deleteModalPreview"));

    const taskViewModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#task-modal"));
    const taskAddModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#task-add-modal"));
    const taskEditModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#task-edit-modal"));
    const deleteTaskModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#deleteTaskModalPreview"));
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
                
                {
                    title: "Created Date",
                    minWidth: 200,
                    field: "created_at",
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
                                
                                $('#id').val(cell.getData().id);
                                $('#todo-edit-form #title').val(cell.getData().title);
                                todoEditModal.show()
                            });

                        $(a)
                            .find(".view")
                            .on("click", function () {

                                let taskList = cell.getData().tasks
                                
                                
                                let tableHtml ='';
                                for(let i=0,sl=1; i<taskList.length; i++,sl++) {
                                    tableHtml+=`<tr id="task`+taskList[i].id+`" data-taskId=`+taskList[i].id+`>
                                        <td class="whitespace-nowrap">`+sl+`</td>
                                        <td class="whitespace-nowrap"><span id="taskName`+taskList[i].id+`">`+taskList[i].name+`</span></td>
                                        <td class="whitespace-nowrap">`+taskList[i].created_at+`</td>
                                        <td class="whitespace-nowrap">
                                            <div class="flex lg:justify-center items-center">
                                                <a  class="edit-task flex items-center mr-3" href="javascript:;">
                                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit 
                                                </a>
                                                <a class="delete-task flex items-center text-danger" href="javascript:;">
                                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>`
                                }
                                
                                let myTaskTable = document.getElementById('taskTableList').getElementsByTagName('tbody')[0];
                                myTaskTable.innerHTML =tableHtml;
                                createIcons({
                                    icons,
                                    "stroke-width": 1.5,
                                    nameAttr: "data-lucide",
                                });
                                taskViewModal.show()
                                $('.delete-task').on('click', function(e) {

                                    let taskId = parseInt(e.target.parentNode.parentNode.parentNode.getAttribute('data-taskId'));
                                    document.getElementById('deletetaskId').value = taskId;
                                    taskViewModal.hide()
                                    deleteTaskModal.show()
                                })
                                $('.edit-task').on('click', function(e) {

                                    let taskId = parseInt(e.target.parentNode.parentNode.parentNode.getAttribute('data-taskId'));
                                    taskViewModal.hide()
                                    taskEditModal.show()
                                    document.getElementById('taskId').value = taskId
                                    let taskName = document.getElementById("taskName"+taskId).innerHTML
                                    $("#task-edit-form #name").val(taskName)
                                    document.getElementById("todoEditTitle").innerHTML = cell.getData().title

                                })
                        });

                        $(a)
                            .find(".add-task")
                            .on("click", function () {
                                taskAddModal.show()
                                $("#name").val('')
                                $('#todoId').val(cell.getData().id)
                                document.getElementById("todoTitle").innerHTML = cell.getData().title
                        });

                        $(a)
                            .find(".delete")
                            .on("click", function () {
                                 $('#deleteId').val(cell.getData().id)
                                deleteModal.show()
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
                    title: "Created Date",
                    field: "created_at",
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

    }
    //Todo Works
        async function addTodo() {

            // Reset state
            $('#todo-form').find('.login__input').removeClass('border-danger')
            $('#todo-form').find('.login__input-error').html('')

            // Post form
            let myform = document.getElementById("todo-form");
            let formData = new FormData(myform);
            
            // Loading state
            $('#btn-submit').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
            tailwind.svgLoader()
            await helper.delay(500)

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
                }, 1500);
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
                addTodo()
            }
        })

        $('#btn-submit').on('click', function() {
            addTodo()
        })

        
        //update Todo
        async function editTodo() {

            // Reset state
            $('#todo-edit-form').find('.login__input').removeClass('border-danger')
            $('#todo-edit-form').find('.login__input-error').html('')
            // Post form
            let myform = document.getElementById("todo-edit-form");
            let myEditId = document.getElementById("id").value;
            let formData = new FormData(myform);
            
            // Loading state
            $('#btn-update').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
            tailwind.svgLoader()
            await helper.delay(500)

            axios.post('todo/update/'+myEditId,formData).then(res => {
                $('#btn-update').html('Update')
                todoEditModal.hide();
                gobalSuccessModal.show();
                document.getElementById('gobalSuccessModal').addEventListener('shown.tw.modal', function(event){
                    $('#gobalSuccessModal .successModalTitle').html('Updated!');
                    $('#gobalSuccessModal .successModalDesc').html('Data Updated Successfully.');
                });
                setTimeout(function(){
                    gobalSuccessModal.hide();
                    window.location.reload();
                }, 1500);
            }).catch(err => {
                $('#todo-edit-form').find('.login__input').removeClass('border-danger')
                $('#todo-edit-form').find('.login__input-error').html('')
                $('#btn-update').html('Update')
                if (err.response.data.message != 'Data Updated') {
                    for (const [key, val] of Object.entries(err.response.data.errors)) {
                        $(`#${key}`).addClass('border-danger')
                        $(`#error-${key}`).html(val)
                    }
                } else {
                    $('#todo-edit-form #title').addClass('border-danger')
                    $('#error-title').html(err.response.data.message)
                }
            })
        }

        $('#todo-edit-form').on('keyup', function(e) {
            if (e.keyCode === 13) {
                editTodo()
            }
        })

        $('#btn-update').on('click', function() {
            editTodo()
        })

        //delete Todo
        async function deleteToDo() {

            // Post form
            let deleteId = document.getElementById("deleteId").value;
            
            // Loading state
            $('#delete-data').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
            tailwind.svgLoader()
            await helper.delay(500)

            axios.delete('todo/delete/'+deleteId).then(res => {
                $('#deleteId').val('');
                $('#delete-data').html('Delete');
                deleteModal.hide();
                gobalSuccessModal.show();
                document.getElementById('gobalSuccessModal').addEventListener('shown.tw.modal', function(event){
                    $('#gobalSuccessModal .successModalTitle').html('Deleted!');
                    $('#gobalSuccessModal .successModalDesc').html('');
                });
                setTimeout(function(){
                    gobalSuccessModal.hide();
                    window.location.reload();
                }, 1500);
            }).catch(err => {
                
                $('#delete-data').html('Delete')
                
            })
        }

        $('#delete-data').on('click', function() {
            deleteToDo()
        })
        //add Task
        async function addTask() {

            // Reset state
            $('#task-add-form').find('.login__input').removeClass('border-danger')
            $('#task-add-form').find('.login__input-error').html('')

            // Post form
            let myform = document.getElementById("task-add-form")
            let formData = new FormData(myform)
            
            // Loading state
            $('#btn-add-task').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
            tailwind.svgLoader()
            await helper.delay(500)

            axios.post('task/store',formData).then(res => {
                $('#name').val('')
                $('#btn-add-task').html('Save')
                taskAddModal.hide()
                gobalSuccessModal.show()
                document.getElementById('gobalSuccessModal').addEventListener('shown.tw.modal', function(event){
                    $('#gobalSuccessModal .successModalTitle').html('Saved!')
                    $('#gobalSuccessModal .successModalDesc').html('Data Saved Successfully.')
                });
                setTimeout(function(){
                    gobalSuccessModal.hide()
                    window.location.reload()
                }, 1500);
            }).catch(err => {
                $('#task-add-form').find('.login__input').removeClass('border-danger')
                $('#task-add-form').find('.login__input-error').html('')
                $('#btn-add-task').html('Save')
                if (err.response.data.message != 'Data saved') {
                    for (const [key, val] of Object.entries(err.response.data.errors)) {
                        $(`#${key}`).addClass('border-danger')
                        $(`#error-${key}`).html(val)
                    }
                } else {
                    $('#name').addClass('border-danger')
                    $('#error-name').html(err.response.data.message)
                }
            })
        }

        $('#task-add-form').on('keyup', function(e) {
            if (e.keyCode === 13) {
                addTask()
            }
        })

        $('#btn-add-task').on('click', function() {
            addTask()
        })        
        //delete Task
        async function deleteTask() {

            // Post form
            let deleteId = document.getElementById("deletetaskId").value;
            
            // Loading state
            $('#delete-task-data').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
            tailwind.svgLoader()
            await helper.delay(500)

            axios.delete('task/delete/'+deleteId).then(res => {
                $('#deletetaskId').val('');
                $('#delete-task-data').html('Delete');
                deleteTaskModal.hide();
                gobalSuccessModal.show();
                document.getElementById('gobalSuccessModal').addEventListener('shown.tw.modal', function(event){
                    $('#gobalSuccessModal .successModalTitle').html('Deleted!');
                    $('#gobalSuccessModal .successModalDesc').html('');
                });
                setTimeout(function(){
                    gobalSuccessModal.hide();
                    window.location.reload();
                }, 1500);
            }).catch(err => {
                
                $('#delete-task-data').html('Delete')
                
            })
        }

        $('#delete-task-data').on('click', function() {
            deleteTask()
        })
})();
