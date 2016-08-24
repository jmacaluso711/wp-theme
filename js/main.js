$(function(){});

// Tabs w/back button support
const tabs = function(tabContent, tabNav, backBtnEnabled, firstLoadHash ) {

   if ( backBtnEnabled === undefined) {
      backBtnEnabled = false
   };

   if ( firstLoadHash === undefined) {
      firstLoadHash = '#'
   };

   if (backBtnEnabled) {

      // If hash is empty set to the first tab
      // This is mainly for SFPRO because it needs a url for AJAX results
      if(location.hash === '') {
         location.hash = firstLoadHash;
      }

   };

   var showTabByHash = function() {

      var tabName = location.hash;

      // Show tab content
      $(tabName).show();

      // Add active class to tab nav item
      $(tabNav + ' a[href="' + location.hash + '"]').parent().addClass('tab-active');

   };

   var disableTabs = function() {

      // Hide all other tabs
      $(tabContent).hide();

      //Remove class of active tab on all other tabs
      $(tabNav + ' span.tab-active').removeClass('tab-active');

   };

   var showFirstTab = function() {

      // Show First Tab
      $(tabContent).not(':first').hide();
      $(tabContent + ':first').show();
      $(tabNav + ' span:first').addClass('tab-active');

   };

   /*
      On first load if back btn enabled show tab by hash
      otherwise show first tab
   */
   if (backBtnEnabled === true) {

      // If hash exists show tab by hash
      if(location.hash != '') {

         showTabByHash();

      } else {

         showFirstTab();

      }

   } else {

      showFirstTab();

   }

   /*
      Show tabs click events
   */

   $(tabNav).on('click', 'span', function(){

      if (backBtnEnabled === true) {

         var hashID = $(this).find('a').attr('href');

         if(history.pushState) {
            history.pushState(null, null, hashID)
         } else {
            location.hash = hashID;
         }

      }

      // Hide all other tabs
      disableTabs();

      //Add class of active to clicked tab
      $(this).addClass('tab-active');

      /*
         If back btn enabled show by hash otherwise
         just match href with tabContent ID
      */
      if (backBtnEnabled === true) {

         showTabByHash();

      } else {

         $($('a',this).attr('href')).show();

      }

      return false;

   });

   /*
      If back btn enabled watch for hashchange
   */
   if (backBtnEnabled === true) {

      $(window).on('hashchange', function() {

         // Hide other tabs
         disableTabs();

         // If hash exists show tab by hash
         if(location.hash != '') {

            showTabByHash();

         } else {

            showFirstTab();

         }

      });

   }

};


// Accordions

const accordions = function(accordionContent, accordionTrigger) {

   var allPanels = $(accordionContent).hide();
   var allTitles = $(accordionTrigger);

   $(accordionTrigger).on('click', function(){

      var panel = $(accordionContent);
      var target = $(this).next(panel);

      if(target.hasClass('accordion--expanded')) {

         allTitles.removeClass('accordion--active');
         allPanels.removeClass('accordion--expanded').slideUp('fast');

      } else {

         allTitles.removeClass('accordion--active');
         allPanels.removeClass('accordion--expanded').slideUp('fast');
         $(this).addClass('accordion--active');
         $(target).addClass('accordion--expanded').slideDown('fast');

      }

      return false;

   });

};