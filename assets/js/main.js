/**
 * 
 */

var Photobot = (function(jQuery) {
  function Photobot($) {
    this.jq = $;
    this.id = '#phbot-fxslider';
  }


  Photobot.prototype.addPageViewApplyFiltersButton = function() {
    var $ = this.jq,
        compiled = _.template(
          '<a id="phbot-btn-apply-filters" class="button-secondary" href="#" style="float:left; margin-left: 4px;"><%= anchor %>&#8230;</a>'
        );
    
    $('.wp_attachment_image input[type="button"]')
      .after(compiled(
        {
          anchor: photobotLocal.i18n.apply_filters
        }
      ));
  }
  
  
  Photobot.prototype.applyFiltersBtnHandler = function() {
    var $ = this.jq,
        phbot = this;
    var applyFiltersBtn = $('#phbot-btn-apply-filters');
    
    $(document).on('click', 'ul.attachments .attachment', function(e) {
      photobotLocal.post_id = $(this).data('id');
    });
    
    $(document).on('click', '#phbot-btn-apply-filters', function(e) {
      e.preventDefault();
      var self = $(this);
      self.siblings('.spinner').show();
      
      $.get(ajaxurl, {action: 'reveal_fxslider', 'post_id': photobotLocal.post_id}, function(data) {
        $('.wp_attachment_details').before(data);
        self.siblings('.spinner').hide();
        
        $(phbot.id).css('max-width', $('.wp_attachment_holder .thumbnail').width() + 'px');
        
        $(phbot.id).slick({
          infinite: true,
          slidesToShow: 3,
          centerMode: true,
          arrows: false
        });
        
        self.siblings('.spinner').hide();
        
        var imagesArray = new Array();
        $('#phbot-fxslider img').each(function(i, el) { 
          imagesArray.push( $(el).data('preload') ); 
        });
        
        new PreLoader(imagesArray, {
          onProgress: function(img, imageEl, index) {
            console.log(imageEl);
          }
        });
        
//        console.log(imagesArray);
      });
    });
    
    $(document).on('click', '.slick-slide img', function(e) {
      var self = $(this),
          im = new Image,
          src = 'http://awesomeheader.dev/photobot/' +
            $(this).parent().data('effect') + '/' + photobotLocal.post_id + '/';

      $(im)
        .attr("src", src)
        .addClass('thumbnail')
        .css({maxWidth: '100%'});
      
      if ($(this).hasClass('clicked')) {
        _.delay( function() { $('.wp_attachment_holder .thumbnail').replaceWith(im); } , 200 );

      } else {
        $(this).addClass('clicked');
        _.delay( function() { self.trigger('click'); } , 300);
      }
    });
  }


  return Photobot;
})();


var photobot = new Photobot(jQuery);


jQuery(function($) {
  photobot.addPageViewApplyFiltersButton();
  photobot.applyFiltersBtnHandler();
});