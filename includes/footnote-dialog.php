<html>
    <head>
        <!-- Disable browser caching of dialog window -->
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="pragma" content="no-cache" />
        <style>
            body {
                padding: 1em .5em;
            }
            label {
                font-family: arial, sans-serif;
                font-weight: bold;
                margin-bottom: .5em;
                display: inline-block;
            }
            textarea {
                width: 100%;
                padding: .5em;
            }
            textarea:focus {
                outline: none;
                border: 1px solid #00ADF2;
            }
            .btn {
                color: #fff;
                font-size: 14px;
                font-weight: bold;
                display: inline-block;
                background-color: #00ADF2;
                border: none;
                padding: .5em 1em;
                margin-top: 1em;
                cursor: pointer;
                transition: background 0.3s ease;
            }
            .btn:hover {
                background-color: #4bc7f8;
            }
        </style>
    </head>
    <body>

        <form method="post">
            <label for="footnote">Shortcode text</label><br />
            <textarea id="footnote-textarea" class="footnote-textarea" name="footnote" cols="30" rows="10"></textarea><br/>
            <input class="btn" type="submit" value="Insert Footnote" />
        </form>

        <script>

            var passed_arguments = top.tinymce.activeEditor.windowManager.getParams();
            var $ = passed_arguments.jquery;
            var jq_context = document.getElementsByTagName("body")[0];
            console.log($('#footnote-textarea', jq_context).val());
            $("form", jq_context).submit(function(e){
                e.preventDefault();
                //  Get the input text
                var input_text = $("textarea[name='footnote']", jq_context).val();
                //  Construct the shortcode
                var shortcode = '[footnote';
                //  Do we have a value in the input?
                if( input_text != "" ) {
                    // Yes, we do. Add the text argument to the shortcode.
                    shortcode += ' tooltip="' + input_text + '"';
                }
                //  Close the shortcode
                shortcode += '][/footnote]';
                //  Insert the shortcode into the editor
                passed_arguments.editor.selection.setContent(shortcode);
                passed_arguments.editor.windowManager.close();
            });

        </script>

    </body>
</html>