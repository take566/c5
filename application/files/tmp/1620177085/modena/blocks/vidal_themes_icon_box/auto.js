Concrete.event.bind('vidal_themes_icon_box.chooseIcon.font_awesome', function () {
    $(document).on('change', 'select.font-awesome-previewed', function (e) {
        var previewIcon = $(this).parent().find('[data-preview="icon"]');
        if ($(previewIcon).length > 0) {
            var value = $(this).val();
            var classes = $.trim(value) != '' ? 'fa ' + value : '';
            $(previewIcon).removeAttr('class');
            $(previewIcon).addClass(classes);
        }
    });
});
