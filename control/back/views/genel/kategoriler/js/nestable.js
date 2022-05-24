!function($) {
    "use strict";

    var Nestable = function() {};

    Nestable.prototype.updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    },
    //init
    Nestable.prototype.init = function() {
        // activate Nestable for list 1
        $('#nestable_list_2').nestable({
            group: 1,
            maxDepth: 20
        }).on('change', this.updateOutput);

        // output initial serialised data
        this.updateOutput($('#nestable_list_2').data('output', $('#nestable_list_2_output')));
    },
    //init
    $.Nestable = new Nestable, $.Nestable.Constructor = Nestable
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.Nestable.init()
}(window.jQuery);
