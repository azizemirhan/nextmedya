{{-- Add Task Modal --}}
<div class="modal fade" id="addTaskModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="s-task-list-id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="task-title mb-4 d-flex">
                            <input id="s-task-title" type="text" placeholder="Task Title" class="form-control" name="task">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-bs-dismiss="modal">Discard</button>
                <button class="btn add-tsk btn-primary">Add Task</button>
            </div>
        </div>
    </div>
</div>

{{-- Add List Modal --}}
<div class="modal fade" id="addListModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-title d-flex">
                            <input id="s-list-name" type="text" placeholder="List Name" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-bs-dismiss="modal">Discard</button>
                <button class="btn add-list btn-primary">Add List</button>
            </div>
        </div>
    </div>
</div>

{{-- Task Detail Modal --}}
<div class="modal fade" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskDetailModalLabel">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="taskDetailModalBody">
                {{-- Detaylar JavaScript ile buraya yüklenecek --}}
                <div class="d-flex justify-content-center my-5">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
