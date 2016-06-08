jQuery(document).foundation();

/********* Visual Choser Part ********/

jQuery(document).ready(function() {

  function redraw_canvas() {
    paper.clear();
    szelesseg = jQuery('.visualchooser').width();
    magassag = jQuery('.visualchooser').height();

    paper.setSize(szelesseg, szelesseg*origratio);
    paper.setViewBox(0, 0, origwidth, origheight, true);

    var items = [];
    var tiptops = [];
    var text ='';

    jQuery('.datarow--floor').each(function(index) {
      var menuitem = jQuery(this);

      items[index] = paper.path(menuitem.attr('data-svgdata'));


      items[index].node.id = 'v' +  menuitem.attr('id');


      items[index].attr(
        {
          'fill':'#f1f6f2',
          'opacity':'0',
          'stroke': '#cacaca',
          'stroke-width': '0',
          'stroke-opacity': '100',
          //'href': jQuery(this).attr('data-url'),
          //'title': jQuery(this).text()
        }
      );


      items[index].data('data-id', menuitem.attr('id'));

      //items[index].data('url', jQuery(this).attr('data-url'));



      items[index].click(function () {
        //window.location=(items[index].data('url'));
        //jQuery('path').removeClass('is_selected');
        //jQuery('#' + items[index].node.id).toggleClass('is_selected');
        // items[index].attr(
        //   {
        //     'opacity': '0.75',
        //     'stroke-width': '1',
        // });
      });


      // items[index].hover(
      //   function(event){
      //     //jQuery('path').removeClass('is_selected');
      //     items[index].attr(
      //     {
      //       opacity: 0.666,
      //     });
      //   },
      //   function(){
      //     items[index].attr(
      //     {
      //       opacity: 0,
      //     });
      //   }
      // );


      // tiptops[index] = new Foundation.Tooltip( menuitem , {
      //     tipText: function() {
      //       $tiptext='<h1>' + jQuery('#va1').attr('id') + '</h1>';
      //       return $tiptext;
      //     },
      //     positionClass: 'top'
      // });

    });


    //**** Build Path tooltips

    jQuery('path').each( function(index) {
      //alert(jQuery(this).attr('id'));
      var floorid=jQuery(this).attr('id').slice(1);
      var floorname=jQuery('#'+floorid).text();
      var localtable = '<div class="datatable localtable">';
      localtable+=jQuery('.datatable--head').html();
      jQuery('.datarow[data-emeletslug="'+ floorid +'"]').each( function(kisindex) {
        localtable+=jQuery(this).html();
      });
      localtable+="</div>";
      tiptops[index] = new Foundation.Tooltip( jQuery(this) , {
          tipText: function() {
            $tiptext='<h3>' + floorname + '</h3>';
            $tiptext+=localtable;
            return $tiptext;
          },
          positionClass: 'bottom',
          hoverDelay: '100'
      });
    });

  }

  if ( jQuery('.visualchooser').length > 0 ) {
      var szelesseg = jQuery('.visualchooser').width();
      var origwidth=jQuery('.visualchooser').attr('data-width');
      var origheight=jQuery('.visualchooser').attr('data-height');
      var paper = new Raphael(document.getElementById('visualchooser'), origwidth, origheight);
      var origratio=origheight/origwidth;
      console.log(origratio);
      redraw_canvas();
      jQuery(window).resize(redraw_canvas);
    }

    jQuery('path').on('focusout', function(e){
      jQuery(this).removeClass('is_selected');
    });

    jQuery('path').on('click', function(e){
      if (jQuery(this).hasClass('is_selected')) {
        jQuery(this).blur();
      } else {
        jQuery(this).addClass('is_selected');
      }
    });


    // $('#csiki').on('click', function(e) {
    //   e.preventDefault();
    //    $('.accordion').foundation('toggle');
    // });


    // function choosertooltip(theid) {
    //   return '<h3>'+ theid +'</h3><p>Lorem ipsum dolor sit amet</p>';
    // }

    // var $tooltipelem = new Foundation.Tooltip( jQuery('.apc-pageheader__title') , {
    //   tipText: choosertooltip( jQuery('.apc-pageheader__title').attr('title'))
    // });

    // jQuery('.apc-pageheader__title').foundation('show');

  });

