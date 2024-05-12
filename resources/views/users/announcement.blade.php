@extends('app')
<div class="container py-5">
    <div>
        <div class="w-100 d-flex justify-content-between">
          <button id="btn_create" class="btn btn-primary mb-3 w-25">Create</button>
          <a href="/signout">Signout</a>
        </div>
        
        <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Contents</th>
                    <th class="text-center">StartDate</th>
                    <th class="text-center">EndDate</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($announcements as $item)
                  <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="text-center">{{ $item->title }}</td>
                    <td class="text-center">{{ $item->content }}</td>
                    <td class="text-center">{{ $item->startDate }}</td>
                    <td class="text-center">{{ $item->endDate }}</td>
                    <td class="text-center">{{ $item->active ? 'Active' : 'Inactive' }}</td>
                    <td class="text-center text-primary">{{ $item->created_at }}</td>
                    <td class="d-flex gap-2">
                      <button id="btn_edit" data-id="{{ $item->id }}" class="btn btn-sm btn-secondary">Edit</button>
                      <button id="btn_remove" data-id="{{ $item->id }}" class="btn btn-sm btn-danger">Remove</button>
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--  Add Announcement -->
<div class="modal fade modal-md" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content pb-2">
          <div class="modal-header bg-primary">
            <h6 class="text-white">Create Announcement</h6>
            <button id="btn_close" class="close btn w-25 text-white" type="button">
              <h4>&times;</h4>
            </button>
          </div>
          <div class="modal-body pt-4">
             <form class="px-2 d-flex flex-column gap-3">
                <input id="title" type="text" placeholder="Title" class="form-control">
                <div>
                  <small>Start Date</small>
                  <input id="start_date" type="date" class="form-control mt-1">
                </div>
                <div>
                  <small>End Date</small>
                  <input id="end_date" type="date" class="form-control mt-1">
                </div>
                <textarea  id="content" rows="5" class="form-control" placeholder="Content"></textarea>
                <button id="btn_create_announcement" class="btn btn-block btn-primary mt-2">Submit</button>
             </form>
          </div>
      </div>
  </div>
</div>

<!--  Update Announcement -->
<div class="modal fade modal-md" id="update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content pb-2">
          <div class="modal-header bg-primary">
            <h6 class="text-white">Edit Announcement</h6>
            <button id="btn_close" class="close btn w-25 text-white" type="button">
              <h4>&times;</h4>
            </button>
          </div>
          <div class="modal-body pt-4">
             <form class="px-2 d-flex flex-column gap-3">
                <input id="edit_title" type="text" placeholder="Title" class="form-control">
                <div>
                  <small>Start Date</small>
                  <input id="edit_startDate" type="date" class="form-control mt-1">
                </div>
                <div>
                  <small>End Date</small>
                  <input id="edit_endDate" type="date" class="form-control mt-1">
                </div>
                <textarea  id="edit_content" rows="5" class="form-control" placeholder="Content"></textarea>
                <button id="btn_update_announcement" class="btn btn-block btn-primary mt-2">Update</button>
             </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade modal-sm" id="remove" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content pb-2">
          <div class="modal-header bg-primary">
            <h6 class="text-white">Remove Announcement</h6>
            <button id="btn_close" class="close btn w-25 text-white" type="button">
              <h4>&times;</h4>
            </button>
          </div>
          <div class="modal-body pt-4">
             <h6>Are you sure you want to remove this record?</h6>
          </div>
          <div class="modal-footer">
             <button id="btn_confirm_delete" class="btn btn-primary btn-sm">Yes</button>
             <button id="btn_cancel" class="btn btn-danger btn-sm">Cancel</button>
          </div>
      </div>
  </div>
</div>