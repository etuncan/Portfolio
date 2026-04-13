function setLoadMore(){
	const buttonEl=document.querySelector('.load-more-button');
	const containerEl=document.querySelector('.blog-style-default');
	let page=1;
	if (buttonEl && containerEl) {
        buttonEl.addEventListener('click', () => {
            page++; // Increment page number for next request
			const formData = new FormData();
            formData.append('action', 'load_more_posts');
            formData.append('nonce', blog_ajax.nonce);
			formData.append('paged', page);
			formData.append('posts_per_page', 5);
            fetch(blog_ajax.url, {
                method: 'POST',
				body: formData,
            })
			.then(response => {
				if (!response.ok) {
					throw new Error('Network response was not ok');
                }
                return response.text(); 
			})
			.then(html => {
				containerEl.insertAdjacentHTML('beforeend', html);
            })
            .catch(error => {
                console.error('problem with fetch:', error);
            });
        });
	}
}
addLoadEvent(setLoadMore);
