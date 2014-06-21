<!-- Modal -->
<div class="modal fade" id="deleteCube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Cube</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete <strong><span id="deleteCubeName"></span></strong> and all of its data?</p>
            </div>
            <div class="modal-footer">
                <form role="form" action="gateway.php" method="post">
                    <input type="hidden" id="deleteCubeId" name="deleteCubeId" value="0">
                    <input type="hidden" name="do" value="cube_delete">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Cube</button>
                </form>
            </div>
        </div>
    </div>
</div>