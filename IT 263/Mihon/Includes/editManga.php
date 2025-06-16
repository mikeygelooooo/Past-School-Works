<div class="modal fade" id="editManga<?php echo $manga_id ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark rounded p-3 text-white">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalToggleLabel">Edit Manga</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editMangaForm<?php echo $manga_id ?>" method="post" action="PHP/edit.php">
                    <input type="hidden" name="edit-id" value="<?php echo $manga["id"] ?>">
                    <div class="mb-3">
                        <label for="edit-title" class="form-label">Manga Title:</label>
                        <input required type="text" class="form-control" name="edit-title" placeholder="Example: Attack on Titan!" value="<?php echo $manga["title"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-author" class="form-label">Manga Author:</label>
                        <input required type="text" class="form-control" name="edit-author" placeholder="Example: Isayama Hajime"
                        value="<?php echo $manga["author"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-genre" class="form-label">Manga Genre:</label>
                        <input required type="text" class="form-control" name="edit-genre" placeholder="Example: Action" value="<?php echo $manga["genre"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-serialization" class="form-label">Status of Serialization:</label>
                        <select class="form-select" name="edit-serialization">
                            <option value="Ongoing" <?php echo ($manga["serialization"] == 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                            <option value="Completed" <?php echo ($manga["serialization"] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-reading" class="form-label">Reading Status:</label>
                        <select class="form-select" name="edit-reading">
                            <option value="Unread" <?php echo ($manga["reading"] == 'Unread') ? 'selected' : ''; ?>>Unread</option>
                            <option value="Unfinished" <?php echo ($manga["reading"] == 'Unfinished') ? 'selected' : ''; ?>>Unfinished</option>
                            <option value="Finished" <?php echo ($manga["reading"] == 'Finished') ? 'selected' : ''; ?>>Finished</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-rating" class="form-label">Manga Rating:</label>
                        <input required type="number" class="form-control" name="edit-rating" placeholder="Rate from 1 to 10" min="1" max="10" value="<?php echo $manga["rating"]?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex align-items-middle justify-content-center">
                <button type="submit" form="editMangaForm<?php echo $manga_id ?>" class="btn btn-secondary btn-lg" value="edit-manga">Confirm Edit</button>
            </div>
        </div>
    </div>
</div>