function editAction() {
    $('.tx-telephonedirectory')
        .on('click', '*[data-action="remove"]', function () {
            $('#' + $(this).data('target')).remove();
        })
        .on('click', '*[data-action="add"]', function () {
            if ($(this).data('after')) {
                $('#' + $(this).data('after')).after(getClone($(this).data('source').replace(/#/g, '\\#')));
            }

            if ($(this).data('prepend')) {
                $('#' + $(this).data('prepend')).prepend(getClone($(this).data('source').replace(/#/g, '\\#')));
            }
        });

    function getClone(selector) {
        var $container = $('#telephonedirectoryLanguageSkills');
        var $clone = $('#' + selector).clone(true);

        $clone.removeClass('hidden')
            .html($clone.html().replace(/###UID###/g, $container.attr('data-count')))
            .attr('id', $clone.attr('id').replace('###UID_CONTAINER###', $container.attr('data-count')));

        $clone.find('select').removeAttr('disabled');
        $container.attr('data-count', parseInt($container.attr('data-count')) + 1);

        return $clone;
    }
}

editAction();
