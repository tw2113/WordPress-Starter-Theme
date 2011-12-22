/*
An easy way to add some funny and entertaining stuff to your website. The Keys to enter for a Konami Code are : arrow up, arrow up, arrow down, arrow down, arrow left, arrow right, arrow left, arrow right, b, a ... and that's it !
Borrowed from: http://forrst.com/posts/Easy_way_to_put_Konami_Code_on_your_website_with-zaK#comment-land
*/
var keys = [], konami = "38,38,40,40,37,39,37,39,66,65";
$(document).keydown(function(e){
	keys.push( e.keyCode );
	if ( keys.toString().indexOf( konami ) >= 0 ){
		$(document).unbind('keydown',arguments.callee);
			//DO STUFF
	}
});
