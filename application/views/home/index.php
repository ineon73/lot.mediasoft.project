<div class="row">
    <div class="col-md-2">
        <form method="post" action="<?= site_url('Main/index') ?>">
            <ul class="list-group">
                <li class="list-group-item"><label> <input type="radio" name="filter1" value="1" <?= $check1; ?>>
                        Активные</label></li>
                <li class="list-group-item"><label><input type="radio" name="filter1" value="2" <?= $check2; ?>>
                        Завершенные</label></li>
                <input type="hidden" name="text3" value="0">
                <li class="list-group-item"><label><input type="checkbox" name="filter2"
                                                          value="<?= $_SESSION['id']; ?>" <?= $check; ?>> Свои
                        лоты</label>
                </li>
                <button type="submit" class="btn btn-primary">Обновить</button>
                <p class="text-center alert alert-info"> Ваш логин: <b> <?php echo $login; ?></b>
                    <a class="btn btn-info btn-sm" href="<?= site_url('auth/logout') ?>"> ВЫЙТИ</a>
                </p>
            </ul>
        </form>
    </div>
    <div class="col-md-10">
        <?php foreach ($result as $row) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="col-md-12">
                                <img class="img-fluid d-block mx-auto" width="200px" height="200px"
                                     src="<?php
                                     if (empty($row->image)) {
                                         echo base_url('upload/empty.png');
                                     } else {
                                         echo base_url('upload/'), $row->image;
                                     } ?>" alt="">
                            </div>
                            <div class="col-md-12">
                                <p class=" text-center"><?= ($row->status == 1) ? "Активен" : "Завершен" ?></p>
                                <div>
                                    <?php if ($row->status == 1 && $row->user_id == $_SESSION['id']) {
                                        echo "<a href =" . site_url('Main/edit/') . $row->id . " class=\"btn btn-primary \" role=\"button\" aria-disabled=\"true\"> EDIT</a>",
                                            " <a href = " . site_url('Main/end/') . $row->id . " class=\"btn btn-primary \" role=\"button\" aria-disabled=\"true\" > END</a >";
                                    } ?>
                                </div>
                                <div>
                                    <?php if ($row->status == 1 && $row->user_id !== $_SESSION['id']) {
                                        echo "<a href =" . site_url('Main/bet/') . $row->id . " class=\"btn btn-primary \" role=\"button\" aria-disabled=\"true\"> BET</a>";
                                    } ?>
                                </div>
                                <div>
                                    <p class="text-center">
                                        <?php if ($row->status == 2) { ?>
                                    <p>Победитель: </p>
                                    <?= $row->win_id;
                                    } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="list-group-item text-center">Название: <b> <?= $row->name; ?> </b>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="list-group-item">Описание: <?= $row->text; ?> </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="list-group-item">Текущая цена: <?= $row->price; ?> </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="list-group-item">Шаг ставки: <?= $row->step; ?>  </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="list-group-item text-center">Время
                                        окончания: <?= $row->end_time; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <hr style="background-color:#007bff; height: 2px">
            </div>
        <?php } ?>
        <p class="text-center"><?= $links; ?></p>
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