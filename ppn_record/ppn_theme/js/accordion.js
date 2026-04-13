class Accordion{
	constructor(domNode){
		this.rootEl=domNode;
		this.buttonEl=this.rootEl.querySelector('button[data-open-status]');
		const controlId=this.buttonEl.getAttribute('aria-controls');
		this.contentEl=document.getElementById(controlId);
		console.log(this.contentEl);
		this.opened=this.buttonEl.getAttribute('data-open-status')==='open';
		// add event listeners
		this.buttonEl.addEventListener('click', this.onButtonClick.bind(this));
	}//*contructor end
	
	onButtonClick(){
		this.toggle(!this.opened);
	}
	
	toggle(opened){
		// don't do anything if the opened state doesn't change
		//if(opened===this.opened){
		//	return;
		//}
	
		// update the internal state
		this.opened=opened;

		// handle DOM updates
		if(opened){
			this.buttonEl.setAttribute('data-open-status','open');
			this.contentEl.classList.remove('content-hide');
		}
		else{
			this.buttonEl.setAttribute('data-open-status','closed');
			this.contentEl.classList.add('content-hide');
		}
	}//*toggle end
}
window.onload=function(){
// init accordions
const ppnAccordions=document.querySelectorAll('.ppn_accordion h3,.ppn_accordion h4');	
ppnAccordions.forEach(
	(accordionEl) => {new Accordion(accordionEl);}
);
};
