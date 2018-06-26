(function($) {
    tinymce.create('tinymce.plugins.footnote', {
      init : function(ed, url) {

        ed.addButton('footnote', {
            title : 'Add a footnote',
            image : '/wp-content/themes/wp-theme/img/footnote.png',
            cmd: 'footnote_command'
        });

        ed.addCommand('footnote_command', function(){
          
          ed.windowManager.open(
            
            {
              title: 'Footnote Creator',
              file: '/wp-content/themes/wp-theme/includes/footnote-dialog.php',
              width: 500,
              height: 300,
              inline: 1
            },
            {
              editor: ed,
              jquery: $
            }

          );

        });

    },
    createControl : function(n, cm) {
        return null;
    },
  });
    
  tinymce.PluginManager.add('footnote', tinymce.plugins.footnote);

})(jQuery);