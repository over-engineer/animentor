(function($, lottie) {
  $(function() {
    /**
     * Run when an Animentor Lottie widget is ready
     *
     * @param {jQuery} $scope
     */
    function lottieReady($scope) {
      var $widget = $scope.find('.animentor-lottie-widget');

      // Check if widget has been initialized before
      if ($widget.data('initialized')) {
        return;
      }

      // Mark widget as initialized
      $widget.data('initialized', true);

      // Get all of its data attributes
      var data = {};
      var attrs = [
        'anim-loop',
        'animation-path',
        'autoplay',
        'direction',
        'mouseout',
        'mouseover',
        'name',
        'speed'
      ];

      attrs.forEach(function(attr) {
        var val = $widget.data(attr);
        if (typeof val !== 'undefined') {
          data[attr] = val;
        }
      });

      // Search for elements with the .lottie and/or .bodymovin class
      lottie.searchAnimations();

      // Load Lottie animation and store it for future reference
      var animation = lottie.loadAnimation({
        container: $widget[0],
        renderer: 'svg',
        autoplay: data.autoplay,
        loop: data['anim-loop'],
        path: data['animation-path'],
        name: data.name,
      });

      // Set animation speed (if applicable)
      if (data.hasOwnProperty('speed')) {
        animation.setSpeed(data.speed);
      }

      // Set animation direction (if applicable)
      if (data.hasOwnProperty('direction')) {
        animation.setDirection(data.direction);
      }

      if (data.mouseover) {
        var mouseEnterHandler = function(e) {
          animation.setDirection(data.direction);
          animation.play();
        };

        var mouseLeaveHandler = function(e) {
          switch (data.mouseout) {
            case 'stop':
              animation.stop();
              break;
            case 'pause':
              animation.pause();
              break;
            case 'reverse':
              animation.setDirection(data.direction * -1);
              animation.play();
              break;
            default:
              animation.stop();
          }
        };

        $widget
          .off('mouseenter', mouseEnterHandler)
          .on('mouseenter', mouseEnterHandler);
        
        $widget
          .off('mouseleave', mouseLeaveHandler)
          .on('mouseleave', mouseLeaveHandler);
      }
    }

    /**
     * Return whether the Elementor editor is active or not
     *
     * @return {boolean} Whether on edit mode or not
     */
    function isEditMode() {
      return $('body').hasClass('elementor-editor-active');
    }

    /**
     * Get all Animentor Lottie widgets and initialize them when on Elementor edit mode
     * Required due to widgets in Elementor templates not triggering the `frontend/element_ready` hook
     */
    function initLottieWidgets() {
      // Run only when the Elementor editor is active
      if (isEditMode()) {
        // Iterate over each Lottie widget
        $('.elementor-widget-lottie').each(function(i, elem) {
          lottieReady($(elem));
        });
      }
    }

    /**
     * Add Elementor actions
     */
    function addElementorHooks() {
      // Run when a Lottie widget is ready
      elementorFrontend.hooks.addAction('frontend/element_ready/lottie.default', lottieReady);

      // Initialize all Lottie widgets when on Elementor edit mode
      initLottieWidgets();
    }

    if (elementorFrontend.hooks) {
      // Hooks exist, add action
      addElementorHooks();
    } else {
      // Wait for Elementor frontend to be initialized, before adding hooks
      $(window).on('elementor/frontend/init', addElementorHooks);
    }
  });
})(jQuery, lottie);
