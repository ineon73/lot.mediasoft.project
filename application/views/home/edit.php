<div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="update" method="post" action="<?= site_url("Main/update/{$item->id}") ?>"
                      enctype="multipart/form-data">
                    <label><input type="file" name="userfile" size="20"/></label><br>
                    <label>Название:<input value="<?php echo $item->name; ?>" type="text" name="name"
                                           class="form-control"
                                           required></label><br>
                    <label>Описание:<textarea value="<?php echo $item->text; ?>" class="form-control"
                                              name="text"></textarea></label><br>
                    <label>Шаг ставки:<input type="number" name="step" class="form-control"
                                             value="10"
                                             pattern="[1-9]+" required></label><br>
                </form>
            </div>
            <div class="modal-footer">
                <form action="<?= site_url("Main") ?>">
                    <button class="btn btn-secondary" type="submit">Отменить</button>
                </form>
                <input type="submit" form="update" class="btn btn-primary" value="Отправить">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create" method="post" action="<?= site_url('Main/create') ?>"
                      enctype="multipart/form-data">
                    <label><input type="file" name="userfile" size="20"/></label><br>
                    <label>Название:<input type="text" name="name" class="form-control"
                                           required></label><br>
                    <label>Описание:<textarea class="form-control" name="text"></textarea></label><br>
                    <label>Цена:<input type="number" name="price" class="form-control" value="0"
                                       required></label><br>
                    <label>Шаг ставки:<input type="number" name="step" class="form-control"
                                             value="10"
                                             pattern="[1-9]+" required></label><br>
                    <label><input type="date" name="end_time"></label>
                    <label><input type="time" name="end_time2"></label><br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <input type="submit" form="create" class="btn btn-primary" value="Отправить">
            </div>
        </div>
    </div>
</div>
