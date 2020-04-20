<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirmLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmLabel">Удаление категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{!! $modaltext !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <form action="" method="post" id="modal-form">
                    <button type="submit" class="btn btn-primary" id="confirm-btn" value="Delete">Удалить</button>
                    <input type="hidden" name="_method" value="delete"/>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>
