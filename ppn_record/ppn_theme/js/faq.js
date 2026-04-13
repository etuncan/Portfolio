class Faq{
	constructor(domNode){
		this.rootEl=domNode;
		this.buttonEl=this.rootEl.querySelector('button[data-open-status]');
		const controlId=this.buttonEl.getAttribute('aria-controls');
		this.contentEl=document.getElementById(controlId);
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
window.addEventListener('load', ()=>{
// init accordions
const ppnFaq=document.querySelectorAll('.faq_container h3,.faq_container h4');	
ppnFaq.forEach(
	(faqEl) => {new Faq(faqEl);}
);
});
