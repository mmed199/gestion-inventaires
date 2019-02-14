/****************************************************************************
Copyright (c) 2010 Guillaume Barillot 

http://guillaume-barillot.com
gbarillot at gmail dot com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
**********************************************************************/


function magnify(){
  $('.magnifier').each(function(this_img){
    Event.observe(this_img,'mouseover',function(){
      if(!$('zoom_container')){
        var zoom_container = new Element('div', {id : 'zoom_container'});
        var zoom_img = new Element('img', {id : 'zoom_img'});
        
        document.body.appendChild(zoom_container);
        zoom_container.insert(zoom_img);
      }
      $('zoom_img').src = this_img.readAttribute('href');
      $('zoom_container').show(); 
    });
    Event.observe(this_img,'mouseout',function(){
      $('zoom_container').hide();
    });
    Event.observe(this_img,'mousemove',function(event){
      //Distance between mouse pointer and top left zoom_container
      var mouse_offset = 20;
      
      var coords = Position.cumulativeOffset(this_img.down(0));
      var mousex = event.pointerX();
      var mousey = event.pointerY();
      var zoom_ctn = $('zoom_container').getDimensions();
      var zoom_ctn_x = zoom_ctn.width;
      var zoom_ctn_y = zoom_ctn.height;
      var k = eval($('zoom_img').width / this_img.down(0).width);
      var offset_x = eval((zoom_ctn_x / 2) + mouse_offset);
      var offset_y = eval((zoom_ctn_y / 2) + mouse_offset);
      var zoomed_mousex = Math.round(eval(((mousex - coords[0]) * k)-offset_x));
      var zoomed_mousey = Math.round(eval(((mousey - coords[1]) * k)-offset_y));

      //Make sure we're not overflowing zoomed image
      if(zoomed_mousex >= eval($('zoom_img').width - zoom_ctn_x)){zoomed_mousex = $('zoom_img').width -zoom_ctn_x;}
      if(zoomed_mousey >= eval($('zoom_img').height - zoom_ctn_y)){zoomed_mousey = $('zoom_img').height - zoom_ctn_y;}

      //$('zoom_container').setStyle({top:eval(mousey + mouse_offset)+'px', left:eval(mousex + mouse_offset)+'px'});
      $('zoom_img').setStyle({margin:'-'+zoomed_mousey+'px auto auto -'+zoomed_mousex+'px'});
    });
  });
}
