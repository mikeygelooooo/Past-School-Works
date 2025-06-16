<div class="modal fade" id="addManga" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark rounded p-3 text-white">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalToggleLabel">Add Manga to Library</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addMangaForm" method="post" action="PHP/add.php">
                    <div class="mb-3">
                        <label for="add-title" class="form-label">Manga Title:</label>
                        <input required type="text" class="form-control" name="add-title" placeholder="Example: Attack on Titan!">
                    </div>
                    <div class="mb-3">
                        <label for="add-author" class="form-label">Manga Author:</label>
                        <input required type="text" class="form-control" name="add-author" placeholder="Example: Isayama Hajime">
                    </div>
                    <div class="mb-3">
                        <label for="add-genre" class="form-label">Manga Genre:</label>
                        <input required type="text" class="form-control" name="add-genre" placeholder="Example: Action">
                    </div>
                    <div class="mb-3">
                        <label for="add-serialization" class="form-label">Status of Serialization:</label>
                        <select class="form-select" name="add-serialization">
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-reading" class="form-label">Reading Status:</label>
                        <select class="form-select" name="add-reading">
                            <option value="Unread">Unread</option>
                            <option value="Unfinished">Unfinished</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-rating" class="form-label">Manga Rating:</label>
                        <input required type="number" class="form-control" name="add-rating" placeholder="Rate from 1 to 10" min="1" max="10">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex align-items-middle justify-content-center">
                <button type="submit" form="addMangaForm" class="btn btn-secondary btn-lg" value="add-manga">Add to Library</button>
            </div>
        </div>
    </div>
</div>