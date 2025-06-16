<div class="modal fade" id="deleteManga<?php echo $manga_id ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark rounded p-3 text-white">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalToggleLabel">Delete Manga from Library</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-wrap">
                <h5>Are you sure you want to delete <?php echo $manga["title"]?> from your library?</h5>
            </div>
            <div class="modal-footer d-flex align-items-middle justify-content-center">
                <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='PHP/delete.php?manga-id=<?php echo $manga_id ?>'">Delete</button>
            </div>
        </div>
    </div>
</div>