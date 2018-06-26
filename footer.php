      	</div><!-- /.site-content -->

         <footer class="site-footer">

            &copy;<?php echo date('Y'); ?>

            <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>

         </footer>

      </div><!-- /.site -->

      <?php wp_footer(); ?>

      <?php if(!isset($_ENV['PANTHEON_ENVIRONMENT'])) : ?>
         <!-- Browser Sync
         ================================================== -->
         <script id="__bs_script__">
            //<![CDATA[
            document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.14.0.js'><\/script>".replace("HOST", location.hostname));
            //]]>
         </script>
      <?php endif; ?>

   </body>

</html>
