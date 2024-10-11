function Driver(current){
	toggleClass('active2');
	current.classList.toggle('active2');
	document.getElementById('activeimg').src=current.src;
	document.getElementById('activetxt').innerText=TXTLIST.get(MAP1.get(current.src));
}
function toggleClass(target){
	let list=document.getElementsByClassName(target);
	for(let i=0;i<list.length;i++){
		list[0].classList.toggle(target);
	}
}
const TXTLIST=new Map();
TXTLIST.set(0,"I like to keep busy with business. It's a great way of getting things done by doing stuff.");
TXTLIST.set(1,"Innovation is a core trend in our productivity. By harnessing the power of teamwork, we exceed industry standards.");
TXTLIST.set(2,"I have a belief in believing in the power of peoples imagination and perseption of belief.");
TXTLIST.set(3,"The weevile of the steeple is found amongst the people. The people exist as little meeples.");
TXTLIST.set(4,"I like to keep busy with business. It's a great way of getting things done by doing stuff.");
TXTLIST.set(5,"Innovation is a core trend in our productivity. By harnessing the power of teamwork, we exceed industry standards.");
TXTLIST.set(6,"I have a belief in believing in the power of peoples imagination and perseption of belief.");
TXTLIST.set(7,"The weevile of the steeple is found amongst the people. The people exist as little meeples.");
const LISTS=document.getElementsByClassName('navlists');
const LISTL=document.getElementsByClassName('navlistl');
const MAP1= new Map();
for(let x=0; x<LISTS.length; x++){
	MAP1.set(LISTS[x].firstElementChild.src,x);
}
for(let y=0; y<LISTL.length; y++){
	MAP1.set(LISTL[y].firstElementChild.src,y+LISTS.length);
}
document.getElementById('activetxt').innerText=TXTLIST.get(0);