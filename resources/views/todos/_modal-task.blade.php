<!-- BEGIN: Modal Content -->
<div id="task-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Tasks</h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                
                <div class="col-span-12 sm:col-span-12 overflow-x-auto">
                    <table id="taskTableList" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">Name</th>
                                <th class="whitespace-nowrap">Created Time</th>
                                <th class="whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Close</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>
<!-- END: Modal Content -->

<!-- BEGIN: Add Task Modal Content -->
<div id="task-add-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Add New Task</h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                
                <div class="col-span-12 sm:col-span-12">
                    <div  class="text-base font-medium truncate mb-5">Todo: <span id="todoTitle"></span></div>
                    <form id="task-add-form">
                        <label for="name" class="form-label">Task</label>
                        <input id="name" name="name" type="text" class="form-control login__input" placeholder="This is my task for todo list">
                        <div id="error-name" class="login__input-error text-danger mt-2"></div>
                        <input type="hidden" name="todo_id" id="todoId" value="" />
                    </form>
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                <button id="btn-add-task" type="button" class="btn btn-primary w-20">Save</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>
<!-- END: Modal Content -->

<!-- BEGIN: Delete TaksModal Content -->
<div id="deleteTaskModalPreview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">Do you really want to delete this task? <br>This process cannot be undone.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <input type="hidden" id="deletetaskId" value="" />
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button id="delete-task-data" type="button" class="btn btn-danger w-24">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal Content -->