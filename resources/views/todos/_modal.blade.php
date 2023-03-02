<!-- BEGIN: Modal Content -->
<div id="todo-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Add New Todo</h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                
                <div class="col-span-12 sm:col-span-12">
                    <form id="todo-form">
                        <label for="title" class="form-label">Title</label>
                        <input id="title" name="title" type="text" class="form-control login__input" placeholder="I need a coffee break">
                        <div id="error-title" class="login__input-error text-danger mt-2"></div>
                    </form>
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                <button id="btn-submit" type="button" class="btn btn-primary w-20">Save</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>
<!-- END: Modal Content -->

<!-- BEGIN: Modal Content -->
<div id="gobalSuccessModal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="check-circle" class="w-16 h-16 text-success mx-auto mt-3"></i>
                    <div class="text-3xl mt-5 successModalTitle">Good job!</div>
                    <div class="text-slate-500 mt-2 successModalDesc">You clicked the button!</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal Content -->
<!-- BEGIN: Delete Modal Content -->
<div id="deleteModalPreview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <input type="hidden" id="deleteId" value="" />
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button id="delete-data" type="button" class="btn btn-danger w-24">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal Content -->

@section('script')
        @vite('resources/js/todo-tabulator.js')
@endsection