      	</main>

         <footer class="c-site-footer">

            &copy;<?php echo date('Y'); ?>

            <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>

         </footer>

      </div>

      <?php wp_footer(); ?>

      <?php if(!isset($_ENV['PANTHEON_ENVIRONMENT'])) : ?>
        <!-- Browser Sync
        ================================================== -->
        <script id="__bs_script__">//<![CDATA[
          document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.7'><\/script>".replace("HOST", location.hostname));
        //]]>
        </script>
      <?php endif; ?>

   </body>

</html>
