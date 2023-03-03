@extends('../layout/' . $layout)

@section('subhead')
    <title>Tabulator - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Todo List</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#todo-modal" class="btn btn-primary shadow-md mr-2">Add New List</a>
        </div>
    </div>
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">

        <div class="overflow-x-auto scrollbar-hidden">
            <div id="todo-tabulator" class="mt-5 table-report table-report--tabulator"></div>
        </div>
    </div>
    <!-- END: HTML Table Data -->
    @include('todos/_modal')
    @include('todos/_modal-task')

@endsection
