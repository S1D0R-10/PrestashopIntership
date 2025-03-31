<div class="panel">
    <h3>{$title}</h3>
    <form action="{$action}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="BOX_MANAGER_TITLE">{$title_label}</label>
            <input type="text" name="BOX_MANAGER_TITLE" id="BOX_MANAGER_TITLE" value="{$BOX_MANAGER_TITLE}">
        </div>
        <div class="form-group">
            <label for="BOX_MANAGER_URL">{$url_label}</label>
            <input type="text" name="BOX_MANAGER_URL" id="BOX_MANAGER_URL" value="{$BOX_MANAGER_URL}">
        </div>
        <div class="form-group">
            <label for="BOX_MANAGER_BACKGROUND">{$bg_label}</label>
            <input type="file" name="BOX_MANAGER_BACKGROUND" id="BOX_MANAGER_BACKGROUND">
        </div>
        <button type="submit" name="submit_box_manager">Zapisz</button>
    </form>
</div>
