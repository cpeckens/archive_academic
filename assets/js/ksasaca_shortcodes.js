(function() {
    tinymce.create('tinymce.plugins.acc-title', {
        init : function(ed, url) {
            ed.addButton('acc-title', {
                title : 'Accordion Title',
                image : url+'/acc-title.png',
                onclick : function() {
                     ed.selection.setContent('[acc-title]' + ed.selection.getContent() + '[/acc-title]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('acc-title', tinymce.plugins.acc-title);
})();

(function() {
    tinymce.create('tinymce.plugins.acc-content', {
        init : function(ed, url) {
            ed.addButton('acc-content', {
                title : 'Accordion Content',
                image : url+'/acc-content.png',
                onclick : function() {
                     ed.selection.setContent('[acc-content]' + ed.selection.getContent() + '[/acc-content]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('acc-content', tinymce.plugins.acc-content);
})();

(function() {
    tinymce.create('tinymce.plugins.readmore-title', {
        init : function(ed, url) {
            ed.addButton('readmore-title', {
                title : 'Read More Title',
                image : url+'/readmore-title.png',
                onclick : function() {
                     ed.selection.setContent('[readmore-title]' + ed.selection.getContent() + '[/readmore-title]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('readmore-title', tinymce.plugins.readmore-title);
})();

(function() {
    tinymce.create('tinymce.plugins.readmore-content', {
        init : function(ed, url) {
            ed.addButton('readmore-content', {
                title : 'Read More Content',
                image : url+'/readmore-content.png',
                onclick : function() {
                     ed.selection.setContent('[readmore-content]' + ed.selection.getContent() + '[/readmore-content]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('readmore-content', tinymce.plugins.readmore-content);
})();