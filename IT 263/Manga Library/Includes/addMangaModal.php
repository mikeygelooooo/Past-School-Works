<div class="modal fade" id="addMangaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark rounded p-3 text-white">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalToggleLabel">Add Manga to Library</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addMangaForm" method="post" action="PHP/addToLibrary.php">
                    <div class="mb-3">
                        <label for="mangaTitle" class="form-label">Manga Title:</label>
                        <input required type="text" class="form-control" name="mangaTitle" placeholder="Example: Bocchi the Rock!">
                    </div>
                    <div class="mb-3">
                        <label for="mangaAuthor" class="form-label">Manga Author:</label>
                        <input required type="text" class="form-control" name="mangaAuthor" placeholder="Example: Hamaji Aki">
                    </div>
                    <div class="mb-3">
                        <label for="mangaYear" class="form-label">Year of Serialization:</label>
                        <input required type="number" class="form-control" name="mangaYear" placeholder="Example: 2018" min="1">
                    </div>
                    <div class="mb-3">
                        <label for="mangaGenre" class="form-label">Manga Genre:</label>
                        <input required type="text" class="form-control" name="mangaGenre" placeholder="Example: Slice of Life">
                    </div>
                    <div class="mb-3">
                        <label for="mangaPublication" class="form-label">Status of Publication:</label>
                        <select class="form-select" name="mangaPublication">
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mangaReading" class="form-label">Reading Status:</label>
                        <select class="form-select" name="mangaReading">
                            <option value="Unread">Unread</option>
                            <option value="Unfinished">Unfinished</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex align-items-middle justify-content-center">
                <button type="submit" form="addMangaForm" class="btn btn-secondary btn-lg" value="add-manga">Add to Library</button>
            </div>
        </div>
    </div>
</div>