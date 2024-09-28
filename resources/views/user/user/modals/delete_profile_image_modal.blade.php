<div class="modal fade" id="deleteProfileImageModal" tabindex="-1"
aria-labelledby="deleteProfileImageModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteProfileImageModalLabel">Delete Profile Image ?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <form id="deleteProfileImageForm" action="{{ route('user.deleteProfileImage') }}"
            method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-body">
                <p>This action cannot be undone.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete Image</button>
            </div>
        </form>
    </div>
</div>
</div>
