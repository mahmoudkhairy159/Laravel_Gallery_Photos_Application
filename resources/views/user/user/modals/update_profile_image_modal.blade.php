<div class="modal fade" id="updateProfileImageModal" tabindex="-1"
aria-labelledby="updateProfileImageModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateProfileImageModalLabel">Update Profile Image</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <form id="updateProfileImageForm" action="{{ route('user.updateProfileImage') }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-body">
                <div class="mb-3">
                    <label for="image" class="form-label">Select Image</label>
                    <input type="file" class="form-control" id="image" name="image"
                        accept=".jpeg,.png,.jpg,.gif,.svg" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Image</button>
            </div>
        </form>
    </div>
</div>
</div>
