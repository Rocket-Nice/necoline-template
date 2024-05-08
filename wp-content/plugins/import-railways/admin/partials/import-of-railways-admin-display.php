<div class="import-container">
    <h1>Импорт расписания поездов</h1>
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" enctype="multipart/form-data">
        <input type="file" name="import">
        <input type="hidden" name="action" value="necoline_import_action" />
        <input type="submit" value="Отправить">
    </form>
</div>