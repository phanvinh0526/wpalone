!function(a){"use strict";var b={common:{init:function(){jQuery(document).ready(function(a){a("#update-nav-menu").bind("click",function(b){b.target&&b.target.className&&-1!=b.target.className.indexOf("item-edit")&&(a("input[value='#pafl_modal_login'][type=text]").parent().parent().parent().each(function(){var b=a(this),c=b.attr("id").substring("menu-item-settings-".length),d=a("#edit-menu-item-url-"+c),e=a("#edit-menu-item-title-"+c),f='<p class="description description-thin"><label for="pafl-helper-{item_id}-{item_part}">{item_label}<br><input id="pafl-helper-{item_id}-{item_part}" class="widefat" type="text"></label></p>';d.parent().parent().hide(),e.parent().parent().hide(),a('input[id^="pafl-helper-"]').parent().parent().remove(),b.prepend(a(f.replaceArray(["{item_id}","{item_part}","{item_label}"],[c,"2",pafl_strings.label_logout]))),b.prepend(a(f.replaceArray(["{item_id}","{item_part}","{item_label}"],[c,"1",pafl_strings.label_login])));var g=e.val().substr(0,e.val().indexOf(" // ")),h=e.val().substr(-e.val().length+" // ".length+g.length);a("#pafl-helper-"+c+"-1").val(g),a("#pafl-helper-"+c+"-2").val(h),a('input[id^="pafl-helper-"]',b).keyup(function(){e.val(a("#pafl-helper-"+c+"-1").val()+" // "+a("#pafl-helper-"+c+"-2").val())})}),a("input[value='#pafl_modal_register'][type=text]").parent().parent().parent().each(function(){var b=a(this),c=b.attr("id").substring("menu-item-settings-".length),d=a("#edit-menu-item-url-"+c);d.parent().parent().hide()}))})}),String.prototype.replaceArray=function(a,b){for(var c,d=this,e=0;e<a.length;e++)c=new RegExp(a[e],"g"),d=d.replace(c,b[e]);return d}}}},c={fire:function(a,c,d){var e=b;c=void 0===c?"init":c,""!==a&&e[a]&&"function"==typeof e[a][c]&&e[a][c](d)},loadEvents:function(){c.fire("common"),a.each(document.body.className.replace(/-/g,"_").split(/\s+/),function(a,b){c.fire(b)})}};a.fn.shuffle=function(){return this.each(function(){var b=a(this).children().clone(!0);return b.length?a(this).html(a.shuffle(b)):this})},a.shuffle=function(a){for(var b,c,d=a.length;d;b=parseInt(Math.random()*d),c=a[--d],a[d]=a[b],a[b]=c);return a},a(document).ready(c.loadEvents)}(jQuery);