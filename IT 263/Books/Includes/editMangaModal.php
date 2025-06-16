<div class="modal fade" id="editMangaModal<?php echo $manga_id ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark rounded p-3 text-white">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalToggleLabel">Edit Manga</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editMangaForm<?php echo $manga_id ?>" method="post" action="PHP/editLibrary.php">
                    <input type="hidden" name="mangaId" value="<?php echo $row["manga_id"] ?>">
                    <div class="mb-3">
                        <label for="mangaTitle" class="form-label">Manga Title:</label>
                        <input required type="text" class="form-control" name="mangaTitle" placeholder="Example: Bocchi the Rock!" value="<?php echo $row["manga_title"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mangaAuthor" class="form-label">Manga Author:</label>
                        <input required type="text" class="form-control" name="mangaAuthor" placeholder="Example: Hamaji Aki" value="<?php echo $row["manga_author"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mangaYear" class="form-label">Year of Serialization:</label>
                        <input required type="number" class="form-control" name="mangaYear" placeholder="Example: 2018" min="1" value="<?php echo $row["manga_year"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mangaGenre" class="form-label">Manga Genre:</label>
                        <input required type="text" class="form-control" name="mangaGenre" placeholder="Example: Slice of Life" value="<?php echo $row["manga_genre"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mangaPublication" class="form-label">Status of Publication:</label>
                        <select class="form-select" name="mangaPublication">
                            <option value="Ongoing" <?php echo ($row["manga_publication"] == 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                            <option value="Completed" <?php echo ($row["manga_publication"] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mangaReading" class="form-label">Reading Status:</label>
                        <select class="form-select" name="mangaReading">
                            <option value="Unread" <?php echo ($row["manga_reading"] == 'Unread') ? 'selected' : ''; ?>>Unread</option>
                            <option value="Unfinished" <?php echo ($row["manga_reading"] == 'Unfinished') ? 'selected' : ''; ?>>Unfinished</option>
                            <option value="Finished" <?php echo ($row["manga_reading"] == 'Finished') ? 'selected' : ''; ?>>Finished</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer d-flex align-items-middle justify-content-center">
                <button type="submit" form="editMangaForm<?php echo $manga_id ?>" class="btn btn-secondary btn-lg" value="edit-manga">Confirm Edit</button>
            </div>
        </div>
    </div>
</div>