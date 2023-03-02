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
                <div id="modalDimissal" class="px-5 pb-8 text-center">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal Content -->

@section('script')
    <script type="module">

        const gobalSuccessModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#gobalSuccessModal"));
        const todoModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#todo-modal"));
        (function () {
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
                        $('#gobalSuccessModal .successModalTitle').html('Ok!');
                        $('#gobalSuccessModal .successModalDesc').html('Data Saved Successfully.');
                    });
                }).catch(err => {
                    $('#todo-form').find('.login__input').removeClass('border-danger')
                    $('#todo-form').find('.login__input-error').html('')
                    $('#btn-submit').html('Save')
                    if (err.response.data.message != 'Data could not saved.') {
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
        })()
    </script>
@endsection