/**
 * Created by Namnt on 30/06/2021
 */
(
    function () {
        'use strict';
        $("#videoFile").change(ev => {
            $(ev.target).closest('form').trigger('submit')
        })
    }
)();