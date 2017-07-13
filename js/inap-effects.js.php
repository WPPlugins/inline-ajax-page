/* <script>(to trick editors into using javascript syntax)*/
var the_count = 0;
var timeout = 100;
var effect = '';
/*
we use these whole function rather than a loop to keep it from freezing the browser window.
that and by splitting it into many functions it is extremely easy to add functionality.
Purpose: Shows and Hides the excerpt and content
*/
function inap_effects(efct){
effect = efct;

	if(type == 'content' && cur_page[id]){
		inap_effects_hide('pagedcontent');
		//inap_shrink('pagedcontent');
	}else if(style1 == 'block'){
		inap_effects_show();
	}else{
		inap_effects_hide();
	}
}

function inap_effects_hide(mode){
the_count += 1;

	if(the_count == 1){
		inap_effects_hide_f(mode);}

	inap_effects_do('neg', f);

	if(the_count < 10){
		setTimeout("inap_effects_hide('"+mode+"');", timeout);
	}else{
	the_count = 0;
	inap_effects_continue(mode, f);

	}
}

function inap_effects_hide_f(mode){
	if(mode == 'pagedcontent'){
		f = d.getElementById('post_page_'+last_page[id]+'_'+id);
	}else{
		f = dwhere;
	}
	hght = f.offsetHeight;
}

function inap_effects_continue(mode, f){
/* clean up:*/
if(effect =='SlideUp2'){
	f.style.height = hght+'px';}
if(effect == 'Expand'){
	f.style.lineHeight = '100%';}
		if(mode == 'pagedcontent'){
			f.style.display = 'none';
			inap_effects_show(mode);
		}else{
			dwhere.style.display = style1;
			inap_effects_show(mode);
		}
}

function inap_effects_show(mode){
	the_count += 1;

	if(the_count == 1){
	inap_effects_show_f(mode);}

	inap_effects_do('pos', f);

	if(the_count < 10){
		setTimeout("inap_effects_show('"+mode+"');", timeout);
	}else{
/*clean up*/
if(effect =='SlideUp'){
	f.style.height = hght+'px';}
if(effect == 'Expand'){
	f.style.lineHeight = '100%';}

	the_count = 0;

	}
}

function inap_effects_show_f(mode){
	if(mode == 'pagedcontent'){
		f = d.getElementById('post_page_'+cur_page[id]+'_'+id);
	}else{
		f = dwhere;
	}
	f.style.display = 'block';

/*These ensure that almoat instantaneously the new text has the style. These ensure that most users can't see the normal text.*/
	if(effect == 'ScrollLeft'){
		f.style.marginLeft=80+'%';
	}
	if(effect == 'Expand'){
		f.style.lineHeight = '300%';
		f.style.letterSpacing = '1em';
	}

	hght = f.offsetHeight;
}
function inap_effects_do(dir,f){
var min = 0;
switch (effect){
case 'Expand':
f.style.overflow = 'hidden';
	if(dir == 'neg'){
		f.style.letterSpacing = (the_count*3)+'px';
		f.style.lineHeight = 100+(the_count*3)*10+'% !important;';
	}else{
		f.style.letterSpacing = (10-the_count)*2+'px';
		f.style.lineHeight = (20-the_count)*10+'% !important;';

	}
break;
case 'SlideUp':
f.style.overflow = 'hidden';
	if(dir == 'neg'){
		f.style.height = (f.offsetHeight - Math.floor((hght)/(10-the_count)))+'px';
	}else{
		f.style.height = Math.floor((hght)/(10-the_count))+'px';
	}
break;
case 'ScrollLeft':
	if(!window.innerHeight){
		min = 2;}
	if(dir == 'neg'){
		f.style.marginLeft=((the_count - min)*10)+'%';
	}else{
		f.style.marginLeft=(80-(the_count)*8)+'%';
	}
break;
case 'Fade':
	if(dir == 'neg'){
		f.style.opacity = (10 -the_count)/10;
		f.style.filter = 'alpha(opacity='+(10 -the_count)/0.1+')';
	}else{
		f.style.opacity = the_count/10;
		f.style.filter = 'alpha(opacity='+(the_count)/0.1+')';
	}
break;
default :
	if(dir == 'neg'){
		f.style.opacity = (10 -the_count)/10;
		f.style.filter = 'alpha(opacity='+(10 -the_count)/0.1+')';
	}else{
		f.style.opacity = the_count/10;
		f.style.filter = 'alpha(opacity='+(the_count)/0.1+')';
	}
}


}