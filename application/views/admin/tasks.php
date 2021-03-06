<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">ЗАДАЧИ</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <?php if (empty($list)): ?>
                            <p>Список задач пуст</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th><a href="/admin/tasks/">ID</a></th>								
                                    <th>Имя <a href="/admin/tasks-nameasc/"><span class="fa fa-fw fa-search-plus"></span></a> <a href="/admin/tasks-name/"><i class="fa fa-fw fa-search-minus"></i></a> </th>
                                    <th>Email <a href="/admin/tasks-emailasc/"><span class="fa fa-fw fa-search-plus"></span></a> <a href="/admin/tasks-email/"><i class="fa fa-fw fa-search-minus"></i></a> </th>
                                    <th>Текст задачи</th>
                                    <th>Статус <a href="/admin/tasks-status/"><span class="fa fa-fw fa-search-plus"></span></a> <a href="/admin/tasks-statusasc/"><i class="fa fa-fw fa-search-minus"></i></a> </th>
                                    <th>Редактировать</th>
                                    <th>Удалить</th>
                                </tr>
                                <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td><?=$val['id'];?></td>									
                                        <td><?=$val['name'];?></td>
					<td><?=$val['email'];?></td>
					<td><?=$val['description'];?></td>
					<td><?php if ($val['status']>0) echo 'выполнено<br>'; if ($val['edit']>0) echo 'отредактировано администратором'; ?></td>
                                        <td><a href="/admin/edit/<?=$val['id'];?>" class="btn btn-primary">Редактировать</a></td>
                                        <td><a href="/admin/delete/<?=$val['id'];?>" class="btn btn-danger" onclick="return confirm('Подтверждаете удаление?') ? true : false;">Удалить</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>